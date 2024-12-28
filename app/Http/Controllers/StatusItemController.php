<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusItemRequest;
use App\Models\StatusItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class StatusItemController extends Controller
{
   public function index(Request $request): Response 
   {
      Gate::authorize('viewAny',StatusItem::class);

      $status_types = StatusItem::select('type')->orderBy('type','asc')
      ->get()->unique('type');
      
      $status_types = $status_types->prepend((object)[
         'type'=>"all"
      ]);

      $results_perpage = $request->paginate_perpage ?: 10;

      $status_items = StatusItem::filter(request(['search_type','search_title','search_priority']))
         ->select('status_items.*')
         ->orderBy('type','asc')
         ->orderBy('priority','asc')
         ->paginate($results_perpage)
         ->withQueryString();
      
      return Inertia::render('StatusItems/Index',[
         'status_items'     => $status_items,
         'searchType'       => $request->search_type,
         'status_types'     => $status_types,
         'paginate_perpage' => $results_perpage,
         'paginate_options' => StatusItem::paginate_options(),
         'searchTitle'      => $request->search_title,
         'searchPriority'   => $request->search_priority
      ]);
   }


   public function show(StatusItem $status_item)
   {
      Gate::authorize('view',StatusItem::class);

      return Inertia::render('StatusItems/Show',[
         'status_item'  => $status_item
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',StatusItem::class);
      
      $status_types = StatusItem::select('type')->get()->unique('type');

      return Inertia::render('StatusItems/Create',[
         'status_types' => $status_types,
         'action'       => "add"
      ]);
   }

   public function store(StoreStatusItemRequest $request): RedirectResponse
   {
      Gate::authorize('create',StatusItem::class);

      $validated = $request->validated();

      $validated['priority'] = StatusItem::where('status_items.type','=',$validated['type'])
      ->count() + 1;

      StatusItem::create($validated);

      $message = "New Status Item successfully created";
      if($request->page==="main"){
         return redirect()->route('status_items.index')
            ->with('message',$message);
      }elseif($request->page==="modal"){
         return redirect()->back()
            ->with('message',$message);
      }
   }


   public function edit(StatusItem $status_item)
   {
      Gate::authorize('update',StatusItem::class);

      $status_types = StatusItem::select('type')->get()->unique('type');

      return Inertia::render('StatusItems/Edit',[
         'status_item'  => $status_item,
         'status_types' => $status_types,
         'action'       => "update"
      ]);
   }

   public function update(StoreStatusItemRequest $request, StatusItem $status_item)
   {
      Gate::authorize('update',StatusItem::class);

      $validated = $request->validated();

      if($validated['type'] != $status_item->type){
         $last_record = StatusItem::where('status_items.type','=',$validated['type'])
         ->orderBy('priority','desc')->first();
         $validated['priority'] = $last_record->priority + 1;

         $status_items = StatusItem::where('status_items.type','=',$status_item->type)
         ->orderBy('priority','asc')->get();
         foreach($status_items as $si){
            if($si->priority > $status_item->priority){
               $si->priority = $si->priority - 1;
               $si->update();
            }
         }
      }

      $status_item->update($validated);

      return redirect()->route('status_items.index')
         ->with('message','Status Item successfully updated');
   }


   public function destroy(StatusItem $status_item)
   {
      Gate::authorize('delete',StatusItem::class);

      $status_items = StatusItem::where('status_items.type','=',$status_item->type)
      ->orderBy('priority','asc')->get();

      foreach($status_items as $si){
         if($si->priority > $status_item->priority){
            $si->priority = $si->priority - 1;
            $si->update();
         }
      }

      $status_item->delete();

      return redirect()->route('status_items.index')
         ->with('message','Status Item successfully deleted');
   }
}
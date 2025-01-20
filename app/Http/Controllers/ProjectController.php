<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Customer;
use App\Models\County;
use App\Models\StatusItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
 
class ProjectController extends Controller
{
   public function index(Request $request): Response 
   {
      Gate::authorize('viewAny',Project::class);

      $project_statuses = StatusItem::where('status_items.type',"project")
      ->select('id','title','type','priority')->get();

      $project_statuses = $project_statuses->prepend((object)[
         'id'=>0, 'title'=>"All", 'type'=>"project", 'priority'=>0
      ]);

      $results_perpage = $request->paginate_perpage ?: 10;

      $projects = Project::with(['status_item','customer'])
         ->filter(request(['search_project_status','search_global','search_name','search_date','search_customer']))
         ->select('projects.*')
         ->latest('projects.created_at')
         ->paginate($results_perpage)
         ->withQueryString();
      
      return Inertia::render('Projects/Index',[
         'projects'            => $projects,
         'searchProjectStatus' => $request->search_project_status,
         'project_statuses'    => $project_statuses,
         'paginate_perpage'    => $results_perpage,
         'paginate_options'    => Project::paginate_options(),
         'searchGlobal'        => $request->search_global,
         'searchName'          => $request->search_name,
         'searchDate'          => $request->search_date,
         'searchCustomer'      => $request->search_customer,
         'customers'           => Customer::get(['id','company'])
      ]);
   }


   public function show(Project $project, Request $request): Response
   {
      Gate::authorize('view',Project::class);

      $status_types_nav = StatusItem::nav_status_types("project",$request);
      list($status_type_filename,$nav_status_types,$nav_current_status_type_id,$webroute_name) = $status_types_nav;

      $status_items = StatusItem::where('status_items.type',"project")->get(['id','title']);
      foreach($status_items as $status_item){
         if($status_item->id===$project->project_status){
            $project->project_status_title = $status_item->title;        
         }
      }

      $customers = Customer::with(['county','status_item'])->get();
      foreach($customers as $cust){
         if($cust->id===$project->customer){
            $customer = $cust;
         }
      }
      $counties = County::get(['id','title']);
      foreach($counties as $county){
         if($county->id===$customer->county){
            $customer->county_title = $county->title;
         }
      }
      $customer->customer_status_title = $customer->status_item->title;

      return Inertia::render('StatusItems/Types/Show'.$status_type_filename,[
         'status_type'            => $project,
         'project'                => $project,
         'customer'               => $customer,
         'navStatusTypes'         => $nav_status_types,
         'navCurrentStatusTypeId' => $nav_current_status_type_id,
         'statusTypeHeading'      => ucwords($project->name),
         'webrouteName'           => $webroute_name
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Project::class);
      
      return Inertia::render('Projects/Create',[
         'status_items' => StatusItem::where('status_items.type',"project")->get(['id','title']),
         'customers'    => Customer::get(['id','company']),
         'action'       => "add"
      ]);
   }
   
   public function store(StoreProjectRequest $request): RedirectResponse
   {
      Gate::authorize('create',Project::class);

      Project::create($request->validated());

      return redirect()->route('projects.index')
         ->with('message','New Project successfully created');
   }


   public function edit(Project $project)
   {
      Gate::authorize('update',Project::class);

      return Inertia::render('Projects/Edit',[
         'project'      => $project,
         'status_items' => StatusItem::where('status_items.type',"project")->get(['id','title']),
         'customers'    => Customer::get(['id','company']),
         'action'       => "update"
      ]);
   }

   public function update(StoreProjectRequest $request, Project $project)
   {
      Gate::authorize('update',Project::class);

      $project->update($request->validated());

      return redirect()->route('projects.index')
         ->with('message','Project successfully updated');
   }

   
   public function destroy(Project $project)
   {
      Gate::authorize('delete',Project::class);

      $project->delete();

      return redirect()->route('projects.index')
         ->with('message','Project successfully deleted');
   }
}
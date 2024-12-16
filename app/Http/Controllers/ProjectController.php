<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Customer;
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

      $project_statuses = StatusItem::where('status_items.type',"projects")
      ->select('id','title','type','priority')->get();

      $project_statuses = $project_statuses->prepend((object)[
         'id'=>0, 'title'=>"All", 'type'=>"projects", 'priority'=>0
      ]);

      $perpage = $request->paginate ?: 10;

      $projects = Project::with(['status_item','customer'])
         ->filter(request(['search_project_status','search_global','search_name','search_date','search_status_items','search_customer']))
         ->select('projects.*')
         ->latest('projects.created_at')
         ->paginate($perpage)
         ->withQueryString();
      
      return Inertia::render('Projects/Index',[
         'projects'            => $projects,
         'searchProjectStatus' => $request->search_project_status,
         'project_statuses'    => $project_statuses,
         'paginate'            => $perpage,
         'paginate_options'    => Project::paginate_options(),
         'searchGlobal'        => $request->search_global,
         'searchName'          => $request->search_name,
         'searchDate'          => $request->search_date,
         'searchStatusItems'   => $request->search_status_items,
         'searchCustomer'      => $request->search_customer,
         'customers'           => Customer::get(['id','company'])
      ]);
   }


   public function show(Project $project)
   {
      Gate::authorize('view',Project::class);

      return Inertia::render('Projects/Show',[
         'project'      => $project,
         'status_items' => StatusItem::where('status_items.type',"projects")->get(['id','title']),
         'customers'    => Customer::get(['id','company'])      
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Project::class);
      
      return Inertia::render('Projects/Create',[
         'status_items' => StatusItem::where('status_items.type',"projects")->get(['id','title']),
         'customers'    => Customer::get(['id','company']),
         'action'       => "add"
      ]);
   }
   
   public function store(StoreProjectRequest $request): RedirectResponse
   {
      Gate::authorize('create',Project::class);

      Project::create($request->validated());

      return redirect()->route('projects.index')
         ->with('message','Project created successfully.');
   }


   public function edit(Project $project)
   {
      Gate::authorize('update',Project::class);

      return Inertia::render('Projects/Edit',[
         'project'      => $project,
         'status_items' => StatusItem::where('status_items.type',"projects")->get(['id','title']),
         'customers'    => Customer::get(['id','company']),
         'action'       => "update"
      ]);
   }

   public function update(StoreProjectRequest $request, Project $project)
   {
      Gate::authorize('update',Project::class);

      $project->update($request->validated());

      return redirect()->route('projects.index')
         ->with('message','Project updated successfully');
   }

   
   public function destroy(Project $project)
   {
      Gate::authorize('delete',Project::class);

      $project->delete();

      return redirect()->route('projects.index')
         ->with('message','Project deleted successfully');
   }
}
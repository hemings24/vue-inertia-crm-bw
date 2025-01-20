<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\County;
use App\Models\StatusItem;
use App\Models\Project;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
 
class CustomerController extends Controller
{
   public function index(Request $request): Response 
   {
      Gate::authorize('viewAny',Customer::class);

      $customer_statuses = StatusItem::where('status_items.type',"customer")
      ->select('id','title','type','priority')->get();
      
      $customer_statuses = $customer_statuses->prepend((object)[
         'id'=>0, 'title'=>"All", 'type'=>"customer", 'priority'=>0
      ]);

      $results_perpage = $request->paginate_perpage ?: 10;

      $customers = Customer::with(['county','status_item'])
         ->filter(request(['search_customer_status','search_global','search_company','search_name','search_address','search_notes']))
         ->select('customers.*')
         ->latest('customers.created_at')
         ->paginate($results_perpage)
         ->withQueryString();
      
      foreach($customers as $customer){
         $customer->notes = substr($customer->notes,0,70).'.....';
         $customer->isHidden = true;
      }

      $projects = Project::get(['id','name','date','customer']);

      return Inertia::render('Customers/Index',[
         'customers'            => $customers,
         'projects'             => $projects,
         'searchCustomerStatus' => $request->search_customer_status,
         'customer_statuses'    => $customer_statuses,
         'paginate_perpage'     => $results_perpage,
         'paginate_options'     => Customer::paginate_options(),
         'searchGlobal'         => $request->search_global,
         'searchCompany'        => $request->search_company,
         'searchName'           => $request->search_name,
         'searchAddress'        => $request->search_address,
         'searchNotes'          => $request->search_notes,
         'title_prefixes'       => Customer::title_prefixes(),
         'counties'             => County::get(['id','title']),
         'email_templates'      => Email::email_templates()
      ]);
   }


   public function show(Customer $customer, Request $request): Response
   {
      Gate::authorize('view',Customer::class);
      
      $status_types_nav = StatusItem::nav_status_types("customer",$request);
      list($status_type_filename,$nav_status_types,$nav_current_status_type_id,$webroute_name) = $status_types_nav;

      $counties = County::get(['id','title']);
      foreach($counties as $county){
         if($county->id===$customer->county){
            $customer->county_title = $county->title;
         }
      }
      $status_items = StatusItem::where('status_items.type',"customer")->get(['id','title']);
      foreach($status_items as $status_item){
         if($status_item->id===$customer->customer_status){
            $customer->customer_status_title = $status_item->title;        
         }
      }

      return Inertia::render('StatusItems/Types/Show'.$status_type_filename,[
         'status_type'            => $customer,
         'customer'               => $customer,
         'projects'               => Project::where('projects.customer','=',$customer->id)->get(),
         'navStatusTypes'         => $nav_status_types,
         'navCurrentStatusTypeId' => $nav_current_status_type_id,
         'statusTypeHeading'      => $customer->company,
         'webrouteName'           => $webroute_name
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Customer::class);
      
      return Inertia::render('Customers/Create',[
         'title_prefixes' => Customer::title_prefixes(),
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::where('status_items.type',"customer")->get(['id','title']),
         'status_actions' => StatusItem::status_actions(),
         'action'         => "add"
      ]);
   }
   
   public function store(StoreCustomerRequest $request): RedirectResponse
   {
      Gate::authorize('create',Customer::class);

      Customer::create($request->validated());

      return redirect()->route('customers.index')
         ->with('message','New Customer successfully created');
   }


   public function edit(Customer $customer)
   {
      Gate::authorize('update',Customer::class);

      return Inertia::render('Customers/Edit',[
         'customer'       => $customer,
         'title_prefixes' => Customer::title_prefixes(),
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::where('status_items.type',"customer")->get(['id','title']),
         'status_actions' => StatusItem::status_actions(),
         'action'         => "update"
      ]);
   }

   public function update(StoreCustomerRequest $request, Customer $customer)
   {
      Gate::authorize('update',Customer::class);

      $customer->update($request->validated());

      return redirect()->route('customers.index')
         ->with('message','Customer successfully updated');
   }

   
   public function destroy(Customer $customer)
   {
      Gate::authorize('delete',Customer::class);

      $customer->delete();

      return redirect()->route('customers.index')
         ->with('message','Customer successfully deleted');
   }
}
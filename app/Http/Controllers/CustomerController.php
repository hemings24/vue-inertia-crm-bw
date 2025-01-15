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

      $customer_statuses = StatusItem::where('status_items.type',"customers")
      ->select('id','title','type','priority')->get();
      
      $customer_statuses = $customer_statuses->prepend((object)[
         'id'=>0, 'title'=>"All", 'type'=>"customers", 'priority'=>0
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

      $status_types = StatusItem::where('status_items.type','!=',"customers")
      ->select('id','type')->get()->unique('type');
      
      $status_types = $status_types->prepend((object)[
         'id'=>1, 'type'=>"details"
      ]);

      $nav_status_item = $request->nav_status_item ?: 1;

      $status_type_name = $request->nav_status_type ?: "Details";
      $status_type_name = ucfirst($status_type_name);

      return Inertia::render('Customers/Show'.$status_type_name,[
         'customer'      => $customer,
         'projects'      => Project::where('projects.customer','=',$customer->id)->get(),
         'counties'      => County::get(['id','title']),
         'status_items'  => StatusItem::where('status_items.type',"customers")->get(['id','title']),
         'navStatusItem' => $nav_status_item,
         'status_types'  => $status_types
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Customer::class);
      
      return Inertia::render('Customers/Create',[
         'title_prefixes' => Customer::title_prefixes(),
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::where('status_items.type',"customers")->get(['id','title']),
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
         'status_items'   => StatusItem::where('status_items.type',"customers")->get(['id','title']),
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
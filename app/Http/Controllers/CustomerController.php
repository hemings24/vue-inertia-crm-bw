<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\County;
use App\Models\StatusItem;
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
      //sleep(0); //refresh time delay

      $customer_statuses = StatusItem::where('status_items.type','customer')
      ->select('id','title','type','priority')->get();
      
      $customer_statuses = $customer_statuses->prepend((object)[
         'id'=>0, 'title'=>'All', 'type'=>'customer', 'priority'=>0
      ]);

      $perpage = $request->paginate ?: 10;

      $customers = Customer::with(['county','status_item'])
         ->filter(request(['search_customer_status','search_global','search_company','search_name','search_address','search_notes','search_status_items']))
         ->select('customers.*')
         ->latest('customers.created_at')
         ->paginate($perpage)
         ->withQueryString();
      
      foreach($customers as $customer){
         $customer->notes = substr($customer->notes,0,70).'.....';
      }

      return Inertia::render('Customers/Index',[
         'customers'            => $customers,
         'searchCustomerStatus' => $request->search_customer_status,
         'customer_statuses'    => $customer_statuses,
         'paginate'             => $perpage,
         'paginate_options'     => Customer::paginate_options(),
         'searchGlobal'         => $request->search_global,
         'searchCompany'        => $request->search_company,
         'searchName'           => $request->search_name,
         'searchAddress'        => $request->search_address,
         'searchNotes'          => $request->search_notes,
         'searchStatusItems'    => $request->search_status_items,
         'title_prefixes'       => Customer::title_prefixes(),
         'counties'             => County::get(['id','title'])
      ]);
   }


   public function show(Customer $customer)
   {
      Gate::authorize('view',Customer::class);

      return Inertia::render('Customers/Show',[
         'customer'     => $customer,
         'counties'     => County::get(['id','title']),
         'status_items' => StatusItem::where('status_items.type','customer')->get(['id','title'])
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Customer::class);
      
      return Inertia::render('Customers/Create',[
         'title_prefixes' => Customer::title_prefixes(),
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::where('status_items.type','customer')->get(['id','title']),
         'action'         => "add"
      ]);
   }
   
   public function store(StoreCustomerRequest $request): RedirectResponse
   {
      Gate::authorize('create',Customer::class);

      Customer::create($request->validated());

      return redirect()->route('customers.index')
         ->with('message','Customer created successfully.');
   }


   public function edit(Customer $customer)
   {
      Gate::authorize('update',Customer::class);

      return Inertia::render('Customers/Edit',[
         'customer'       => $customer,
         'title_prefixes' => Customer::title_prefixes(),
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::where('status_items.type','customer')->get(['id','title']),
         'action'         => "update"
      ]);
   }

   public function update(StoreCustomerRequest $request, Customer $customer)
   {
      Gate::authorize('update',Customer::class);

      $customer->update($request->validated());

      return redirect()->route('customers.index')
         ->with('message','Customer updated successfully');
   }

   
   public function destroy(Customer $customer)
   {
      Gate::authorize('delete',Customer::class);

      $customer->delete();

      return redirect()->route('customers.index')
         ->with('message','Customer deleted successfully');
   }
}
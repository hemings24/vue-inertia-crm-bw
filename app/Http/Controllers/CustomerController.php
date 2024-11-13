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
      sleep(0); //refresh time delay

      //$customers = Customer::with(['county','status_item'])->get();
      $customers = Customer::with(['county','status_item'])
         ->filter(request(['search_global','search_company','search_name','search_address','search_notes','search_status']))
         ->latest('customers.created_at')
         ->paginate(10)
         ->withQueryString();
      
      return Inertia::render('Customers/Index',[
         'customers'     => $customers,
         'searchGlobal'  => $request->search_global,
         'searchCompany' => $request->search_company,
         'searchName'    => $request->search_name,
         'searchAddress' => $request->search_address,
         'searchNotes'   => $request->search_notes,
         'searchStatus'  => $request->search_status
      ]);
   }


   public function create(): Response 
   {
      Gate::authorize('create',Customer::class);
      
      return Inertia::render('Customers/Create',[
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::get(['id','title']),
         'title_prefixes' => Customer::title_prefixes()
      ]);
   }
   

   public function store(StoreCustomerRequest $request): RedirectResponse
   {
      Gate::authorize('create',Customer::class);

      sleep(3);  //form request time delay

      Customer::create($request->validated());

      return redirect()->route('customers.index')
         ->with('message','Customer created successfully.');
   }


   public function edit(Customer $customer)
   {
      Gate::authorize('create',Customer::class);

      return Inertia::render('Customers/Edit',[
         'customer'       => $customer,
         'counties'       => County::get(['id','title']),
         'status_items'   => StatusItem::get(['id','title']),
         'title_prefixes' => Customer::title_prefixes()
      ]);
   }


   public function update(StoreCustomerRequest $request, Customer $customer)
   {
      Gate::authorize('create',Customer::class);

      $customer->update($request->validated());

      return redirect()->route('customers.index')
         ->with('message','Customer updated successfully');
   }

   
   public function destroy(Customer $customer)
   {
      Gate::authorize('create',Customer::class);

      $customer->delete();

      return redirect()->route('customers.index')
         ->with('message','Customer deleted successfully');
   }
}
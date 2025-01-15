<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Mail\EmailTemplates;
use App\Models\Email;
use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
   public function index()
   {
      //
   }


   public function create()
   {
      //
   }

   public function store(StoreEmailRequest $request, Customer $customer)
   {
      Gate::authorize('create',Email::class);

      $validated = $request->validated();
      $email = (object) $validated;

      Mail::send(
         new EmailTemplates($request,$email)
      );

      Email::create($validated);

      return redirect()->route('customers.index')
         ->with('message','Email successfully sent');

      /*return redirect()->back()
         ->with('message','Email successfully sent');*/
   }


   public function show(Email $email)
   {
      //
   }


   public function edit(Email $email)
   {
      //
   }

   public function update(UpdateEmailRequest $request, Email $email)
   {
      //
   }


   public function destroy(Email $email)
   {
      //
   }
}
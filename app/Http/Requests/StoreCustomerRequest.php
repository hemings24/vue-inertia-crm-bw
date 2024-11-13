<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreCustomerRequest extends FormRequest
{
   /**
   *Determine if the user is authorized to make this request.
   */
   public function authorize(): bool
   {
      return true;
   }

   /**
   *Get the validation rules that apply to the request.
   *
   *@return array<string => 'required', \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
   public function rules(): array
   {
      return[
         'company'         => 'required|string|max:50',
         'title_prefix'    => 'required',
         'first_name'      => 'required|string|max:50',
         'last_name'       => 'required|string|max:50',
         'address1'        => 'required|max:100',
         'address2'        => 'max:100',
         'address3'        => 'max:100',
         'city'            => 'required|string|max:50',
         'postcode'        => 'required|max:10',
         'county'          => ['required','numeric','exists:counties,id'],
         'email'           => ['required','string','max:50','email','unique:'.User::class],
         'phone'           => 'required|max:20',
         'notes'           => 'max:500',
         'customer_status' => ['required','numeric','exists:status_items,id']
      ];
   }
}
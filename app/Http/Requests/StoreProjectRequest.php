<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
         'name'              => 'required|string|max:50',
         'date'              => 'required|date',
         'price'             => 'required|numeric|max:999999',
         'project_reference' => 'required|max:50',
         'project_status'    => ['required','numeric','exists:status_items,id'],
         'customer'          => ['required','numeric','exists:customers,id']
      ];
   }
}
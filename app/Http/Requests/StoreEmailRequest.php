<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
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
         'subject'  => 'required|string|max:50',
         'content'  => 'required|max:500',
         'customer' => ['required','numeric','exists:customers,id']
      ];
   }
}
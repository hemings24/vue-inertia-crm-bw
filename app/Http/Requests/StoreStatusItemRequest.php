<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreStatusItemRequest extends FormRequest
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
         'title'     => 'required|string|max:50',
         'url'       => 'string|max:100',
         'type'      => 'required|string|max:20',
         'table_ref' => 'required|string|max:20',
         'priority'  => 'numeric'
         //'title'     => 'required|string|max:50|unique:status_items',
         //'table_ref' => 'required|string|max:20|unique:status_items',
         //'priority'  => 'required|numeric'
      ];
   }
}
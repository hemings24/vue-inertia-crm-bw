<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
   /**
   *Transform the resource into an array.
   *
   *@return array<string,mixed>
   */
   public function toArray(Request $request): array
   {
      return[
         'id'              => $this->id,
         'company'         => $this->company,
         'title_prefix'    => $this->title_prefix,
         'first_name'      => $this->first_name,
         'last_name'       => $this->last_name,
         'address1'        => $this->address1,
         'address2'        => $this->address2,
         'address3'        => $this->address3,
         'city'            => $this->city,
         'postcode'        => $this->postcode,
         'county'          => $this->county,
         'email'           => $this->email,
         'phone'           => $this->phone,
         'notes'           => substr($this->notes,0,50).'...',
         'customer_status' => $this->customer_status,
         'created_at'      => $this->created_at->toDateString()
      ];
   }
}
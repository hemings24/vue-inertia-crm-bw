<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
   /**
   *Transform the resource into an array.
   *
   *@return array<string,mixed>
   */
   public function toArray(Request $request): array
   {
      return[
         'id'                => $this->id,
         'name'              => $this->name,
         'date'              => $this->date->date('Y_m_d'),
         'price'             => $this->price,
         'project_reference' => $this->project_reference,
         'project_status'    => $this->project_status,
         'customer'          => $this->customer,
         'created_at'        => $this->created_at->toDateString()
      ];
   }
}
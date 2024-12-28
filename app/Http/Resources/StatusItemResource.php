<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusItemResource extends JsonResource
{
   /**
   *Transform the resource into an array.
   *
   *@return array<string,mixed>
   */
   public function toArray(Request $request): array
   {
      return[
         'id'         => $this->id,
         'title'      => $this->title,
         'url'        => $this->url,
         'type'       => $this->type,
         'table_ref'  => $this->table_ref,
         'priority'   => $this->priority,
         'created_at' => $this->created_at->toDateString()
      ];
   }
}
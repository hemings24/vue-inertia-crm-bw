<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\StatusItem;
use App\Models\Customer;

class Project extends Model
{
   use HasFactory;

   protected $fillable=[
      'name',
      'date',
      'price',
      'project_reference',
      'project_status',
      'customer'
   ];

   public function status_item(): BelongsTo
   {
      return $this->belongsTo(StatusItem::class,'project_status');
   }

   public function customer(): BelongsTo
   {
      return $this->belongsTo(Customer::class,'customer');
   }

   public static function paginate_options()
   {
      return[
         ['id' => 10,  'title' => "10"],
         ['id' => 25,  'title' => "25"],
         ['id' => 50,  'title' => "50"],
         ['id' => 100, 'title' => "100"]
      ];
   }
   
   public function scopeFilter($query, array $filters)
   {
      if($filters['search_global'] ?? false){
         $query->join('customers','customers.id','=','projects.customer')
         ->where(function($subquery){
            $subquery->where('customers.company','like','%'.request('search_global').'%')
            ->orWhere(function($q){
               $q->orWhere('projects.name','like','%'.request('search_global').'%');
            });
         });
      }

      if($filters['search_name'] ?? false){
         $query->where('projects.name','like','%'.request('search_name').'%');
      }

      if($filters['search_date'] ?? false){
         $query->where('projects.date','like','%'.request('search_date').'%');
      }

      if($filters['search_status'] ?? false){
         $query->where('status_items.title','like','%'.request('search_status').'%')
                ->join('status_items','status_items.id','=','projects.project_status');
      }

      if($filters['search_customer'] ?? false){
         $query->where('customers.company','like','%'.request('search_customer').'%')
                ->join('customers','customers.id','=','projects.customer');
      }
   }
}
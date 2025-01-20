<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Project;

class StatusItem extends Model
{
   use HasFactory;

   protected $fillable=[
      'title',
      'url',
      'type',
      'table_ref',
      'priority'
   ];

   public function customers(): HasMany
   {
      return $this->hasMany(Customer::class,'customer_status');
   }

   public function projects(): HasMany
   {
      return $this->hasMany(Project::class,'project_status');
   }

   public static function nav_status_types($status_type,$request)
   {
      $status_type_filename = $request->nav_current_status_type_name ?: $status_type;
      $status_type_filename = ucfirst($status_type_filename);

      $nav_status_types = StatusItem::where('status_items.type','!=',$status_type)
      ->select('id','type')->get()->unique('type');
      foreach($nav_status_types as $nav_status_type){
         $nav_status_type->id++;
      }
      $nav_status_types = $nav_status_types->prepend((object)[
         'id'=>1, 'type'=>$status_type
      ]);

      foreach($nav_status_types as $nst){
         if($nst->type!="customer" && $nst->type!="admin" && $nst->type!="project"){
            $nst->type = Str::plural($nst->type);
         }
         if($status_type==="customer" && $nst->type==="project"){
            $nst->type = Str::plural($nst->type);
         }
      }

      $nav_current_status_type_id = $request->nav_current_status_type_id ?: 1;
      
      $webroute_name = Str::plural($status_type);

      return[$status_type_filename,$nav_status_types,$nav_current_status_type_id,$webroute_name];
   }

   public static function status_actions()
   {
      return[
         ['id' => "add",  'title' => "Add New"],
         ['id' => "view", 'title' => "View All"],
         ['id' => "edit", 'title' => "Edit Item"]
      ];
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
      if($filters['search_type'] ?? false){
         if($filters['search_type']!="all"){
            $query->where('status_items.type',request('search_type'));
         }
      }

      if($filters['search_title'] ?? false){
         $query->where('status_items.title','like','%'.request('search_title').'%');
      }

      if($filters['search_priority'] ?? false){
         $query->where('status_items.priority',request('search_priority'));
      }
   }
}
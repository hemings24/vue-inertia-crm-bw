<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\County;
use App\Models\Project;
use App\Models\StatusItem;

class Customer extends Model
{
   use HasFactory;

   protected $fillable=[
      'company',
      'title_prefix',
      'first_name',
      'last_name',
      'address1',
      'address2',
      'address3',
      'city',
      'postcode',
      'county',
      'email',
      'phone',
      'notes',
      'customer_status'
   ];

   public static function title_prefixes()
   {
      return[
         ['id' => "Mr.",   'title' => "Mr."],
         ['id' => "Mrs.",  'title' => "Mrs."],
         ['id' => "Ms.",   'title' => "Ms."],
         ['id' => "Miss",  'title' => "Miss"],
         ['id' => "Dr.",   'title' => "Dr."],
         ['id' => "Prof.", 'title' => "Prof."]
      ];
   }

   public function county(): BelongsTo
   {
      return $this->belongsTo(County::class,'county');
   }

   public function status_item(): BelongsTo
   {
      return $this->belongsTo(StatusItem::class,'customer_status');
   }

   public function projects(): HasMany
   {
      return $this->hasMany(Project::class,'customer');
   }

   public function scopeFilter($query, array $filters)
   {
      if($filters['search_global'] ?? false){
         $query->join('counties','counties.id','=','customers.county')
         ->where(function($subquery){
            $subquery->where('counties.title','like','%'.request('search_global').'%')
            ->orWhere(function($q){
               $q->orWhere('company','like','%'.request('search_global').'%')
                 ->orWhere('title_prefix','like','%'.request('search_global').'%')
                 ->orWhere('first_name','like','%'.request('search_global').'%')
                 ->orWhere('last_name','like','%'.request('search_global').'%')
                 ->orWhere('address1','like','%'.request('search_global').'%')
                 ->orWhere('address2','like','%'.request('search_global').'%')
                 ->orWhere('address3','like','%'.request('search_global').'%')
                 ->orWhere('city','like','%'.request('search_global').'%')
                 ->orWhere('postcode','like','%'.request('search_global').'%');
            });
         });
      }

      if($filters['search_company'] ?? false){
         $query->where('company','like','%'.request('search_company').'%');
      }

      if($filters['search_name'] ?? false){
         $query->where(function($q){
            $q->where('title_prefix','like','%'.request('search_name').'%')
            ->orWhere('first_name','like','%'.request('search_name').'%')
            ->orWhere('last_name','like','%'.request('search_name').'%');
         });
      }

      if($filters['search_address'] ?? false){
         $query->join('counties','counties.id','=','customers.county')
         ->where(function($subquery){
            $subquery->where('counties.title','like','%'.request('search_address').'%')
            ->orWhere(function($q){
               $q->orWhere('address1','like','%'.request('search_address').'%')
                 ->orWhere('address2','like','%'.request('search_address').'%')
                 ->orWhere('address3','like','%'.request('search_address').'%')
                 ->orWhere('city','like','%'.request('search_address').'%')
                 ->orWhere('postcode','like','%'.request('search_address').'%');
            });
         });
      }

      if($filters['search_notes'] ?? false){
         $query->where('notes','like','%'.request('search_notes').'%');
      }

      if($filters['search_status'] ?? false){
         $query->where('status_items.title','like','%'.request('search_status').'%')
                ->join('status_items','status_items.id','=','customers.customer_status');
      }
   }
}
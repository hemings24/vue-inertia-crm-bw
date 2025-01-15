<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\County;
use App\Models\StatusItem;
use App\Models\Project;
use App\Models\Email;

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

   public function emails(): HasMany
   {
      return $this->hasMany(Email::class,'customer');
   }

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
      if($filters['search_customer_status'] ?? false){
         $query->where('customers.customer_status',request('search_customer_status'));
      }

      if($filters['search_global'] ?? false){
         $query->join('counties','counties.id','=','customers.county')
         ->where(function($subquery){
            $subquery->where('counties.title','like','%'.request('search_global').'%')
            ->orWhere(function($q){
               $q->orWhere('customers.company','like','%'.request('search_global').'%')
                 ->orWhere('customers.title_prefix','like','%'.request('search_global').'%')
                 ->orWhere('customers.first_name','like','%'.request('search_global').'%')
                 ->orWhere('customers.last_name','like','%'.request('search_global').'%')
                 ->orWhere('customers.address1','like','%'.request('search_global').'%')
                 ->orWhere('customers.address2','like','%'.request('search_global').'%')
                 ->orWhere('customers.address3','like','%'.request('search_global').'%')
                 ->orWhere('customers.city','like','%'.request('search_global').'%')
                 ->orWhere('customers.postcode','like','%'.request('search_global').'%');
            });
         });
      }

      if($filters['search_company'] ?? false){
         $query->where('customers.company','like','%'.request('search_company').'%');
      }

      if($filters['search_name'] ?? false){
         $query->where(function($q){
            $q->where('customers.title_prefix','like','%'.request('search_name').'%')
            ->orWhere('customers.first_name','like','%'.request('search_name').'%')
            ->orWhere('customers.last_name','like','%'.request('search_name').'%');
         });
      }

      if($filters['search_address'] ?? false){
         $query->join('counties','counties.id','=','customers.county')
         ->where(function($subquery){
            $subquery->where('counties.title','like','%'.request('search_address').'%')
            ->orWhere(function($q){
               $q->orWhere('customers.address1','like','%'.request('search_address').'%')
                 ->orWhere('customers.address2','like','%'.request('search_address').'%')
                 ->orWhere('customers.address3','like','%'.request('search_address').'%')
                 ->orWhere('customers.city','like','%'.request('search_address').'%')
                 ->orWhere('customers.postcode','like','%'.request('search_address').'%');
            });
         });
      }

      if($filters['search_notes'] ?? false){
         $query->where('customers.notes','like','%'.request('search_notes').'%');
      }

      /*if($filters['search_status_items'] ?? false){
         $query->where('status_items.title','like','%'.request('search_status_items').'%')
                ->join('status_items','status_items.id','=','customers.customer_status');
      }*/
   }
}
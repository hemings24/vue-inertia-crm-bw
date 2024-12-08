<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
}
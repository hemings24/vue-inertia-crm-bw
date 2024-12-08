<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer;

class County extends Model
{
   use HasFactory;

   protected $fillable=[
      'title',
      'country_id',
      'active'
   ];

   public function customers(): HasMany
   {
      return $this->hasMany(Customer::class,'county');
   }
}
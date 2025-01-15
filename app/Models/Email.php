<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;

class Email extends Model
{
   use HasFactory;

   protected $fillable=[
      'subject',
      'content',
      'customer'
   ];

   public function customer(): BelongsTo
   {
      return $this->belongsTo(Customer::class,'customer');
   }

   public static function email_templates()
   {
      return[
         ['id' => "conf_apmnt", 'subject' => "Confirm Appointment", 'content' => "Your appointment has been confirmed for..."],
         ['id' => "invoice",    'subject' => "Invoice",             'content' => "Here is your invoice..."],
         ['id' => "quote",      'subject' => "Quote",               'content' => "Here is your quote..."]
      ];
   }
}
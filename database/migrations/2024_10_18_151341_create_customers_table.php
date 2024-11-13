<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
   *Run the migrations.
   */
   public function up(): void
   {
      Schema::create('customers',function(Blueprint $table){
         $table->id();
         $table->string('company');
         $table->string('title_prefix',length:20)->nullable();
         $table->string('first_name',length:50)->nullable();
         $table->string('last_name',length:50)->nullable();
         $table->string('address1')->nullable();
         $table->string('address2')->nullable();
         $table->string('address3')->nullable();
         $table->string('city')->nullable();
         $table->string('postcode')->nullable();
         $table->foreignId('county')->constrained('counties')->default(0)->onDelete('cascade');
         $table->string('email')->nullable();
         $table->string('phone',length:50)->nullable();
         $table->text('notes')->nullable();
         $table->foreignId('customer_status')->constrained('status_items')->default(0)->onDelete('cascade');
         $table->timestamps();
      });
   }

   /**
   *Reverse the migrations.
   */
   public function down(): void
   {
      Schema::dropIfExists('customers');
   }
};
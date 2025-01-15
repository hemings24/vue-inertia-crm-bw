<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
      Schema::create('emails',function(Blueprint $table){
         $table->id();
         $table->string('subject',length:50)->nullable();
         $table->text('content')->nullable();
         $table->foreignId('customer')->constrained('customers')->default(0)->onDelete('cascade');
         $table->timestamps();
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('emails');
   }
};
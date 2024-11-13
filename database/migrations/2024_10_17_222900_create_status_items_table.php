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
      Schema::create('status_items',function(Blueprint $table){
         $table->id();
         $table->string('title');
         $table->string('url')->nullable();
         $table->string('type',length:50)->nullable();
         $table->string('table_ref',length:50)->nullable();
         $table->smallInteger('priority')->default(0);
         $table->timestamps();
      });
   }

   /**
   *Reverse the migrations.
   */
   public function down(): void
   {
      Schema::dropIfExists('status_items');
   }
};
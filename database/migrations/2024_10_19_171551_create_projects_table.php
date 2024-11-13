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
      Schema::create('projects',function(Blueprint $table){
         $table->id();
         $table->string('title');
         $table->date('date')->nullable();
         $table->decimal('price',total:11,places:2)->default(0.00);
         $table->string('project_reference',length:50)->default('0');
         $table->foreignId('project_status')->constrained('status_items')->default(0)->onDelete('cascade');
         $table->foreignId('customer')->constrained('customers')->default(0)->onDelete('cascade');
         $table->timestamps();
      });
   }

   /**
   *Reverse the migrations.
   */
   public function down(): void
   {
      Schema::dropIfExists('projects');
   }
};
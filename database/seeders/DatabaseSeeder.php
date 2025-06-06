<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
   *Seed the application's database.
   */
   public function run(): void
   {
      $this->call([
         UserSeeder::class,
         CountySeeder::class,
         StatusItemSeeder::class,
         Customer_Project_Email_Seeder::class
      ]);
   }
}
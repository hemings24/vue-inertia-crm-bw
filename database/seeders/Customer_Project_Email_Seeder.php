<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Email;

class Customer_Project_Email_Seeder extends Seeder
{
   public function run()
   {
      Customer::factory()->count(50)->create()->each(function($customer){
         Project::factory()->count(3)->create(['customer' => $customer->id]);
         Email::factory()->count(3)->create(['customer' => $customer->id]);
      });
   }
}
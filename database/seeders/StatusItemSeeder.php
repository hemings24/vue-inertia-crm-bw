<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StatusItem;

class StatusItemSeeder extends Seeder
{
   public function run()
   {
      StatusItem::factory()->create([
         'title' => 'C',
         'type'  => 'customers',
         'table_ref' => 'customers',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'P',
         'type'  => 'projects',
         'table_ref' => 'projects',
         'priority' => 2
      ]);
   }
}
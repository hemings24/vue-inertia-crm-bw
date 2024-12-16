<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StatusItem;

class StatusItemSeeder extends Seeder
{
   public function run()
   {
      StatusItem::factory()->create([
         'title' => 'To Chase',
         'type'  => 'customers',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Lead Only',
         'type'  => 'customers',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Current Customer',
         'type'  => 'customers',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Received',
         'type'  => 'enquiries',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Replied',
         'type'  => 'enquiries',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Refused',
         'type'  => 'quotes',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Requested',
         'type'  => 'quotes',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Sent',
         'type'  => 'quotes',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Accepted',
         'type'  => 'quotes',
         'priority' => 4
      ]);
      StatusItem::factory()->create([
         'title' => 'In Progress',
         'type'  => 'projects',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Pending',
         'type'  => 'projects',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Complete',
         'type'  => 'projects',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Archived',
         'type'  => 'projects',
         'priority' => 4
      ]);
      StatusItem::factory()->create([
         'title' => 'Customers',
         'type'  => 'files',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Enquiries',
         'type'  => 'files',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Quotes',
         'type'  => 'files',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Project',
         'type'  => 'files',
         'priority' => 4
      ]);
      StatusItem::factory()->create([
         'title' => 'Admin',
         'type'  => 'files',
         'priority' => 5
      ]);
      StatusItem::factory()->create([
         'title' => 'In Progress',
         'type'  => 'admin',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Pending',
         'type'  => 'admin',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Complete',
         'type'  => 'admin',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Archived',
         'type'  => 'admin',
         'priority' => 4
      ]);
/*
      StatusItem::factory()->create([
         'title' => 'Unpaid',
         'type'  => 'invoices',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Sent',
         'type'  => 'invoices',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Pending',
         'type'  => 'invoices',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Paid',
         'type'  => 'invoices',
         'priority' => 4
      ]);
*/
   }
}
<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StatusItem;

class StatusItemSeeder extends Seeder
{
   public function run()
   {
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

      StatusItem::factory()->create([
         'title' => 'To Chase',
         'type'  => 'customer',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Lead Only',
         'type'  => 'customer',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Current Customer',
         'type'  => 'customer',
         'priority' => 3
      ]);

      StatusItem::factory()->create([
         'title' => 'Received',
         'type'  => 'enquiry',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Replied',
         'type'  => 'enquiry',
         'priority' => 2
      ]);
            
      StatusItem::factory()->create([
         'title' => 'Customer',
         'type'  => 'file',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Enquiry',
         'type'  => 'file',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Quote',
         'type'  => 'file',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Project',
         'type'  => 'file',
         'priority' => 4
      ]);
      StatusItem::factory()->create([
         'title' => 'Admin',
         'type'  => 'file',
         'priority' => 5
      ]);

      StatusItem::factory()->create([
         'title' => 'In Progress',
         'type'  => 'project',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Pending',
         'type'  => 'project',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Complete',
         'type'  => 'project',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Archived',
         'type'  => 'project',
         'priority' => 4
      ]);

      StatusItem::factory()->create([
         'title' => 'Refused',
         'type'  => 'quote',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Requested',
         'type'  => 'quote',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Sent',
         'type'  => 'quote',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Accepted',
         'type'  => 'quote',
         'priority' => 4
      ]);

/*
      StatusItem::factory()->create([
         'title' => 'Unpaid',
         'type'  => 'invoice',
         'priority' => 1
      ]);
      StatusItem::factory()->create([
         'title' => 'Sent',
         'type'  => 'invoice',
         'priority' => 2
      ]);
      StatusItem::factory()->create([
         'title' => 'Pending',
         'type'  => 'invoice',
         'priority' => 3
      ]);
      StatusItem::factory()->create([
         'title' => 'Paid',
         'type'  => 'invoice',
         'priority' => 4
      ]);
*/
   }
}
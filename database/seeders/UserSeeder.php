<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
   public function run()
   {
      User::factory()->create([
         'name'         => 'Admin',
         'email'        => 'admin@admin.com',
         'password'     => bcrypt('password'),
         'account_type' => 'admin'
      ]);
      User::factory()->create([
         'name'         => 'Editor',
         'email'        => 'editor@edit.com',
         'password'     => bcrypt('password'),
         'account_type' => 'editor'
      ]);
   }
}
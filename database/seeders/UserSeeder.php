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
         'email'        => 'admin@email.com',
         'password'     => bcrypt('password'),
         'account_type' => 'admin'
      ]);
      User::factory()->create([
         'name'         => 'Editor',
         'email'        => 'editor@email.com',
         'password'     => bcrypt('password'),
         'account_type' => 'editor'
      ]);
      User::factory()->create([
         'name'         => 'User',
         'email'        => 'user@email.com',
         'password'     => bcrypt('password'),
         'account_type' => 'user'
      ]);
   }
}
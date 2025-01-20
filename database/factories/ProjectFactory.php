<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StatusItem;

class ProjectFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      $status_items = StatusItem::where('status_items.type','project')->get('id');

      return[
         'name'              => $this->faker->words(3,true),
         'date'              => $this->faker->date('Y_m_d'),
         'price'             => $this->faker->randomFloat(2),
         'project_reference' => $this->faker->word(),
         'project_status'    => $status_items->random()
      ];
   }
}
<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      return[
         'title'             => $this->faker->words(3,true),
         'date'              => $this->faker->date('Y_m_d'),
         'price'             => $this->faker->randomFloat(2),
         'project_reference' => $this->faker->word(),
         'project_status'    => 2
      ];
   }
}
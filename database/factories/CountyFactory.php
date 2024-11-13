<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountyFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      return[
         'title' => $this->faker->word()
      ];
   }
}
<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusItemFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      return[
         'title'     => $this->faker->words(2,true),
         'url'       => $this->faker->url(),
         'type'      => $this->faker->word(),
         'table_ref' => $this->faker->word(),
         'priority'  => $this->faker->randomDigit()
      ];
   }
}
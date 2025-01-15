<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      return[
         'subject' => $this->faker->words(3,true),
         'content' => $this->faker->paragraphs(2,true)
      ];
   }
}
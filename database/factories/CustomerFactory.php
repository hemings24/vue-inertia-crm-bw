<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\County;
use App\Models\StatusItem;

class CustomerFactory extends Factory
{
   /**
   *Define the model's default state.
   *
   *@return array<string,mixed>
   */
   public function definition(): array
   {
      $counties = County::pluck('id');
      $status_items = StatusItem::where('status_items.type','customer')->get('id');

      return[
         'company'         => $this->faker->company(),
         'title_prefix'    => $this->faker->title(),
         'first_name'      => $this->faker->firstName(),
         'last_name'       => $this->faker->lastName(),
         'address1'        => $this->faker->address(),
         'address2'        => null,
         'address3'        => null,
         'city'            => $this->faker->city(),
         'postcode'        => $this->faker->postcode(),
         'county'          => $counties->random(),
         'email'           => $this->faker->unique()->safeEmail(),
         'phone'           => $this->faker->phoneNumber(),
         'notes'           => $this->faker->text(200),
         'customer_status' => $status_items->random()
      ];
   }
}
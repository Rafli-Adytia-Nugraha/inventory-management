<?php

namespace Database\Factories;

use Carbon\Carbon;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'id' => $faker->uuid(),
            'supplier_name' => $faker->name(),
            'contact_information' => $faker->companyEmail(),
        ];
    }
}

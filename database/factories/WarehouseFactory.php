<?php

namespace Database\Factories;

use Faker\Factory;

class WarehouseFactory extends Factory
{
    public function definition(): array
    {
        $faker = Factory::create();
        return [
            'name' => $faker->company(),
            'location' => $faker->address(),
            'description' => $faker->sentence(),
        ];
    }
}

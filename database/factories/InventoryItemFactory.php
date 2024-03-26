<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Faker\Factory;

class InventoryItemFactory extends Factory
{
    public function definition(): array
    {
        $itemName = [
            'Product A',
            'Product B',
            'Product C',
            'Product D',
            'Product E',
            'Product F',
            'Product G',
            'Product H',
            'Product I',
            'Product J',
            'Product K',
            'Product L',
            'Product M',
            'Product N',
            'Product O',
            'Product P',
            'Product Q',
            'Product R',
            'Product S',
            'Product T',
            'Product U',
            'Product V',
            'Product W',
            'Product X',
            'Product Y',
            'Product Z',
        ];
        $faker = Factory::create();
        return [
            'item_name' => Arr::random($itemName),
            'description' => $faker->sentence(),
            'quantity_on_hand' => random_int(1, 99999),
            'unit_price' => random_int(100000, 9999999),
            'warehouse_id' => function (array $attributes) {
                return Warehouse::find($attributes['id'])->type;
            },
        ];
    }
}

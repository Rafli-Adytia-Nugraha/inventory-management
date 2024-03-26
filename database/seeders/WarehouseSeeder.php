<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Warehouse::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'name' => 'Warehouse A',
                'location' => 'Jakarta Pusat',
                'description' => 'Gudang 1',
            ],
            [
                'name' => 'Warehouse B',
                'location' => 'Jakarta Selatan',
                'description' => 'Gudang 2',
            ],
            [
                'name' => 'Warehouse C',
                'location' => 'Jakarta Timur',
                'description' => 'Gudang 3',
            ],
        ];

        foreach ($data as $value) {
            Warehouse::insert([
                'id' => Str::uuid(),
                'name' => $value['name'],
                'location' => $value['location'],
                'description' => $value['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Warehouse::factory()->count(20)->create();
    }
}

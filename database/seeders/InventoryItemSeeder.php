<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class InventoryItemSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        InventoryItem::truncate();
        Schema::enableForeignKeyConstraints();

        $warehouses = Warehouse::all();

        $data = [
            [
                'item_name' => 'Product A',
                'description' => 'Description A',
                'quantity_on_hand' => 100,
                'unit_price' => 500,
            ],
            [
                'item_name' => 'Product B',
                'description' => 'Description B',
                'quantity_on_hand' => 150,
                'unit_price' => 750,
            ],
            [
                'item_name' => 'Product C',
                'description' => 'Description C',
                'quantity_on_hand' => 75,
                'unit_price' => 900,
            ],
        ];

        foreach ($data as $value) {
            InventoryItem::insert([
                'id' => Str::uuid(),
                'item_name' => $value['item_name'],
                'description' => $value['description'],
                'quantity_on_hand' => $value['quantity_on_hand'],
                'unit_price' => $value['unit_price'],
                'warehouse_id' => $warehouses->pluck('id')->random(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // InventoryItem::factory()->count(20)->create();
    }
}

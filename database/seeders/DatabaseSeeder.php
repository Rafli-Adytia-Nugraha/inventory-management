<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\InventoryItemSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            InventoryItemSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Supplier::truncate();
        // Schema::enableForeignKeyConstraints();

        // $data = [
        //     [
        //         'supplier_name' => 'Supplier A',
        //         'contact_information' => 'supplier_a@gmail.com',
        //     ],
        //     [
        //         'supplier_name' => 'Supplier B',
        //         'contact_information' => 'supplier_b@gmail.com',
        //     ],
        //     [
        //         'supplier_name' => 'Supplier C',
        //         'contact_information' => 'supplier_c@gmail.com',
        //     ],
        // ];

        // foreach ($data as $value) {
        //     Supplier::insert([
        //         'id' => Str::uuid(),
        //         'supplier_name' => $value['supplier_name'],
        //         'contact_information' => $value['contact_information'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        $suppliers = Supplier::factory()->count(1000)->make()->toArray();
        $chunks = array_chunk($suppliers, 100);

        foreach ($chunks as $chunk) {
            Supplier::insert($chunk);
        }

        // Supplier::factory()->count(1000)->create();
    }
}

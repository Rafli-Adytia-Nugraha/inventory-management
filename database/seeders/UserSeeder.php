<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'id' => Str::uuid(),
            'username' => 'superadmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123'),
            'role_id' => Role::select('id')->first(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

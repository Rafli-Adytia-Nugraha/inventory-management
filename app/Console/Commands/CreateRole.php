<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

class CreateRole extends Command
{
    protected $signature = 'create:create-role';

    protected $description = 'Perintah untuk membuat role baru melalui php artisan';

    public function handle()
    {
        $input['name'] = $this->ask('Masukkan nama role');
        Role::create($input);
        $this->info('Role baru berhasil dibuat');
    }
}

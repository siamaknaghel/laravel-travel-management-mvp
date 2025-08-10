<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SetupRolesSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::updateOrCreate(['name' => 'partner', 'guard_name' => 'web']);
    }
}

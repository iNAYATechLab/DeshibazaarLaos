<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->upsert([
            ['name' => 'super_admin', 'display_name' => 'Super Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'customer', 'display_name' => 'Customer', 'created_at' => now(), 'updated_at' => now()],
        ], ['name'], ['display_name', 'updated_at']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@deshibazaar.com'],
            [
                'name' => 'DeshiBazaar Super Admin',
                'password' => Hash::make(env('SUPER_ADMIN_PASSWORD', 'password')),
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        );

        $admin->roles()->syncWithoutDetaching([
            Role::query()->where('name', 'super_admin')->value('id'),
        ]);
    }
}

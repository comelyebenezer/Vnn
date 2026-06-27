<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@vnn.ng'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@vnn.ng',
                'password' => Hash::make('password'),
                'designation' => 'Super Admin',
                'status' => 'active',
            ]
        );
        $superAdmin->assignRole('Super Admin');
    }
}

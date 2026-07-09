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
        $this->call(CategorySeeder::class);

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@vnn.ng'],
            [
                'name' => 'Comely Ebenezer',
                'email' => 'admin@vnn.ng',
                'password' => Hash::make('password'),
                'designation' => 'Super Admin',
                'status' => 'active',
            ]
        );
        $superAdmin->assignRole('Super Admin');

        $this->call(ArticleSeeder::class);
        $this->call(DocumentarySeeder::class);
        $this->call(LiveUpdateSeeder::class);
        $this->call(SettingSeeder::class);
    }
}

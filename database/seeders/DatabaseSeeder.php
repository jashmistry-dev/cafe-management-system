<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::create([
            'name' => 'Admin',
            'email' => 'admin@cafe.com',
            'mobile' => '9999999999',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'account_status' => 'active'
        ]);
        $this->call([
            AdminUserSeeder::class,
            TableSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}

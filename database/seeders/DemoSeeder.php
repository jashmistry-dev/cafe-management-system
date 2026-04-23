<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Table;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run()
    {
        // 🔥 CATEGORIES
        $bev = Category::create([
            'name' => 'Beverages',
            'status' => 1
        ]);

        $fast = Category::create([
            'name' => 'Fast Food',
            'status' => 1
        ]);

        $dessert = Category::create([
            'name' => 'Desserts',
            'status' => 1
        ]);

        // 🔥 MENU ITEMS
        MenuItem::create([
            'name' => 'Alfredo Pasta',
            'price' => 349,
            'category_id' => $fast->id,
            'image' => 'menu/Alfredo Pasta.jpg',
            'is_available' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'name' => 'White Sauce Pasta',
            'price' => 399,
            'category_id' => $fast->id,
            'image' => 'menu/white-sauce-pasta.jpg',
            'is_available' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'name' => 'Veg Burger',
            'price' => 189,
            'category_id' => $fast->id,
            'image' => 'menu/burger-1.jpg',
            'is_available' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'name' => 'Pink Sauce Pasta',
            'price' => 100,
            'category_id' => $fast->id,
            'image' => 'menu/Pink Sauce Pasta.jpg',
            'is_available' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'name' => 'Waffle',
            'price' => 139,
            'category_id' => $dessert->id,
            'image' => 'menu/waffle.jpg',
            'is_available' => 1,
            'status' => 1
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'table_number' => $i,
                'status' => 1
            ]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin.cafe@gmail.com',
            'mobile' => '9999999999',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'account_status' => 1
        ]);

        User::create([
            'name' => 'Dhruv Verma',
            'email' => 'dhruv.staff@gmail.com',
            'mobile' => '8888888888',
            'password' => Hash::make('123456'),
            'role' => 'staff',
            'account_status' => 1
        ]);
    }
}
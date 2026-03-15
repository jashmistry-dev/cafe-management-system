<?php

namespace Database\Seeders;

use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'Admin',
            'email'=>'admin.cafe@gmail.com',
            'mobile'=>'6352425355',
            'password'=>Hash::make('123456'),
            'role'=>'admin'
        ]);
    }
}

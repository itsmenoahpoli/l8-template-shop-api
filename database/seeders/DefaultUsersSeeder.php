<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer
        User::create([
            'first_name' => 'Lebron',
            'middle_name' => '',
            'last_name' => 'James',
            'email' => 'lebron@domain.com',
            'password' => bcrypt('1234567890')
        ]);

        // Admin
        User::create([
            'first_name' => 'admin',
            'middle_name' => '',
            'last_name' => 'user',
            'email' => 'admin@domain.com',
            'password' => bcrypt('1234567890')
        ]);

        // Manager
        User::create([
            'first_name' => 'Manager',
            'middle_name' => '',
            'last_name' => 'User',
            'email' => 'Manager@domain.com',
            'password' => bcrypt('1234567890')
        ]);

        // Employee
        User::create([
            'first_name' => 'Employee',
            'middle_name' => '',
            'last_name' => 'User',
            'email' => 'employee@domain.com',
            'password' => bcrypt('1234567890')
        ]);
    }
}

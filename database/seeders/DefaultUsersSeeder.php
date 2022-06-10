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

        // Manager

        // Employee
    }
}

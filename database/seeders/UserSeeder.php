<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User creation and assignment logic
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // You can change this to 'customer' to create a customer
        ]);

        if ($user->role === 'admin') {
            Admin::create([
                'user_id' => $user->id,
            ]);
        } elseif ($user->role === 'customer') {
            Customer::create([
                'user_id' => $user->id,
            ]);
        }
    }
}

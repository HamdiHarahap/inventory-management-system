<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['Admin', 'admin@gmail.com', 'admin'],
            ['Staff 1', 'staf1@gmail.com', 'staff'],
            ['Staff 2', 'staff2@gmail.com', 'staff'],
            ['Manager', 'manager@gmail.com', 'manager'],
        ];

        foreach ($users as [$name, $email, $role]) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('123'),
                'role' => $role,
            ]);
        }
    }
}

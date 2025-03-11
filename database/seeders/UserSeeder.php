<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'User 1', 'email' => 'user1@example.com', 'password' => 'User-0101'],
            ['name' => 'User 2', 'email' => 'user2@example.com', 'password' => 'User-0202'],
            ['name' => 'User 3', 'email' => 'user3@example.com', 'password' => 'User-0303'],
            ['name' => 'User 4', 'email' => 'user4@example.com', 'password' => 'User-0404'],
            ['name' => 'User 5', 'email' => 'user5@example.com', 'password' => 'User-0505'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}

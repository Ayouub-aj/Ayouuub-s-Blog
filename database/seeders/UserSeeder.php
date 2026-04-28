<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Ayoub', 'email' => 'blogger@blog.com', 'password' => 'password'],
            ['name' => 'Sara Dev', 'email' => 'sara@blog.com', 'password' => 'password'],
            ['name' => 'Yassine Ops', 'email' => 'yassine@blog.com', 'password' => 'password'],
            ['name' => 'Nora Writer', 'email' => 'nora@blog.com', 'password' => 'password'],
            ['name' => 'Ilyas Admin', 'email' => 'ilyas@blog.com', 'password' => 'password'],
        ];

        foreach ($users as $user) {
            \App\Models\User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}

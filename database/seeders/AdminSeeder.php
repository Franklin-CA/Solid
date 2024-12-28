<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Edison Sanchez',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345'), // Change to secure password
            'usertype' => 'admin',
        ]);   
    }
}

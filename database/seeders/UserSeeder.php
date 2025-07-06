<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; // ★これを追加してな！パスワードをハッシュ化するためや。

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', 
            'password' => Hash::make('password'), 
            
        ]);

        
    }
}
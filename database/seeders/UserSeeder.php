<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Sopiana',
            'email' => 'Sop@example.com',
            'password' => Hash::make('password123'), // password terenkripsi
        ]);

        User::create([
            'name' => 'Azmi',
            'email' => 'Azmi@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}

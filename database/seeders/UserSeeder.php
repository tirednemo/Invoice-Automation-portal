<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => 'John Doe',
            'email' => 'doejohn@gmail.com',
            'password' => '1234567890',
        ]);
    }
}

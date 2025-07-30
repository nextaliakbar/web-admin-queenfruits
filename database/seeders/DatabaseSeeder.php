<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'id' => 1,
            'name' => 'Ali Akbar Rafsanjani',
            'phone' => '+628123456789',
            'email' => 'aliakbarrafsanjani@example.com',
            'password' => Hash::make('12345678')
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'id' => 1,
            'name' => 'Queen Fruits Sumbersari',
            'telp' => '+628123456789',
            'email' => 'queenfruits@example.com',
            'preparation_time' => 30,
            'password' => Hash::make('12345678'),
            'branch_image' => 'def.png',
            'address' => 'Perumahan Gn. Batu, Kec. Sumbersari, Kab. Jember',
            'lat' => '-8.17668081629412',
            'lng' => '113.7121474542403',
            'coverage' => 10,
            'status' => 1,
            'promotion_campaign' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now() 
        ]);
    }
}

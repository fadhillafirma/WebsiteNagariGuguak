<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JorongSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jorong')->insert([
            [
                'user_id'     => 1,
                'nama_jorong' => 'Koto',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 1,
                'nama_jorong' => 'Padang Lalang',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 1, 
                'nama_jorong' => 'Bulu Rotan',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}

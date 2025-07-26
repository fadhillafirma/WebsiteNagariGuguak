<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LahanJenis; // Pastikan ini diimport
use App\Models\User;     // Jika user_id wajib di LahanJenis, import juga User

class LahanJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mendapatkan ID user pertama (asumsi ada user di database, misalnya admin)
        // Jika user_id di LahanJenis tidak boleh null, pastikan ada user.
        // Anda bisa membuat user default di DatabaseSeeder atau di seeder terpisah.
        $adminUser = User::first(); // Mengambil user pertama, bisa diganti dengan User::where('email', 'admin@example.com')->first();
        $userId = $adminUser ? $adminUser->id : null; // Mengambil ID user atau null jika tidak ada

        // Data dari "Kondisi Sawah Masyarakat"
        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Sawah Tadah Hujan'],
            [
                'user_id' => $userId,
                'kategori' => 'sawah',
                'deskripsi' => 'Lahan sawah yang pengairannya bergantung pada curah hujan.',
            ]
        );

        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Sawah Pengairan'],
            [
                'user_id' => $userId,
                'kategori' => 'sawah',
                'deskripsi' => 'Lahan sawah yang memiliki sistem pengairan terkelola.',
            ]
        );

        // Data dari "Kondisi Lahan Perkebunan"
        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Kebun Karet'],
            [
                'user_id' => $userId,
                'kategori' => 'perkebunan',
                'deskripsi' => 'Lahan perkebunan yang ditanami pohon karet.',
            ]
        );

        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Kebun Jeruk Nipis'],
            [
                'user_id' => $userId,
                'kategori' => 'perkebunan',
                'deskripsi' => 'Lahan perkebunan yang ditanami pohon jeruk nipis.',
            ]
        );

        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Kelapa'],
            [
                'user_id' => $userId,
                'kategori' => 'perkebunan',
                'deskripsi' => 'Lahan perkebunan yang ditanami pohon kelapa.',
            ]
        );

        LahanJenis::firstOrCreate(
            ['nama_lahan' => 'Kakao (coklat)'],
            [
                'user_id' => $userId,
                'kategori' => 'perkebunan',
                'deskripsi' => 'Lahan perkebunan yang ditanami pohon kakao.',
            ]
        );

        $this->command->info('Data LahanJenis berhasil ditambahkan/diperbarui!');
    }
}

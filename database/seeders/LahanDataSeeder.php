<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LahanJenis;
use App\Models\LahanData;

class LahanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = 2025;

        // Data berdasarkan tabel dari website
        $data = [
            'Sawah Tadah Hujan' => ['luas_ha' => 191, 'produktif_ha' => 183, 'tidak_produktif_ha' => 8],
            'Sawah Pengairan' => ['luas_ha' => 26, 'produktif_ha' => 26, 'tidak_produktif_ha' => 0],
            'Kebun Karet' => ['luas_ha' => 745, 'produktif_ha' => 432, 'tidak_produktif_ha' => 313],
            'Kebun Jeruk Nipis' => ['luas_ha' => 58, 'produktif_ha' => 49, 'tidak_produktif_ha' => 9],
            'Kelapa' => ['luas_ha' => 32, 'produktif_ha' => 16, 'tidak_produktif_ha' => 16],
            'Kakao (coklat)' => ['luas_ha' => 8, 'produktif_ha' => 3, 'tidak_produktif_ha' => 5],
        ];

        foreach ($data as $namaLahan => $values) {
            $lahanJenis = LahanJenis::where('nama_lahan', $namaLahan)->first();
            
            if ($lahanJenis) {
                LahanData::updateOrCreate(
                    ['lahan_jenis_id' => $lahanJenis->id_lahan_jenis, 'tahun' => $tahun],
                    $values
                );
            }
        }
        
        $this->command->info('Data LahanData (angka statistik) berhasil ditambahkan!');
    }
}

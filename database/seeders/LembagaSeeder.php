<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lembaga;
use App\Models\LembagaBerita;
use App\Models\LembagaProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LembagaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin UPZ
        $adminUpz = User::firstOrCreate(
            ['email' => 'admin.upz@guguak.id'],
            [
                'name' => 'Admin UPZ',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Buat Lembaga UPZ
        $upz = Lembaga::updateOrCreate(
            ['subdomain' => 'upz'],
            [
                'user_id' => $adminUpz->id,
                'nama_lembaga' => 'Unit Pengumpul Zakat (UPZ)',
                'deskripsi' => 'Lembaga pengelola zakat infaq dan sedekah terpercaya di Nagari Guguak.',
                'nama_ketua' => 'H. Fulan, Lc',
            ]
        );

        // 3. Buat Data Program UPZ
        LembagaProgram::firstOrCreate(
            ['lembaga_id' => $upz->id, 'nama_program' => 'Santunan Fakir Miskin'],
            [
                'kategori' => 'Santunan',
                'deskripsi' => 'Bantuan langsung tunai dan sembako kepada warga berhak',
                'penerima_manfaat' => '320 orang',
                'alokasi_dana' => 25000000,
                'status' => 'aktif',
                'tanggal_mulai' => '2025-01-01',
            ]
        );

        LembagaProgram::firstOrCreate(
            ['lembaga_id' => $upz->id, 'nama_program' => 'Beasiswa Pendidikan SD-SMA'],
            [
                'kategori' => 'Pendidikan',
                'deskripsi' => 'Dukungan biaya pendidikan siswa berprestasi dari keluarga kurang mampu',
                'penerima_manfaat' => '15 siswa',
                'alokasi_dana' => 15000000,
                'status' => 'aktif',
                'tanggal_mulai' => '2025-02-01',
            ]
        );

        // 4. Buat Data Berita UPZ
        LembagaBerita::firstOrCreate(
            ['lembaga_id' => $upz->id, 'judul' => 'Penyaluran Zakat Fitrah 1446H Resmi Dimulai'],
            [
                'isi_berita' => 'Ratusan keluarga penerima manfaat mulai menerima bantuan zakat fitrah. Penyaluran ini dilakukan secara bertahap di berbagai jorong di Nagari Guguak.',
                'kategori' => 'Kegiatan',
                'penulis' => 'Admin UPZ',
                'status' => 'tayang',
                'tanggal_tayang' => now(),
            ]
        );

        LembagaBerita::firstOrCreate(
            ['lembaga_id' => $upz->id, 'judul' => 'Laporan Keuangan Triwulan I 2025 Dipublikasikan'],
            [
                'isi_berita' => 'Sebagai bentuk transparansi, UPZ mempublikasikan laporan keuangan secara terbuka. Masyarakat dapat melihat rincian pemasukan dan pengeluaran.',
                'kategori' => 'Transparansi',
                'penulis' => 'Admin UPZ',
                'status' => 'tayang',
                'tanggal_tayang' => now()->subDays(10),
            ]
        );
    }
}

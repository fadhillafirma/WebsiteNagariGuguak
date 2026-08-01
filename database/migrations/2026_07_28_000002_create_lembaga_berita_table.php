<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel berita khusus untuk lembaga-lembaga di bawah Nagari Guguak.
     * Dipisah dari tabel 'publikasi' milik nagari untuk menjaga normalisasi (3NF).
     * Relasi: satu lembaga memiliki banyak berita (hasMany).
     */
    public function up(): void
    {
        Schema::create('lembaga_berita', function (Blueprint $table) {
            $table->id();

            // FK ke tabel lembagas: berita ini milik lembaga mana?
            $table->foreignId('lembaga_id')
                  ->constrained('lembagas')
                  ->cascadeOnDelete();

            $table->string('judul', 255);
            $table->text('isi_berita');
            $table->string('foto', 255)->nullable();                // path file foto sampul
            $table->string('kategori', 100)->default('Umum');       // contoh: Kegiatan, Transparansi, dll
            $table->string('penulis', 100)->nullable();
            $table->enum('status', ['tayang', 'draf'])->default('draf');
            $table->timestamp('tanggal_tayang')->nullable();        // waktu dipublikasikan

            $table->timestamps();

            // Index untuk query yang sering: ambil berita per lembaga, filter by status
            $table->index(['lembaga_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga_berita');
    }
};

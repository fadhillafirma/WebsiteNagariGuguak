<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel program kerja khusus untuk lembaga-lembaga di bawah Nagari Guguak.
     * Setiap lembaga (UPZ, BUMNag, dll) bisa memiliki program kerjanya sendiri.
     * Relasi: satu lembaga memiliki banyak program (hasMany).
     */
    public function up(): void
    {
        Schema::create('lembaga_program', function (Blueprint $table) {
            $table->id();

            // FK ke tabel lembagas: program ini milik lembaga mana?
            $table->foreignId('lembaga_id')
                  ->constrained('lembagas')
                  ->cascadeOnDelete();

            $table->string('nama_program', 255);
            $table->string('kategori', 100)->nullable();            // contoh: Santunan, Pendidikan, Kesehatan
            $table->text('deskripsi')->nullable();
            $table->string('penerima_manfaat', 100)->nullable();    // contoh: "320 orang"
            $table->decimal('alokasi_dana', 15, 2)->nullable();     // dalam rupiah
            $table->string('foto', 255)->nullable();                // dokumentasi program
            $table->enum('status', ['aktif', 'selesai', 'draf'])->default('draf');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();

            // Index untuk query per lembaga dan per status
            $table->index(['lembaga_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga_program');
    }
};

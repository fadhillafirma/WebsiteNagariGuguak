<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Copy data from bpn_berita to lembaga_berita
        if (Schema::hasTable('bpn_berita') && Schema::hasTable('lembaga_berita')) {
            DB::statement('
                INSERT INTO lembaga_berita (lembaga_id, judul, isi_berita, foto, dokumen, kategori, penulis, status, tanggal_tayang, created_at, updated_at)
                SELECT lembaga_id, judul, isi_berita, foto, dokumen, kategori, penulis, status, tanggal_tayang, created_at, updated_at
                FROM bpn_berita
            ');
        }

        // Copy data from bpn_program to lembaga_program
        if (Schema::hasTable('bpn_program') && Schema::hasTable('lembaga_program')) {
            DB::statement('
                INSERT INTO lembaga_program (lembaga_id, nama_program, kategori, deskripsi, penerima_manfaat, alokasi_dana, foto, status, tanggal_mulai, tanggal_selesai, created_at, updated_at)
                SELECT lembaga_id, nama_program, kategori, deskripsi, penerima_manfaat, alokasi_dana, foto, status, tanggal_mulai, tanggal_selesai, created_at, updated_at
                FROM bpn_program
            ');
        }

        // Drop the old tables
        Schema::dropIfExists('bpn_berita');
        Schema::dropIfExists('bpn_program');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate tables and copy data back if needed (basic recreation for rollback)
        Schema::create('bpn_berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lembaga_id')->constrained('lembagas')->cascadeOnDelete();
            $table->string('judul', 255);
            $table->text('isi_berita');
            $table->string('foto', 255)->nullable();
            $table->string('dokumen', 255)->nullable();
            $table->string('kategori', 100)->default('Umum');
            $table->string('penulis', 100)->nullable();
            $table->enum('status', ['tayang', 'draf'])->default('draf');
            $table->timestamp('tanggal_tayang')->nullable();
            $table->timestamps();
        });

        Schema::create('bpn_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lembaga_id')->constrained('lembagas')->cascadeOnDelete();
            $table->string('nama_program', 255);
            $table->string('kategori', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('penerima_manfaat', 100)->nullable();
            $table->decimal('alokasi_dana', 15, 2)->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['aktif', 'selesai', 'draf'])->default('aktif');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
        
        // Cannot reliably separate the merged data, so rollback leaves the copied data in lembaga_berita
    }
};

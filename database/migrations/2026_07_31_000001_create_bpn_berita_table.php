<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bpn_berita', function (Blueprint $table) {
            $table->id();
            
            // FK ke tabel lembagas: berita ini milik lembaga (BPN)
            $table->foreignId('lembaga_id')
                  ->constrained('lembagas')
                  ->cascadeOnDelete();

            $table->string('judul', 255);
            $table->text('isi_berita');
            $table->string('foto', 255)->nullable();
            $table->string('dokumen', 255)->nullable();
            $table->string('kategori', 100)->default('Umum');
            $table->string('penulis', 100)->nullable();
            $table->enum('status', ['tayang', 'draf'])->default('draf');
            $table->timestamp('tanggal_tayang')->nullable();

            $table->timestamps();
            
            $table->index(['lembaga_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpn_berita');
    }
};

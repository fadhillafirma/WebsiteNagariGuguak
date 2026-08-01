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
        Schema::create('bpn_program', function (Blueprint $table) {
            $table->id();

            // FK ke tabel lembagas: program ini milik lembaga (BPN)
            $table->foreignId('lembaga_id')
                  ->constrained('lembagas')
                  ->cascadeOnDelete();

            $table->string('nama_program', 255);
            $table->string('kategori', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('penerima_manfaat', 100)->nullable();
            $table->decimal('alokasi_dana', 15, 2)->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['aktif', 'selesai', 'draf'])->default('draf');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();

            $table->index(['lembaga_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpn_program');
    }
};

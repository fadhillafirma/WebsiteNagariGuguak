<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publikasi', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul', 255);
            $table->string('penulis', 100)->nullable(); // ← kolom tambahan
            $table->text('deskripsi');
            $table->string('foto', 255)->nullable();
            $table->enum('jenis', ['artikel', 'berita']);
            $table->dateTime('tanggal_update')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'jenis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publikasi');
    }
};

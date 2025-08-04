<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('nama_lembaga')->nullable();
            $table->string('foto_lembaga')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('nama_ketua');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembagas');
    }
};


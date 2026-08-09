<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            $table->dateTime('tanggal_post')->nullable()->after('gambar');
        });

        Schema::table('galeri', function (Blueprint $table) {
            $table->dateTime('tanggal_post')->nullable()->after('deskripsi');
        });

        // Isi tanggal_post dengan created_at untuk data yang sudah ada
        DB::table('potensis')->whereNull('tanggal_post')->update([
            'tanggal_post' => DB::raw('created_at'),
        ]);
        DB::table('galeri')->whereNull('tanggal_post')->update([
            'tanggal_post' => DB::raw('created_at'),
        ]);
    }

    public function down(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            $table->dropColumn('tanggal_post');
        });

        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('tanggal_post');
        });
    }
};

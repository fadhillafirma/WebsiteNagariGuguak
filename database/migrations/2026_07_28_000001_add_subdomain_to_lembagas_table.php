<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom 'subdomain' ke tabel lembagas yang sudah ada.
     * Kolom ini menjadi penghubung antara URL (upz.localhost) dan data lembaga di database.
     * Dibuat nullable dulu agar data lama tidak error, lalu diisi setelah migrasi.
     */
    public function up(): void
    {
        Schema::table('lembagas', function (Blueprint $table) {
            // Kolom subdomain: unik per lembaga, contoh: 'upz', 'bumnag', 'kopdes'
            $table->string('subdomain', 50)->nullable()->unique()->after('nama_lembaga');
        });
    }

    public function down(): void
    {
        Schema::table('lembagas', function (Blueprint $table) {
            $table->dropUnique(['subdomain']);
            $table->dropColumn('subdomain');
        });
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demografi_penduduk_jorong', function (Blueprint $table) {
            $table->id('id_penduduk_jorong');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('jorong_id')->constrained('jorong','id_jorong')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedInteger('kk')->default(0);
            $table->unsignedInteger('laki_laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->timestamps();
            // Satu user, satu jorong, satu tahun -> satu baris
            $table->unique(['user_id','jorong_id','tahun'], 'dem_pendudukjorong_user_jorong_tahun_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('demografi_penduduk_jorong');
    }
};

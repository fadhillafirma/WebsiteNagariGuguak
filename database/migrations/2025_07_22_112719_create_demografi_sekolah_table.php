<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demografi_sekolah', function (Blueprint $table) {
            $table->id('id_sekolah');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedInteger('jumlah_smp')->default(0);
            $table->unsignedInteger('jumlah_sma')->default(0);
            $table->unsignedInteger('jumlah_sd')->default(0);
            $table->unsignedInteger('jumlah_paud')->default(0);
            $table->timestamps();
            $table->unique(['user_id','tahun'], 'dem_sekolah_user_tahun_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('demografi_sekolah');
    }
};

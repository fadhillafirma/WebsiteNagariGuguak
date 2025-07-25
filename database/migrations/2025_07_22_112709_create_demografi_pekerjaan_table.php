<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demografi_pekerjaan', function (Blueprint $table) {
            $table->id('id_pekerjaan');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedInteger('petani')->default(0);
            $table->unsignedInteger('pegawai_negeri')->default(0);
            $table->unsignedInteger('karyawan_swasta')->default(0);
            $table->unsignedInteger('pedagang')->default(0);
            $table->unsignedInteger('tni')->default(0);
            $table->unsignedInteger('pensiunan')->default(0);
            $table->unsignedInteger('aparat_pemerintahan')->default(0);
            $table->unsignedInteger('pekerjaan_lain')->default(0);
            $table->timestamps();
            $table->unique(['user_id','tahun'], 'dem_pekerjaan_user_tahun_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('demografi_pekerjaan');
    }
};

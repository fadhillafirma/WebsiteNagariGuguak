<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lahan_data', function (Blueprint $table) {
            $table->id('id_lahan_data');
            $table->foreignId('lahan_jenis_id')->constrained('lahan_jenis','id_lahan_jenis')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->decimal('luas_ha', 12, 2)->default(0);
            $table->decimal('produktif_ha', 12, 2)->default(0);
            $table->decimal('tidak_produktif_ha', 12, 2)->default(0);
            $table->timestamps();
            $table->unique(['lahan_jenis_id','tahun'], 'lahandata_jenis_tahun_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('lahan_data');
    }
};

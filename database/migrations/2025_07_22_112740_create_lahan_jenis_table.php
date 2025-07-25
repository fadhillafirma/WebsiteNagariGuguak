<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lahan_jenis', function (Blueprint $table) {
            $table->id('id_lahan_jenis');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_lahan', 255);
            $table->enum('kategori', ['sawah','perkebunan','lainnya']);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->unique(['user_id','nama_lahan'], 'lahanjenis_user_nama_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('lahan_jenis');
    }
};

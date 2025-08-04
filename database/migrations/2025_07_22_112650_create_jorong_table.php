<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('jorong', function (Blueprint $table) {
            $table->id('id_jorong');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_jorong', 191);
            $table->string('kepala_jorong', 191)->nullable();
            $table->text('deskripsi_jorong')->nullable();
            $table->string('foto_kepala_jorong')->nullable();
            $table->timestamps();
            $table->unique(['user_id','nama_jorong'], 'jorong_user_nama_unique');
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('jorong');
    }
};


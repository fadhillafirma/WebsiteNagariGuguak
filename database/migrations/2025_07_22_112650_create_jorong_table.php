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
            $table->timestamps();
            // Satu user tidak boleh punya nama jorong ganda
            $table->unique(['user_id','nama_jorong'], 'jorong_user_nama_unique');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jorong');
    }
};


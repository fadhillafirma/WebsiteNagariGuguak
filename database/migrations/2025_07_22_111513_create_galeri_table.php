<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id('id_foto');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('foto', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->index('user_id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
?>

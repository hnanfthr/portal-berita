<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // Relasi: Berita ini masuk kategori apa?
            $table->foreignId('category_id');
            // Relasi: Siapa penulisnya? (User ID)
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug')->unique(); // Judul buat di URL
            $table->text('excerpt'); // Cuplikan pendek berita
            $table->text('body'); // Isi berita full
            $table->string('image')->nullable(); // Foto berita (boleh kosong)
            $table->timestamp('published_at')->nullable(); // Kapan terbit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Relasi: Komentar ini milik User siapa?
            $table->foreignId('user_id'); 
            // Relasi: Komentar ini ada di Berita (Post) mana?
            $table->foreignId('post_id');
            // Isi komentarnya
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
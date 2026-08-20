<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Komentar dimiliki oleh User (Penulis Komentar)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Komentar dimiliki oleh Post (Berita)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
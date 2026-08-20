<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'title' => 'Semua Berita',
            // Ambil berita terbaru + filter pencarian + pagination 7 per halaman
            // withQueryString() penting biar pas pindah halaman, kata kunci pencarian gak ilang
            'posts' => Post::latest()->filter(request(['search']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'title' => $post->title,
            'post' => $post
        ]);
    }
}
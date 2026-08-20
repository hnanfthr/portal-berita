<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi: Komentar tidak boleh kosong
        $validatedData = $request->validate([
            'post_id' => 'required',
            'body' => 'required'
        ]);

        // 2. Tambahkan User ID (siapa yang komen)
        $validatedData['user_id'] = auth()->user()->id;

        // 3. Simpan ke Database
        Comment::create($validatedData);

        // 4. Balik ke halaman berita tadi
        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
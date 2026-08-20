<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ $post->title }} | Portal Berita</title>
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm mb-4">
      <div class="container">
        <a class="navbar-brand fw-bold" href="/">PORTAL BERITA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Halo, {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/dashboard">Dashboard Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            @endauth

          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <h1 class="mb-3 fw-bold">{{ $post->title }}</h1>

                    <p class="text-muted">
                        By: <a href="/authors/{{ $post->author->id }}" class="text-decoration-none fw-bold text-danger">{{ $post->author->name }}</a> 
                        | Kategori: <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none badge bg-secondary">{{ $post->category->name }}</a>
                        | {{ $post->created_at->diffForHumans() }}
                    </p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid my-3 rounded w-100" alt="{{ $post->category->name }}">
                    @else
                        <img src="https://source.unsplash.com/1200x400/?{{ $post->category->slug }}" class="img-fluid my-3 rounded w-100" alt="{{ $post->category->name }}">
                    @endif

                    <article class="my-3 fs-5 lh-lg">
                        {!! $post->body !!} 
                    </article>

                    <div class="mt-5 border-top pt-3">
                        <a href="/" class="btn btn-outline-danger">&larr; Kembali ke Home</a>
                    </div>
                </div>

                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <h4 class="mb-4 fw-bold">Komentar ({{ $post->comments->count() }})</h4>

                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @auth
                    <form action="/comments" method="post" class="mb-4">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-3">
                            <label for="body" class="form-label">Tulis Komentar Anda</label>
                            <textarea class="form-control" name="body" rows="3" required placeholder="Apa pendapatmu tentang berita ini?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>
                    @else
                    <div class="alert alert-warning text-center">
                        Silakan <a href="/login" class="fw-bold text-decoration-none">Login</a> untuk menulis komentar.
                    </div>
                    @endauth

                    <hr>

                    @if($post->comments->count())
                        @foreach ($post->comments as $comment)
                        <div class="d-flex mb-3 mt-4">
                            <div class="flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ $comment->author->name }}&background=random" class="rounded-circle" width="50" alt="...">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">{{ $comment->author->name }}</h6>
                                <p class="text-muted small mb-1">{{ $comment->created_at->diffForHumans() }}</p>
                                <p class="mb-0">{{ $comment->body }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted my-4">Belum ada komentar. Jadilah yang pertama!</p>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
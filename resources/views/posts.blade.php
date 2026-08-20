<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>Portal Berita Kita</title>
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm fixed-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="/">PORTAL BERITA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
            </li>

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

    <div class="container" style="margin-top: 100px">
        <div class="text-center mb-4" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="fw-bold">{{ $title }}</h1>
            <p class="text-muted">Menyajikan berita terkini, tajam, dan terpercaya</p>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <form action="/">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari berita di sini..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-danger" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @if($posts->count())
                @foreach ($posts as $index => $post)
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card h-100 shadow border-0 overflow-hidden">
                        
                        <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0,0,0,0.7); border-bottom-right-radius: 10px;">
                            <a href="/categories/{{ $post->category->slug }}" class="text-white text-decoration-none small">
                                {{ $post->category->name }}
                            </a>
                        </div>
                        
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->category->name }}" style="height: 250px; object-fit: cover;">
                        @else
                            <img src="https://source.unsplash.com/800x600/?{{ $post->category->slug }}" class="card-img-top" alt="{{ $post->category->name }}" style="height: 250px; object-fit: cover;">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark fw-bold">{{ $post->title }}</a>
                            </h5>
                            
                            <p class="small text-muted mb-2">
                                By: <a href="/authors/{{ $post->author->id }}" class="text-decoration-none text-danger">{{ $post->author->name }}</a> 
                                | {{ $post->created_at->diffForHumans() }}
                            </p>

                            <p class="card-text text-secondary">{{ $post->excerpt }}</p>
                            
                            <a href="/posts/{{ $post->slug }}" class="btn btn-danger btn-sm w-100 mt-2">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="fs-4 text-muted">Maaf, berita tidak ditemukan.</p>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center mt-4 mb-5">
            {{ $posts->links() }}
        </div>

    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">&copy; 2025 Portal Berita. Built with Laravel & Bootstrap.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
  </body>
</html>
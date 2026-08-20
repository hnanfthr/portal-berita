<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Berita | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .sidebar { min-height: 100vh; background-color: #f8f9fa; }
        .nav-link.active { background-color: #dc3545; color: white !important; }
        .nav-link { color: #333; }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-dark bg-danger sticky-top flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">PORTAL BERITA</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse pt-3">
          <div class="position-sticky sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link active" href="/dashboard/posts">Postingan Saya</a></li>
            </ul>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detail Berita</h1>
          </div>

          <div class="col-lg-8">
              
              <div class="mb-3">
                  <a href="/dashboard/posts" class="btn btn-success"><i class="bi bi-arrow-left"></i> Kembali</a>
                  <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                  <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-x-circle"></i> Hapus</button>
                  </form>
              </div>

              <article class="my-3">
                <h2 class="mb-3">{{ $post->title }}</h2>
                
                <div style="max-height: 350px; overflow:hidden;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
                    @else
                        <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
                    @endif
                </div>

                <div class="mt-3 fs-5">
                    {!! $post->body !!}
                </div>
              </article>
          
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Berita Baru | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <style>
        .sidebar { min-height: 100vh; background-color: #f8f9fa; }
        .nav-link.active { background-color: #dc3545; color: white !important; }
        .nav-link { color: #333; }
        
        /* Hilangkan tombol upload file di Trix (karena kita belum handle fiturnya) */
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
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
            <h1 class="h2">Buat Berita Baru</h1>
          </div>

          <div class="col-lg-8">
              <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
                @csrf 

                <div class="mb-3">
                  <label for="title" class="form-label">Judul Berita</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
                  @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}" readonly>
                </div>

                <div class="mb-3">
                  <label for="category" class="form-label">Kategori</label>
                  <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="image" class="form-label">Upload Gambar</label>
                  <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                  @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="body" class="form-label">Isi Berita</label>
                  
                  <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                  <trix-editor input="body"></trix-editor>
                  
                  @error('body') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Berita</button>
              </form>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('keyup', function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });

        // Matikan fitur upload file Trix (biar ga error karena kita belum bikin controller uploadnya)
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
  </body>
</html>
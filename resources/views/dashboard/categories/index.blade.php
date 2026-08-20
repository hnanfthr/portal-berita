<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori | Dashboard</title>
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
      <div class="navbar-nav">
         <div class="nav-item text-nowrap">
            <form action="/logout" method="post" class="px-3">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm px-4">Logout</button>
            </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse pt-3">
          <div class="position-sticky sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="/dashboard/posts">Postingan Saya</a></li>
              <li class="nav-item"><a class="nav-link active" href="/dashboard/categories">Kategori Berita</a></li>
            </ul>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
          <h2 class="mb-3">Kategori Berita</h2>

          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <div class="table-responsive col-lg-6">
            <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Tambah Kategori</a>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Kategori</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                    <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Yakin hapus?')"><i class="bi bi-x-circle"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
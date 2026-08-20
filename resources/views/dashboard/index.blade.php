<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .sidebar { min-height: 100vh; background-color: #f8f9fa; }
        .nav-link.active { background-color: #dc3545; color: white !important; }
        .nav-link { color: #333; }
        .nav-link:hover { background-color: #e9ecef; }
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
              
              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                  Dashboard
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                  Postingan Saya
                </a>
              </li>

              @can('admin')
              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                  Kategori Berita
                </a>
              </li>
              @endcan

            </ul>
            
             <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              <span>User Profile</span>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item"><a class="nav-link" href="/">Kembali ke Website</a></li>
            </ul>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Halo, {{ auth()->user()->name }}!</h1>
          </div>
          
           <div class="row">
              <div class="col-md-4">
                  <div class="card text-bg-primary mb-3">
                      <div class="card-header">Total Berita Saya</div>
                      <div class="card-body">
                          <h1 class="card-title">{{ auth()->user()->posts->count() }}</h1>
                          <p class="card-text">Artikel telah diterbitkan.</p>
                      </div>
                  </div>
              </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
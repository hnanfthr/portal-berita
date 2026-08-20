<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login | Portal Berita</title>
    
    <style>
        .form-signin {
            max-width: 400px;
            padding: 15px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
  </head>
  <body class="bg-light">

    <div class="container">
        <main class="form-signin bg-white shadow rounded">
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <h1 class="h3 mb-3 fw-normal text-center">Silakan Login</h1>
            
            <form action="/login" method="post">
                @csrf <div class="form-floating mb-2">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-danger" type="submit">Masuk</button>
            </form>
            
            <small class="d-block text-center mt-3">
                Belum punya akun? <a href="/register">Daftar Sekarang!</a> (Nanti dulu ya)
            </small>
            <small class="d-block text-center mt-2">
                <a href="/">Kembali ke Home</a>
            </small>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
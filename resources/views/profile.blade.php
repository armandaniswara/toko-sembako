<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Home</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
          rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<x-navbar></x-navbar>
>
<body class="bg-coffe py-5">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Profile</h3>
                    <div>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama</label>
                            {{-- Mengisi value dengan data user yang login --}}
                            <input type="text" class="form-control bg-light" id="name"
                                   value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="text" class="form-control bg-light" id="email"
                                   value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label fw-bold">No Telepon</label>
                            {{-- Menggunakan kolom 'telephone' dan null coalescing operator --}}
                            <input type="text" class="form-control bg-light" id="telephone"
                                   value="{{ Auth::user()->telephone ?? 'Belum diisi' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-bold">Alamat</label>
                            <input type="text" class="form-control bg-light" id="alamat"
                                   value="{{ Auth::user()->alamat ?? 'Belum diisi' }}" readonly>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    feather.replace();
</script>

</html>

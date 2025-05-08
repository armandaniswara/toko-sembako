<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Profile</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>
</head>
<nav class="d-flex justify-content-between align-items-center px-5 py-3"
     style="background-color: rgba(1,1,1,0.8); border-bottom: 1px solid #684e34; position: fixed; top: 0; left: 0; right: 0; z-index: 9999; ">
    <div class="d-flex align-items-center">
    <a href="/" class="text-a fs-3 me-3"><i class="fa-solid fa-arrow-left"></i></a>
    <a href="" class="fs-2 fw-bold text-light text-decoration-none fst-italic ff-popins" style="">Sembako<span class="text-coffe" style="color: #b98a55;">Plus.</span></a>
    </div>
    <a href="" class="text-white text-decoration-none ff-popins rounded-4 bg-danger py-2 px-3 float-end">Logout</a>
</nav>
<body class="bg-coffe py-5">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Profile</h3>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="notelpon" class="form-label">No Telpon</label>
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <p></p>
                        </div>
                        <div class="d-grid">
                            <button onclick="tampilkan()" type="submit" class="btn-custom border-0 rounded-3 py-1 px-2">Ubah Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="targetDiv" class=" mt-5" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Update Profile</h3>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your full name">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi password">
                        </div>
                        <div class="mb-3">
                            <label for="notelepon" class="form-label">No Telepon</label>
                            <input type="notelepon" class="form-control" id="telepon" placeholder="Ubah No Telepon">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="alamat" class="form-control" id="alamat" placeholder="Ubah Alamat">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function tampilkan() {
        document.getElementById('targetDiv').style.display = 'block';
    }
</script>
</html>

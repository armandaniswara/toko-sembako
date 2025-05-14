<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>
</head>
<nav class="d-flex justify-content-between align-items-center px-5 py-3"
     style="background-color: rgba(1,1,1,0.8); border-bottom: 1px solid #684e34; position: fixed; top: 0; left: 0; right: 0; z-index: 9999; ">

    <a href="#" class="fs-2 fw-bold text-light text-decoration-none fst-italic ff-popins " style="">Sembako<span class="text-coffe" style="color: #b98a55;">Plus.</span></a>
    <ul class="d-flex list-unstyled mb-0 gap-4 me-custom">
        <li><a href="/" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Home</a></li>
        <li><a href="#about" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Tentang Kami</a></li>
        <li><a href="#belanja" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Pergi Belanja</a></li>
        <li><a href="#contact" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Kontak</a></li>
    </ul>



    {{--    @auth--}}
    {{--        <form method="POST" action="{{ route('logout') }}">--}}
    {{--            @csrf--}}
    {{--            <button type="submit" class="btn btn-danger">Logout</button>--}}
    {{--        </form>--}}
    {{--    @endauth--}}


</nav>

<body class="bg-light p-custom ps-5 text-dark">
    <div class="bg-white mx-5 rounded-1 shadow d-flex align-items-center justify-content-around" style="width: 88%; height: 50px;">
        <div class=" d-flex">
            <input class="ms-5" type="checkbox" value="" id="defaultCheck1">
            <label class="ms-4" for="defaultCheck1">
                Produk
            </label>
        </div>
        <label class="ms-5">Harga Satuan</label>
        <div class="d-flex align-items-center">
            <label class="">Kuantitas</label>
            <label class="ms-5">Total Harga</label>
            <label class="ms-5" >Aksi</label>
        </div>
    </div>
    <div class="bg-white mx-5 my-3 rounded-1 shadow d-flex align-items-center justify-content-around" style="width: 88%; height: 200px;">
            <div class=" d-flex">
                <input class="" type="checkbox" value="" id="defaultCheck1">
                <label class="ms-4" for="defaultCheck1">
                    Produk
                </label>
            </div>
            <label class="ms-5">Harga Satuan</label>
            <div class="d-flex align-items-center">
                <label class="">Kuantitas</label>
                <label class="ms-5">Total Harga</label>
                <label class="ms-5" >Hapus</label>
            </div>

    </div>
    <div class="bg-white mx-5 my-3 rounded-1 shadow d-flex align-items-center justify-content-around" style="width: 88%; height: 200px;">
        <div class=" d-flex">
            <input class="" type="checkbox" value="" id="defaultCheck1">
            <label class="ms-4" for="defaultCheck1">
                Produk
            </label>
        </div>
        <label class="ms-5">Harga Satuan</label>
        <div class="d-flex align-items-center">
            <label class="">Kuantitas</label>
            <label class="ms-5">Total Harga</label>
            <label class="ms-5" >Hapus</label>
        </div>
    </div>
    <div class="bg-white mx-5 my-3 rounded-1 shadow d-flex align-items-center justify-content-around" style="width: 88%; height: 200px;">
        <div class=" d-flex">
            <input class="" type="checkbox" value="" id="defaultCheck1">
            <label class="ms-4" for="defaultCheck1">
                Produk
            </label>
        </div>
        <label class="ms-5">Harga Satuan</label>
        <div class="d-flex align-items-center">
            <label class="">Kuantitas</label>
            <label class="ms-5">Total Harga</label>
            <label class="ms-5" >Hapus</label>
        </div>
    </div>
</body>
<div class="position-fixed d-flex align-items-center bg-white rounded-1 shadow justify-content-between bottom-0 start-50 translate-middle-x mb-3" style="width: 85%; height: 50px;">
    <div class=" d-flex">
        <input class="ms-5" type="checkbox" value="" id="defaultCheck1">
        <label class="ms-4" for="defaultCheck1">
            Pilih Semua (item)
        </label>
        <label class="ms-5">Hapus</label>
    </div>
    <div class="d-flex align-items-center">
    <label>Total(0 produk):</label>
        <label class="me-2">Rp.0</label>
    <button class="btn-custom border-0 rounded-2 d-flex align-items-center justify-content-center me-5" style=" width: 125px; height: 35px;">
        Checkout
    </button>
    </div>

</div>
</html>

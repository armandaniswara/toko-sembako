<nav class="d-flex justify-content-between align-items-center px-5 py-3"
     style="background-color: rgba(1,1,1,0.8); border-bottom: 1px solid #684e34; position: fixed; top: 0; left: 0; right: 0; z-index: 9999; ">

    <a href="#" class="fs-2 fw-bold text-light text-decoration-none fst-italic ff-popins" style="">Sembako<span
            class="text-coffe" style="color: #b98a55;">Plus.</span></a>
    <ul class="d-flex list-unstyled mb-0 gap-4">
        <li><a href="#home" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Home</a></li>
        <li><a href="#about" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Tentang Kami</a></li>
        <li><a href="#belanja" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Pergi Belanja</a></li>
        <li><a href="#contact" class="text-decoration-none fs-5 text-a ff-popins fw-bold">Kontak</a></li>
    </ul>

    @guest
        <a href="/login"
           class="d-flex text-decoration-none rounded-4 text-light bg-coffee fs-6 py-2 px-4  hover:bg-brown ff-popins fw-bold ms-5 ">Login</a>
    @endguest

    {{--    @auth--}}
    {{--        <form method="POST" action="{{ route('logout') }}">--}}
    {{--            @csrf--}}
    {{--            <button type="submit" class="btn btn-danger">Logout</button>--}}
    {{--        </form>--}}
    {{--    @endauth--}}

    <div class="navbar-extra">
        <a href="/checkout" id="shopping-cart" class="text-a me-3"><i data-feather="shopping-cart"></i></a>
        <a href="/transaksi" id="clipboard" class="text-a me-3"><i data-feather="clipboard"></i></a>
        <a href="/profile" id="user" class="text-a me-5"><i data-feather="user"></i></a>
    </div>

</nav>

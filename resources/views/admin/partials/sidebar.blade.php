{{--<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">--}}
{{--    <div class="sb-sidenav-menu">--}}
{{--        <div class="nav">--}}
{{--            <div class="sb-sidenav-menu-heading">Dashboard</div>--}}
{{--            <a class="nav-link" href="{{ url('dashboard') }}">--}}
{{--                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>--}}
{{--                Dashboard--}}
{{--            </a>--}}
{{--            <a class="nav-link" href="{{ url('user') }}">--}}
{{--                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-user"></i></div>--}}
{{--                User--}}
{{--            </a>--}}
{{--            <div class="sb-sidenav-menu-heading">Interface</div>--}}
{{--            <a class="nav-link" href="{{ url('produk') }}">--}}
{{--                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>--}}
{{--                Produk--}}
{{--            </a>--}}
{{--            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">--}}
{{--                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>--}}
{{--                Pembayaran--}}
{{--                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">--}}
{{--                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">--}}
{{--                    <a class="nav-link" href="{{ url('transaksi') }}">Transactions</a>--}}
{{--                    <a class="nav-link" href="{{ url('login') }}">Login</a>--}}
{{--                    <a class="nav-link" href="{{ url('register') }}">Register</a>--}}
{{--                    <a class="nav-link" href="{{ url('password/reset') }}">Forgot Password</a>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sb-sidenav-footer">--}}
{{--        <div class="small">Logged in as:</div>--}}
{{--        Start Bootstrap--}}
{{--    </div>--}}
{{--</nav>--}}


    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link text-light  " aria-current="page">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('user') }}" class="nav-link text-white">
                <i class="bi bi-person-fill me-2" ></i>
                User
            </a>
        </li>
        <li>
            <a href="{{ url('products') }}" class="nav-link text-white">
                <i class="bi bi-box-seam-fill me-2"></i>
                Produk
            </a>
        </li>
        <li>
            <a href="{{ url('transaction') }}" class="nav-link text-white">
                <i class="bi bi-arrow-left-right me-2"></i>
                Transaksi
            </a>
        </li>
    </ul>


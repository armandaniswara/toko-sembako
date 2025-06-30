
    <ul class="nav nav-pills flex-column mb-auto py-4">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-light  " aria-current="page">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}" class="nav-link text-white">
                <i class="bi bi-person-fill me-2" ></i>
                User
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="nav-link text-white">
                <i class="bi bi-box-seam-fill me-2"></i>
                Produk
            </a>
        </li>
        <li>
            <a href="{{ route('transaction.index') }}" class="nav-link text-white">
                <i class="bi bi-arrow-left-right me-2"></i>
                Transaksi
            </a>
        </li>
        <li>
            <a href="{{ route('parameter.index') }}" class="nav-link text-white">
                <i class="bi bi-sliders2 me-2"></i>
                Parameter
            </a>
        </li>
    </ul>


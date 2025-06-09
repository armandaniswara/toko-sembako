<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Sidenav Light - SB Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container-fluid">

    <div class="row">
        @include('admin.partials.navbar')
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2  text-white p-4 py-5 bg-grey min-vh-100 position-fixed">
            {{--            <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100 p-3">--}}
            @include('admin.partials.sidebar')
        </div>

        <!-- Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-5 bg-light">
            @yield('content')
        </div>
    </div>
</div>

{{-- Script global --}}
<script>
    // Auto-fade alert success
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const alertSuccess = document.querySelector('.alert-success');
            if (alertSuccess) {
                alertSuccess.style.transition = 'opacity 0.5s ease';
                alertSuccess.style.opacity = '0';
                setTimeout(() => alertSuccess.remove(), 500); // Hapus setelah fade out
            }
        }, 3000);
    });
</script>

{{-- Script dari child page --}}
@stack('scripts')

</body>
</html>

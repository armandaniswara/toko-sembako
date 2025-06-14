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
</head>
<body class="bg-light">
{{--navbar--}}
<nav class="d-flex justify-content-between align-items-center px-5 py-3"
     style="background-color: rgba(1,1,1,0.8); border-bottom: 1px solid #684e34; position: fixed; top: 0; left: 0; right: 0; z-index: 9999; ">
    <a href="/" class="fs-2 fw-bold text-light text-decoration-none fst-italic ff-popins " style="">Sembako<span
            class="text-coffe" style="color: #b98a55;">Plus.</span></a>
</nav>
{{--body section--}}
@yield('content')

{{--footer section--}}
@include('partials.footer')
</body>

<script>
    feather.replace();
</script>
@stack('scripts')
</html>

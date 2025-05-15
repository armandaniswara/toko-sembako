@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Hero section start -->
@include('components.hero-section')
<!-- Hero section end -->

<!--about section start  -->
@include('components.about-section')
<!--about section end  -->
<hr class="w-75 mx-auto">
<!-- Menu section start -->
@include('components.belanja-section')
<!-- Menu section end -->
<hr class="w-75 mx-auto">
<!-- contact section start -->
@include('components.contact-section')
<!-- contact section end -->
<hr class="w-75 mx-auto">
@endsection

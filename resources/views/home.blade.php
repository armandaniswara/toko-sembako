@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Hero section start -->
@include('components.hero-section')
<!-- Hero section end -->

<!--about section start  -->
@include('components.about-section')
<!--about section end  -->

<!-- Menu section start -->
@include('components.belanja-section')
<!-- Menu section end -->

<!-- contact section start -->
@include('components.contact-section')
<!-- contact section end -->

@endsection

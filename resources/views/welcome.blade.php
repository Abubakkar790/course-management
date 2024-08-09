@extends('layout.guest')
@section('title', 'Welcome')
@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/main.css')}}">
@endpush

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{asset('images/hero-bg.jpg')}}" alt="" data-aos="fade-in">
  
        <div class="container text-white">
          <h2 data-aos="fade-up" data-aos-delay="100">Learning Today,<br>Leading Tomorrow</h2>
          <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with Bootstrap</p>
          <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="/login" class="btn-get-started btn btn-info">Get Started</a>
          </div>
        </div>
  
      </section><!-- /Hero Section -->
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
@endpush
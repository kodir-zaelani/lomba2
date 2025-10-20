@extends('layouts.appf')
@section('content')
<section id="hero" class="hero section">

    <div class="container" >

        <div class="row ">

            <div class="col-12">
                {!! Menu::render() !!}
            </div>

        </div>

    </div>

</section>
<section id="services" class="services section">

    <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Services</span>
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="intro-content" data-aos="fade-right" data-aos-delay="100">
                    <div class="mb-3 section-badge" data-aos="zoom-in" data-aos-delay="50">
                        <i class="bi bi-star-fill"></i>
                        <span>WHAT WE DO</span>
                    </div>
                    <h2 class="mb-4 section-heading">Transforming Ideas into Outstanding Results</h2>
                    <p class="mb-4 section-description">We believe in crafting exceptional experiences that drive meaningful growth for your business. Our dedicated team combines creativity with technical excellence to deliver solutions that make a difference.</p>
                    <a href="#" class="cta-button" data-aos="fade-right" data-aos-delay="200">
                        Explore Our Work
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual" data-aos="fade-left" data-aos-delay="150">
                    <img src="{{ asset('') }}assets/frontend/img/services/services-1.webp" alt="Services" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="mt-5 services-grid">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="card-number">
                            <span>01</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">Custom Application Development</a>
                            </h5>
                            <p class="service-description">Building robust applications tailored to your specific needs using modern frameworks and cutting-edge technologies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="card-number">
                            <span>02</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">Strategic Planning</a>
                            </h5>
                            <p class="service-description">Comprehensive roadmaps that align technology solutions with your business objectives and market opportunities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="card-number">
                            <span>03</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">Identity Design</a>
                            </h5>
                            <p class="service-description">Creating compelling visual narratives that resonate with your audience and strengthen brand recognition across all touchpoints.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="card-number">
                            <span>04</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">Digital Marketing</a>
                            </h5>
                            <p class="service-description">Maximizing your online presence through targeted campaigns that drive engagement and convert visitors into loyal customers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="card-number">
                            <span>05</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">User Experience Design</a>
                            </h5>
                            <p class="service-description">Crafting intuitive interfaces that prioritize user needs while delivering seamless interactions across desktop and mobile platforms.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="card-number">
                            <span>06</span>
                        </div>
                        <div class="card-content">
                            <h5 class="service-title">
                                <a href="#">Data Intelligence</a>
                            </h5>
                            <p class="service-description">Transforming raw data into actionable insights that inform strategic decisions and optimize business performance effectively.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{!! Menu::scripts() !!}
@endpush
@endsection

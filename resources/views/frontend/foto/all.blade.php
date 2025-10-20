@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Galeri Foto</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/">Home</a></li>
                <li class="current">Galeri Foto</li>
            </ol>
        </nav>
    </div>
</div>

<section id="portfolio" class="portfolio section">

    <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                @forelse ($fotos as $item)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                    <img class="img-fluid" src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}" alt="...">
                    <div class="portfolio-info">
                        <p>{{$item->album->title}}</p>
                        <a href="{{ $item->imageUrl ? $item->imageUrl : '' }}" title="{{$item->album->title}}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    </div>
                </div>
                @empty

                @endforelse

            </div>

        </div>
        <div id="pagination-2" class="pt-4 pagination-2">

            <div class="container">
                {{$fotos->links()}}

            </div>

        </div>

    </div>

</section>

@endsection

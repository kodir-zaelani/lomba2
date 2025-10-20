<section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Galeri Foto</h2>
    </div>
    <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li  class="filter-active"><a href="{{route('foto.all')}}">All</a></li>
            </ul>
            <div class="row gy-4 isotope-container justify-content-center " data-aos="fade-up" data-aos-delay="200">
                @forelse ($fotos as $item)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                    <img class="img-fluid" src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}" alt="...">
                    <div class="portfolio-info">
                        {{-- <h4>{{$item->album->title}}</h4> --}}
                        <p>{{$item->album->title}}</p>
                        <a href="{{ $item->imageUrl ? $item->imageUrl : '' }}" title="{{$item->album->title}}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    </div>
                </div>
                @empty

                @endforelse

            </div>

        </div>

    </div>

</section>

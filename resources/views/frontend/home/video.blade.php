<section id="events" class="events section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Galeri Video</h2>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="justify-content-center row g-4 justify-items-center">
            @forelse ($videos as $item)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="event-item">
                    <div class="event-image">
                        <a href="{{$item->video}}" class="glightbox">
                            <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}" class="img-fluid">
                        </a>
                    </div>
                    <div class="event-details">
                        <div class="accordion accordion-flush" id="accordionFlushVideo-{{$item->id}}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$item->id}}" aria-expanded="false" aria-controls="flush-{{$item->id}}">
                                        {{$item->title}}
                                    </button>
                                </h2>
                                <div id="flush-{{$item->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushVideo-{{$item->id}}">
                                    <div class="accordion-body">
                                        <h4>
                                            {{$item->title}}
                                        </h4>
                                        {!!$item->content!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h3>{{$item->title}}</h3>
                        <p>{!!$item->content!!}</p> --}}
                    </div>
                </div>
            </div>
            @empty
            <h3>Data belum tersedia</h3>
            @endforelse
        </div>

        <div class="events-navigation" data-aos="fade-up" data-aos-delay="500">
            <div class="text-center row align-items-center">
                <div class="col-md-8">
                    <div class="filter-tabs">
                        <a href="{{ route('video.all')}}" class="filter-tab active" data-filter="all">Semua Video</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

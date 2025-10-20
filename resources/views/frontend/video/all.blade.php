@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Galeri Video</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/">Home</a></li>
                <li class="current">Galeri Video</li>
            </ol>
        </nav>
    </div>
</div>

<section id="events" class="events section">

    <div class="container">

       <div class="justify-center row g-4 justify-items-center">
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
                    </div>
                </div>
            </div>
            @empty
            <h3>Data belum tersedia</h3>
            @endforelse
        </div>
        <div id="pagination-2" class="pt-4 pagination-2">

            <div class="container">
                {{$videos->links()}}

            </div>

        </div>

    </div>

</section>

@endsection

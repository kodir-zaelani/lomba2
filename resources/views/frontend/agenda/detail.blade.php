@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Event Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Event Details</li>
          </ol>
        </nav>
      </div>
    </div>
<section id="event" class="event section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8">
            <div class="mb-4 event-image" data-aos="fade-up">
              <img src="{{ $agenda->imageUrl ? $agenda->imageUrl : '/assets/images/no_image.png' }}" alt="{{$agenda->title}}" class="img-fluid">
            </div>

            <div class="mb-4 event-meta" data-aos="fade-up" data-aos-delay="100">
              <div class="row g-3">
                <div class="col-md-4">
                  <div class="meta-item">
                    <i class="bi bi-calendar-date"></i>
                    <span>{{$agenda->startdate}}</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    <span>{{$agenda->periode}} - {{$agenda->endperiode}}</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="meta-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Main Auditorium</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="event-content" data-aos="fade-up" data-aos-delay="200">
              <h2>{{$agenda->title}}</h2>
              <p>
                {!! $agenda->description!!}
              </p>


            </div>
          </div>

          <div class="col-lg-4">
            <div class="event-sidebar">

              <div class="sidebar-widget related-events" data-aos="fade-left" data-aos-delay="400">
                <h3>Agenda Lainnya</h3>
                @foreach ($agendas as $item)
                <div class="related-event-item">
                  <div class="related-event-date">
                    <span class="day">{{ \Carbon\Carbon::parse($item->startdate)->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($item->startdate)->isoFormat('MMM') }}</span>
                  </div>
                  <div class="related-event-info">
                    <a href="{{route('agenda.detail',$item->slug)}}"><h4>{{$item->title}}</h4></a>
                    {{-- <p><i class="bi bi-geo-alt"></i> Room 203, East Wing</p> --}}
                  </div>
                </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>

      </div>

    </section>
@endsection

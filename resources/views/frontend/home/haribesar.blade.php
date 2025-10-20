@if ($haribesar)
@php
setlocale(LC_TIME, 'id_ID');
\Carbon\Carbon::setLocale('id');
@endphp
<section id="hero-static" class="hero-static section">
    <div class="feature-cards-wrapper" data-aos="fade-up" data-aos-delay="300">
        <div class="upcoming-event" data-aos="fade-up" data-aos-delay="400">
            <div class="container">
                @foreach ($haribesar as $item)
                <div class="event-content">
                    <div class="event-date">
                        {{-- <span class="day">{{format('d', ($item->date))}}</span> --}}
                        <span class="day">
                            {{ \Carbon\Carbon::parse($item->date)->format('d') }}
                        </span>
                        <span class="month">
                            {{ \Carbon\Carbon::parse($item->date)->isoFormat('MMMM') }}

                        </span>
                    </div>
                    <div class="event-info">
                        <h3>{{$item->title}}</h3>
                        <p>{{$item->tema}}</p>
                    </div>
                    <div class="event-action">
                        <a href="{{asset('')}}haribesar/detail/{!! $item->slug !!}" class="btn-event">Detail</a>
                       <span> <a href="#" class="text-white countdown">Lainnya..</a></span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

<section id="events" class="events section">

    <div class="container section-title" data-aos="fade-up">
        <h2 class="text-kindegarten text-orange">Agenda</h2>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
            @forelse ($agenda as $item)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="event-item">
                    <div class="event-image">
                        <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}"  class="img-fluid">
                        <div class="event-date-overlay">
                            <span class="date">MAR<br>18</span>
                        </div>
                    </div>
                    <div class="event-details">

                        <h3>{{$item->title}}</h3>
                        <p>
                            {!!Str::limit($item->description, 100)!!}
                        </p>
                        <div class="event-info">

                        </div>
                        <div class="event-footer">
                            <a href="{{route('agenda.detail',$item->slug)}}" class="register-btn">Detail</a>

                        </div>
                    </div>
                </div>
            </div>
            @empty

            @endforelse

        </div>


    </div>

</section>

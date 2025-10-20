@if ($program)
<section id="program" class="program section">
    <div class="mt-5 feature-cards-wrapper" data-aos="fade-up" data-aos-delay="300">
        <div class="container">
            <div class="mx-auto mb-5 text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3 text-kindegarten">Program Unggulan</h1>
                <p>Berikut adalah program unggulan sekolah</p>
            </div>
            <div class="row gy-4">
                @foreach ($program as $item)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{route('program.detail',$item->slug)}}" >
                        <div class="feature-card {{$item->is_active}}">
                            <div class="feature-icon">
                                {!! $item->icon !!}
                            </div>
                            <div class="feature-content">
                                <h3>{{$item->title}}</h3>
                                <p>
                                    {!! $item->content!!}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endif

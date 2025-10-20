@if ($facilities)
<section id="facility" class="pb-5 bg-white facility section">
    <div class="container">
        <div class="mx-auto mb-5 text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3 text-kindegarten text-orange">Fasilitas Sekolah</h1>
        </div>
        <div class="row g-4">
            @forelse ($facilities as $item)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="facility-item">
                    <div class="facility-icon bg-{{$item->class}}">
                        <span class="bg-{{$item->class}}"></span>
                        <i class="{{$item->icon}} fa-3x text-{{$item->class}}"></i>
                        <span class="bg-{{$item->class}}"></span>
                    </div>
                    <div class="facility-text bg-{{$item->class}}">
                        <a href="{{route('facility.detail',$item->slug)}}" >
                            <h3 class="mb-3 text-{{$item->class}}">{{$item->title}}</h3>
                        </a>
                        <p>{!! Str::limit($editorial->content, 100) !!}</p>
                    </div>
                </div>
            </div>
            @empty
            <h2 class="text-danger">Data belum tersedia</h2>
            @endforelse

        </div>
    </div>
</section>
@endif

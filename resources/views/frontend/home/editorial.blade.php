<section id="editorial" class="mb-2 editorial students-life-block section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="pb-5 hero-intro">
            <div class="row g-0 align-items-center">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                    <div class="pb-0 content-wrapper">
                        @if ($editorial->count())
                        <div class="badge-highlight">Editorial</div>
                        <h3><a href="{{route('editorial.detail',$editorial->slug)}}">{{ !empty($editorial->title) ? $editorial->title : '' }}</a></h3>
                        <p>{!! Str::limit($editorial->content, 500) !!}</p>

                        @else
                        <span>Belum ada data</span>
                        @endif
                        <div class="pt-0 activities-showcase">
                            <div class="row">
                                @foreach ($editorials as $item)
                                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                                    <div class=" activities-list">
                                        <div class="activity-item" data-aos="slide-up" data-aos-delay="350">
                                            <div class="activity-thumb">
                                                <img src="{{asset('')}}assets/frontend/img/education/activities-6.webp" alt="Research Projects" class="img-fluid">
                                            </div>
                                            <div class="activity-info">
                                                <h6><a href="{{route('editorial.detail',$item->slug)}}" class="text-pastel">{{ !empty($item->title) ? $item->title : '' }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pt-4 action-buttons">
                            <a href="{{route('editorial.all')}}" class="btn btn-success">Semua Editorial</a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                    <div class="px-4 hero-visual">
                        <div class="image-stack">
                            <img src="{{ $ptk->imageUrl ? $ptk->imageUrl : '/assets/images/no_image.png' }}" alt="{{$ptk->name}}" class="img-fluid primary-img">
                            <div class="pb-1 m-0 floating-card">
                                <span >
                                    <span class="fw-bold">{{$ptk->name}}</span>
                                    <p >{{$ptk->jenisptk->jenis_ptk}}</p>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

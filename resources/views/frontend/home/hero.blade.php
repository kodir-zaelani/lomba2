<section id="hero-static" class="pb-2 hero-static section">
    <div class="hero-wrapper">
        <div class="container">
            <div class="row align-items-center">
                @foreach ($hero as $item)
                <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-delay="100">
                    <h1>{{$item->title}}</h1>
                    <p>{!!$item->description!!}</p>
                    <div class="stats-row">
                        <div class="stat-item">
                            <span class="stat-number">{{$item->student}}</span>
                            <span class="stat-label">Siswa</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{$item->teacher}}</span>
                            <span class="stat-label">Guru</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{$item->ratio}}</span>
                            <span class="stat-label">Rasio Siswa-Guru</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{$item->administration}}</span>
                            <span class="stat-label">Staf</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        @if ($item->link_hero)
                        <a href="{{asset('')}}page/detail/{{$item->link_hero}}" class="btn-primary ">{{$item->title_btn_link}}<span class="ms-3">{!!$item->icon_link!!} </span></a>
                        @endif
                        @if ($item->video_hero)
                        <a href="{{$item->video_hero}}" class="btn-secondary glightbox">{{$item->title_btn_video}}<span class="ms-2">{!!$item->icon_btn_video!!} </span></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 hero-media" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ $item->imageheroUrl ? $item->imageheroUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="Education" class="img-fluid main-image">
                    <div class="image-overlay">
                        <div class="badge-accredited">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Accredited Excellence</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

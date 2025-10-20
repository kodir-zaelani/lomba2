<section id="featured-programs" class="featured-programs section">
    <div class="container section-title" data-aos="fade-up">
        <h2 class="text-kindegarten">Update Berita</h2>
        {{-- <p>Update berita</p> --}}
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <div class="program-banner">
                    <div class="banner-image">
                        <img src="{{ $postpopular->imageThumbUrl ? $postpopular->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$postpopular->title}}" class="img-fluid">
                        <div class="banner-badge">
                            <span class="badge-text">Popular</span>
                        </div>
                    </div>
                    <div class="banner-info">
                        <div class="program-header">
                            <a href="{{route('post.detail', $postpopular->slug)}}">
                                <h3 title="{{$postpopular->title}}">{{$postpopular->title}}</h3>
                            </a>
                            <div class="program-stats">
                                <span><i class="bi bi-calendar4-week"></i> {{ $postpopular->Datepublished }}</span>
                                <span><i class="bi bi-eye-fill"></i>{{ $postpopular->view_count }} kal</span>
                            </div>
                        </div>
                        <p>
                            {!!Str::limit($postpopular->content, 150)!!}
                        </p>
                        <div class="program-details">
                            <div class="detail-item">
                                <i class="bi bi-person-circle"></i>
                                <span>
                                    @if ($postpopular->author->displayname)
                                    {{ $postpopular->author->displayname }}
                                    @else
                                    {{ $postpopular->author->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="detail-item">

                            </div>
                        </div>
                        <a href="{{route('post.category',$postpopular->postcategory->title)}}" class="discover-btn"><i class="bi bi-folder2-open me-3"></i>{{$postpopular->postcategory->title}}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="programs-grid">
                    <div class="row g-3">
                        @forelse ($posts as $item)
                        <a href="{{route('post.detail', $item->slug)}}">
                            <div class="col-12" data-aos="fade-left" data-aos-delay="200">
                                <div class="program-item">
                                    <div class="item-icon">
                                        <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}" class="img-fluid">
                                    </div>
                                    <div class="item-content">
                                        <h4>{{ $item->title}}</h4>
                                        <p>
                                            {!!Str::limit($item->content, 100)!!}
                                        </p>
                                        <div class="meta-info">
                                            <i class="bi bi-person-circle"></i>
                                            <span>
                                                @if ($item->author->displayname)
                                                {{ $item->author->displayname }}
                                                @else
                                                {{ $item->author->name }}
                                                @endif
                                            </span>
                                            <span><i class="bi bi-calendar4-week"></i> {{ $item->Datepublished }}</span>
                                        </div>
                                    </div>
                                    <div class="item-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        Update belum tersedia
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
            <div class="row align-items-center">
                <div class="text-center col-md-12">
                    <div class="banner-info">
                        <a href="{{ route('post.news')}}" class="discover-btn" data-filter="all">Semua Berita</a>
                    </div>
                </div>
            </div>
    </div>

</section>


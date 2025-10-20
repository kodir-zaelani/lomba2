<section id="recent-news" class="recent-news section">


    <div class="container section-title" data-aos="fade-up">
        <h2>Blog Guru</h2>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            @forelse ($blogs as $item)
            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
                <article class="post-item d-flex">
                    <div class="post-img">
                        <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}" class="img-fluid">
                    </div>

                    <div class="post-content flex-grow-1">
                        <a href="{{route('blog.category',$item->blogcategory->title)}}" class="category">{{$item->blogcategory->title}}</a>

                        <h2 class="post-title">
                            <a href="{{route('blog.detail', $item->slug)}}">{{$item->title}}</a>
                        </h2>

                        <p class="post-description">
                            {!!Str::limit($item->content, 100)!!}
                        </p>

                        <div class="post-meta">
                            <div class="post-author">
                                <i class="bi bi-person-circle"></i>
                                {{-- <img src="{{$item->author->imageThumbUrl}}" alt="{{ $item->author->name }}" width="32" height="32" class="img-fluid"> --}}
                                <span class="author-name">
                                    @if ($item->author->displayname)
                                    {{ $item->author->displayname }}
                                    @else
                                    {{ $item->author->name }}
                                    @endif
                                </span>
                            </div>
                            {{-- <span class="post-date">{{ $item->Datepublished }}</span> --}}
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <h2>Blog Belum Tersedia</h2>
            @endforelse

        </div>
        <div class="row align-items-center featured-programs">
            <div class="text-center col-md-12">
                <div class="banner-info">
                    <a href="{{ route('blog.index')}}" class="discover-btn" data-filter="all">Semua Blog</a>
                </div>
            </div>
        </div>
    </div>

</section>

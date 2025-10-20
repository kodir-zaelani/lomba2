@extends('layouts.appf')

@section('content')

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{$postcategory->title}}</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('root') }}">Beranda</a></li>
                <li class="current">{{$postcategory->title}}</li>
            </ol>
        </nav>
    </div>
</div>


<section id="news-hero" class="news-hero section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row g-4">
                    @foreach ($posts as $item)
                    <div class="col-md-6">
                        <article class="secondary-post" data-aos="fade-up">
                            <div class="post-image">
                                <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}" class="img-fluid">
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="category">{{$item->postcategory->title}}</span>
                                    <span class="date">{{ $item->Datepublished }}</span>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{route('post.detail', $item->slug)}}">{{$item->title}}</a>
                                </h3>
                                <div class="post-author">
                                    <span>by</span>
                                    <a href="#">
                                        @if ($item->author->displayname)
                                        {{ $item->author->displayname }}
                                        @else
                                        {{ $item->author->name }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div id="pagination-2" class="pt-4 pagination-2">

                    <div class="container">
                        {{$posts->links()}}

                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="news-tabs" data-aos="fade-up" data-aos-delay="200">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#top-stories" type="button">Berita Populer</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#latest" type="button">Berita Terbaru</button>
                        </li>
                         <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#blog" type="button">Blog</button>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="top-stories">
                          @include('frontend.partials.sidebarberitapopuler')
                        </div>


                        <div class="tab-pane fade" id="latest">
                            @include('frontend.partials.sidebarberitaterbaru')
                        </div>


                        <div class="tab-pane fade" id="blog">
                            @include('frontend.partials.sidebarblogterbaru')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

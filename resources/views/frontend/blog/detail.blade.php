@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{$blog->blogcategory->title}}</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current"><a href="{{route('blog.category',$blog->blogcategory->title)}}" class="textdecoration-none">{{$blog->blogcategory->title}}</a></li>
            </ol>
        </nav>
    </div>
</div>
<section id="blog-details" class="blog-details section">
    <div class="container" data-aos="fade-up">

        <article class="article">
            <div class="article-header">
                <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{$blog->title}}</h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
                    <div class="author">
                        <i class="bi bi-person-circle"></i>
                        {{-- <img src="{{ ($blog->author_id) ? $blog->author->imageThumbUrl : '/assets/images/avatar/avatar-4.png' }}" alt="Author" class="author-img"> --}}
                        <div class="author-info">
                            <h4>{{$blog->author->name}}</h4>
                        </div>
                    </div>
                    <div class="post-info">
                        <span><i class="bi bi-calendar4-week"></i> {{ $blog->Datepublished }}</span>
                        <span><i class="bi bi-eye-fill"></i>{{ $blog->view_count }} kali</span>
                        {{-- <span><i class="bi bi-chat-square-text"></i> 32 Comments</span> --}}
                    </div>
                </div>
            </div>
            <div class="article-featured-image" data-aos="zoom-in">
                @if ($blog->image)
                <img src="{{ $blog->imageWatermarkUrl ? $blog->imageWatermarkUrl : '/assets/images/no_image.png' }}" alt="{{$blog->title}}" class="card-img-top" data-aos="zoom-in">

                @endif
                @if ($blog->caption_image)
                <span class="pt-2 text-muted ps-3">/*: {{($blog->caption_image)}}</span>
                @endif
            </div>
            <div class="article-wrapper">
                <aside class="p-0 table-of-contents news-hero" data-aos="fade-left">
                    <div class="news-tabs" data-aos="fade-up" data-aos-delay="200">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#top-stories" type="button">Populer</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#latest" type="button">Terbaru</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#trending" type="button">Blog</button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="top-stories">
                                @include('frontend.partials.sidebarberitapopuler')
                            </div>


                            <div class="tab-pane fade" id="trending">
                                @include('frontend.partials.sidebarblogterbaru')
                            </div>


                            <div class="tab-pane fade" id="latest">
                                @include('frontend.partials.sidebarberitaterbaru')
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="article-content">
                    <div class="content-section" id="introduction" data-aos="fade-up">
                        <p class="lead">
                            {!! $blog->content !!}
                        </p>
                    </div>
                    @if ($blog->video)
                    <div class="pt-5 content-section"  data-aos="fade-up">
                        <iframe width="100%" height="560" src="{{ $blog->video }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <span class="pt-2 text-muted">/*: {{($blog->caption_video)}}</span>
                    @endif
                </div>
            </div>

        </article>
    </div>
</section>
@endsection

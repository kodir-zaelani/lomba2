@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{$page->pagecategory->title}}</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current">{{$page->pagecategory->title}}</li>
            </ol>
        </nav>
    </div>
</div>
<section id="blog-details" class="blog-details section">
    <div class="container" data-aos="fade-up">

        <article class="article">
            <div class="article-header">
                <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{$page->title}}</h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-info">
                        <span><i class="bi bi-calendar4-week"></i> {{ TanggalID('j M Y', $page->created_at) }}</span>
                        <span><i class="bi bi-eye-fill"></i>{{ $page->view_count }} kali</span>
                        {{-- <span><i class="bi bi-chat-square-text"></i> 32 Comments</span> --}}
                    </div>
                </div>
            </div>

            @if ($page->masterstatus <> 1)
            @if ($page->image)
            <div class="article-featured-image" data-aos="zoom-in">
                <img src="{{ $page->imageUrl ? $page->imageUrl : '/assets/images/no_image.png' }}" alt="{{$page->title}}" class="img-fluid">
            </div>
            @endif
            @endif
            <div class="article-wrapper">
                <aside class="table-of-contents" data-aos="fade-left">
                    <h3>{{$page->pagecategory->title}}</h3>
                    <nav>
                        <ul>
                            @forelse ($pages as $item)
                            <li><a href="{{asset('')}}page/detail/{{$item->slug}}">{{$item->title}}</a></li>
                            @empty
                               <span>Data tidak ditemukan</span>
                            @endforelse
                        </ul>
                    </nav>
                </aside>
                <div class="article-content">
                    <div class="content-section" id="introduction" data-aos="fade-up">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

        </article>
    </div>
</section>
@endsection

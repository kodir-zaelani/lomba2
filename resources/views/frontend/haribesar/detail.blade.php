@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Hari Besar</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current">Hari Besar</li>
            </ol>
        </nav>
    </div>
</div>
<section id="blog-details" class="blog-details section">
    <div class="container" data-aos="fade-up">

        <article class="article">
            <div class="article-header">
                <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{$haribesar->title}}</h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-info">
                        <span><i class="bi bi-calendar4-week"></i> {{ TanggalID('j M Y', $haribesar->created_at) }}</span>
                        <span><i class="bi bi-eye-fill"></i>{{ $haribesar->view_count }} kali</span>
                        {{-- <span><i class="bi bi-chat-square-text"></i> 32 Comments</span> --}}
                    </div>
                </div>
            </div>

            @if ($haribesar->masterstatus <> 1)
            @if ($haribesar->image)
            <div class="article-featured-image" data-aos="zoom-in">
                <img src="{{ $haribesar->imageUrl ? $haribesar->imageUrl : '/assets/images/no_image.png' }}" alt="{{$haribesar->title}}" class="img-fluid">
            </div>
            @endif
            @endif
            <div class="article-wrapper">
                <aside class="table-of-contents" data-aos="fade-left">
                    <h3>Hari Besar Lainnya</h3>
                    <nav>
                        <ul>
                            @forelse ($haribesars as $item)
                            <li><a href="{{asset('')}}haribesar/detail/{{$item->slug}}">{{$item->title}}</a></li>
                            @empty
                               <span>Data tidak ditemukan</span>
                            @endforelse
                        </ul>
                    </nav>
                    <p>
                        {{$haribesars->links()}}
                    </p>
                </aside>
                <div class="article-content">
                    <div class="content-section" id="introduction" data-aos="fade-up">
                        {!! $haribesar->content !!}
                    </div>
                </div>
            </div>

        </article>
    </div>
</section>
@endsection

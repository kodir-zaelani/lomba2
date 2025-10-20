@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Editorial</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current">Detail</li>
            </ol>
        </nav>
    </div>
</div>
<section id="blog-details" class="blog-details section">
    <div class="container" data-aos="fade-up">

        <article class="article">
            <div class="article-header">
                <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{$editorial->title}}</h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-info">
                        <span><i class="bi bi-calendar4-week"></i> {{ TanggalID('j M Y', $editorial->created_at) }}</span>
                        <span><i class="bi bi-eye-fill"></i>{{ $editorial->view_count }} kali</span>
                        {{-- <span><i class="bi bi-chat-square-text"></i> 32 Comments</span> --}}
                    </div>
                </div>
            </div>

            @if ($editorial->masterstatus <> 1)
            @if ($editorial->image)
            <div class="article-featured-image" data-aos="zoom-in">
                <img src="{{ $editorial->imageUrl ? $editorial->imageUrl : '/assets/images/no_image.png' }}" alt="{{$editorial->title}}" class="img-fluid">
            </div>
            @endif
            @endif
            <div class="article-wrapper">
                <aside class="table-of-contents" data-aos="fade-left">
                    <h3>Editorial Lainnya</h3>
                    <nav>
                        <ul>
                            @forelse ($editorials as $item)
                            <li><a href="{{asset('')}}editorial/detail/{{$item->slug}}" title="{{$item->title}}">{{Str::limit($item->title, 30)}}</a></li>
                            @empty
                               <span>Data tidak ditemukan</span>
                            @endforelse
                        </ul>
                    </nav>
                </aside>
                <div class="article-content">
                    <div class="content-section" id="introduction" data-aos="fade-up">
                        {!! $editorial->content !!}
                    </div>
                </div>
            </div>

        </article>
    </div>
</section>
@endsection

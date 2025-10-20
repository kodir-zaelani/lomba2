@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Fasilitas</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current">Fasilitas</li>
            </ol>
        </nav>
    </div>
</div>
<section id="blog-details" class="blog-details section">
    <div class="container" data-aos="fade-up">

        <article class="article">
            <div class="article-header">
                <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{$fasility->title}}</h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-info">
                        <span><i class="bi bi-calendar4-week"></i> {{ TanggalID('j M Y', $fasility->created_at) }}</span>
                        <span><i class="bi bi-eye-fill"></i>{{ $fasility->view_count }} kali</span>
                        {{-- <span><i class="bi bi-chat-square-text"></i> 32 Comments</span> --}}
                    </div>
                </div>
            </div>

            @if ($fasility->masterstatus <> 1)
            @if ($fasility->image)
            <div class="article-featured-image" data-aos="zoom-in">
                <img src="{{ $fasility->imageUrl ? $fasility->imageUrl : '/assets/images/no_image.png' }}" alt="{{$fasility->title}}" class="img-fluid">
            </div>
            @endif
            @endif
            <div class="article-wrapper">
                <aside class="table-of-contents" data-aos="fade-left">
                    <h3>Fasilitas Lainnya</h3>
                    <nav>
                        <ul>
                            @forelse ($fasilities as $item)
                            <li><a href="{{asset('')}}fasilitas/detail/{{$item->slug}}">{{$item->title}}</a></li>
                            @empty
                               <span>Data tidak ditemukan</span>
                            @endforelse
                        </ul>
                    </nav>
                </aside>
                <div class="article-content">
                    <div class="content-section" id="introduction" data-aos="fade-up">
                        {!! $fasility->content !!}
                    </div>
                </div>
            </div>

        </article>
    </div>
</section>
@endsection

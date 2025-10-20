@extends('layouts.appf')

@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Staf</h1>
        <nav class="breadcrumbs">
            <ol class="mx-2">
                <li><a href="/">Beranda</a></li>
                <li class="current"><a href="{{route('post.news')}}" class="textdecoration-none">Staf</a></li>
            </ol>
        </nav>
    </div>
</div>
<section id="faculty--staff" class="faculty--staff section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="faculty-grid">
            <div class="row g-4 justify-content-center ">
                @forelse ($ptk as $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="faculty-card">
                        <div class="faculty-image">
                            <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}" alt="{{$item->name}}" class="img-fluid" alt="Faculty Member">
                            <div class="social-links">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="faculty-info">
                            <h3>{{$item->name}}</h3>
                            <a href="#" class="profile-link">{{$item->jabatan}}</a>
                        </div>
                    </div>
                </div>
                @empty
                Belum ada data PTK
                @endforelse
            </div>
        </div>

        <div class="mt-5 pagination-container d-flex justify-content-center" data-aos="fade-up">
            <nav aria-label="Faculty pagination">
                {{$ptk->links()}}
            </nav>
        </div>

    </div>

</section>
@endsection

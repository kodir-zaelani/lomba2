<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta Property="og:url" content="{{ asset('') }}">

    @if (Request::segment(1) == '')
    <meta property="og:type" content="article"/>
    @if ($global_option != '0')
    @if ($global_option->logo)
    <meta property="og:image" content="{{ $global_option->imageThumbUrl }}" />
    @endif
    @if ($global_option->webname)
    <meta property="og:title" content="{{ $global_option->webname }}"/>
    @else
    <meta name="og:title"
    content="Sekolah Nusantara">
    @endif
    @if ($global_option->meta_description)
    <meta name="description" content="{{ $global_option->meta_description }}">
    @else
    <meta name="description"
    content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    @endif

    @if ($global_option->meta_keywords)
    <meta name="keywords" content="{{ $global_option->meta_keywords }}">
    @else
    <meta name="keywords"
    content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    @endif
    @if ($global_option->favicon)
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/{{ $global_option->favicon }}" rel="icon">
    @else
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png" rel="icon">
    @endif
    @elseif ($global_option == '0')
    <meta name="description" content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    <meta name="keywords" content="Kodir Zaelani, digital nusantara, digtal ">
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png">
    @endif
    @elseif (Request::segment(1) == 'posts-detail')
    {{-- {{ Request::segment(1) }} --}}

    <meta property="og:title" content="{{ $global_option->webname }}"/>
    <meta name="description" content="{{$post->created_at}}" />
    <meta property="og:title" content="{{ $post->title }}" />
    <meta name="description" content="{{ $global_option->meta_description }}" />
    <meta property="og:url" content="{{ asset('') }}posts/detail/{{ $post->slug }}" />
    @if ($post->image)
    <meta property="og:image" content="{{ $post->imageUrl }}" />
    @else
    <meta property="og:image" content="{{ asset('assets/icons/ic-logo.png')}}" />
    @endif
    <meta property="og:type" content="article" />

    <title>{{ $post->title }}</title>
    @endif

    @if ($global_option != '0')

    @if ($global_option->meta_description)
    <meta name="description" content="{{ $global_option->meta_description }}">
    @else
    <meta name="description" content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    @endif

    @if ($global_option->meta_keywords)
    <meta name="keywords" content="{{ $global_option->meta_keywords }}">
    @else
    <meta name="keywords" content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    @endif
    @if ($global_option->favicon)
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/{{ $global_option->favicon }}" rel="icon">
    @else
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png" rel="icon">
    @endif
    @elseif ($global_option == '0')
    <meta name="description" content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
    <meta name="keywords" content="Kodir Zaelani, digital nusantara, digtal ">
    <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png">
    @endif
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

    <link href="{{ asset('') }}assets/frontend/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/icons/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/icons/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/icons/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/vendor_components/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/vendor_components/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/vendor_components/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/frontend/css/main-kreatif.css" rel="stylesheet">
    <title>{{ $title ?? config('app.name', 'Teras Petani') }}</title>
    @livewireStyles
</head>

<body class="index-page">
    @php
    setlocale(LC_TIME, 'id_ID');
    \Carbon\Carbon::setLocale('id');
    @endphp
    @include('frontend.partials.header')
    <main class="main">
        @yield('content')
    </main>
    @include('frontend.partials.footer')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    <script src="{{ asset('') }}assets/frontend/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/aos/aos.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('') }}assets/frontend/js/main.js"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>

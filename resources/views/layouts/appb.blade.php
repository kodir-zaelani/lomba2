<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @if ($global_option != '0')

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
            <link rel="icon" href="{{ asset('') }}uploads/images/logo/{{ $global_option->favicon }}">
        @else
            <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png">
        @endif
    @elseif ($global_option == '0')
        <meta name="description"
            content="Digital Nusantara, Digital Nusantara Borneo, Borneo, Digital, Nusantara, Kaltim">
        <meta name="keywords" content="Kodir Zaelani, digitan nusantara, digtal ">
        <link rel="icon" href="{{ asset('') }}uploads/images/logo/favicon.png">
    @endif

    <title>{{ $title ?? config('app.name', 'Teras Petani') }}</title>
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/vendors_css.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/skin_color.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/icons/bootstrap-icons/bootstrap-icons.css">
    @stack('styles')
    @livewireStyles
</head>

<body class="fixed light-skin hold-transition sidebar-mini theme-primary">

    <div class="wrapper">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')
        <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
                {{ isset($slot) ? $slot : null }}
            </div>
        </div>
        @include('backend.partials.footer')
    </div>

    <script data-navigate-once src="{{ asset('') }}assets/backend/js/vendors.min.js"></script>
    @stack('scripts')
    <script data-navigate-once src="{{ asset('') }}assets/backend/js/template.js"></script>
    @stack('scripts-menu')
    <script>
        window.addEventListener('openDeleteModal', event => {
            $("#modalFormDelete").modal('show');
        });

        window.addEventListener('closeDeleteModal', event => {
            $("#modalFormDelete").modal('hide');
        });



        window.addEventListener('closeDeleteModalAll', event => {
            $("#modalFormDeleteAll").modal('hide');
        });
        $('#draft-btn').click(function(e) {
            e.preventDefault();
            $('#status').val(0);
            $('#post-form').submit();
        });
        $('#publish-btn').click(function(e) {
            e.preventDefault();
            $('#status').val(1);
            $('#post-form').submit();
        });
    </script>
    @livewireScripts
</body>

</html>

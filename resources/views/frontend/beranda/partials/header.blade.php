@auth
@php
$currentUser = Auth::user()
@endphp
@endauth
 <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">


                <h5 class="sitename">sitijumariyah.com</h5>
                {{-- <h5 class="sitename">KSP2</h5> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{route('root')}}" class="active">Beranda</a></li>
                    <li><a href="{{route('root')}}#about">Tentang</a></li>
                    <li><a href="{{route('root')}}#services">Kegiatan Utama</a></li>
                    <li><a href="{{route('root')}}#features">Siklus</a></li>
                    <li><a href="{{route('root')}}#call-to-action">Binaan</a></li>
                    <li><a href="{{route('root')}}#faq">FAQ</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{route('login')}}">Masuk</a>

        </div>
    </header>

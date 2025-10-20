 @auth
 @php
 $currentUser = Auth::user()
 @endphp
 @endauth

 <header id="header" class="header sticky-top fixed-top">
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                @if ($global_option != '0')
                <i class="bi bi-envelope d-flex align-items-center">
                    @if ($global_option->email)
                    <a href="mailto:{{$global_option->email}}" class=" ms-2 text-decoration-none"> {{$global_option->email}}</a>
                    @else
                    <a href="#" class=" ms-2"> Update Email</a>
                    @endif
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4 fw-bold">
                    @if ($global_option->phone)
                    <span class="ms-2 ">{{$global_option->phone}}</span>
                    @else
                    <span>+62-xxxx-xxxx</span>
                    @endif
                </i>
                @else
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="#" class=" ms-2"> Update Email</a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span>+62-xxxx-xxxx</span>
                </i>
                @endif
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                @if ($header_menu)
                @foreach ($header_menu as $headermenu)
                @if ($headermenu['status'] == 1)
                <a href="{{ $headermenu['link'] }}" >{{ $headermenu['label']}}</a>
                @endif
                @endforeach
                @endif
                @if ($social_media)
                @foreach ($social_media as $socialmedia)
                <a href="{{ $socialmedia->url }}" target="_blank" >{!! $socialmedia->icon !!}</a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">

            <a href="/" class=" logo d-flex align-items-center me-auto">
                <img src="{{ asset('') }}uploads/images/logo/{{ $global_option->logo }}" alt="" class="img-fluid d-none d-md-block d-lg-block d-xl-block">
                <h5 class="m-0 text-kindegarten">
                    @if ($global_option != '0')
                    @if ($global_option->webname)
                    {{$global_option->webname}}
                    @else
                    Maroko Kreatif
                    @endif
                    @endif
                </h5>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @if ($public_menu)
                    @foreach ($public_menu as $menu)
                    @if ($menu['status'] == 1)
                    <li class="@if ($menu['child']) dropdown @endif">
                        <a href="{{ $menu['link'] }}" target="{{ $menu['target'] }}">
                            @if ($menu['child'])
                            <span>{{ $menu['label'] }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                            @else
                            <span class="me-1"></span>{{ $menu['label'] }}
                            @endif
                        </a>
                        @if ($menu['child'])
                        <ul>
                            @foreach ($menu['child'] as $child)
                            @if ($child['status'] == 1)
                            <li @if ($child['child']) class="dropdown" @endif>
                                <a href="{{ $child['link'] }}" target="{{ $child['target'] }}">
                                    @if ($child['child'])
                                    <span>{{ $child['label'] }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                                    @else
                                    {{ $child['label'] }}
                                    @endif
                                </a>
                                @if ($child['child'])
                                <ul>
                                    @foreach ($child['child'] as $subchild)
                                    @if ($subchild['status'] == 1)
                                    <li @if ($subchild['child']) class="dropdown" @endif>
                                        <a href="{{ $subchild['link'] }}" target="{{ $subchild['target'] }}">
                                            @if ($subchild['child'])
                                            <span>{{ $subchild['label'] }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                                            @else
                                            {{ $subchild['label'] }}
                                            @endif
                                        </a>
                                        @if ($subchild['child'])
                                        <ul>
                                            @foreach ($subchild['child'] as $subchilddeep)
                                            @if ($subchilddeep['status'] == 1)
                                            <li>
                                                <a href="{{ $subchilddeep['link'] }}" target="{{ $subchilddeep['target'] }}">
                                                    {{ $subchilddeep['label'] }}
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endif
                    @endforeach
                    @endif
                    <li>
                        <a class="text-center cta-btn d-md-none d-lg-none d-xl-none d-block" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @guest
            @if (Route::has('login'))
            <a class="cta-btn d-md-block d-lg-block d-xl-block d-none" href="{{ route('login') }}">{{ __('Masuk') }}</a>
            @endif
            @else
            <div class="dropdown ms-3 d-xl-block d-lg-block d-md-block d-none" >
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ ($currentUser->imageThumbUrl) ? $currentUser->imageThumbUrl : '/assets/images/avatar/avatar-4.png' }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    <span class="mx-2">
                        {{ $currentUser->name }}
                    </span>
                </a>
                <ul class="mt-3 dropdown-menu text-small dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('backend.dashboard')}}">Dashboard</a></li>
                    <li><a class="dropdown-item" href="#">Password</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out me-2" aria-hidden="true"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            @endguest
        </div>
    </div>
</header>

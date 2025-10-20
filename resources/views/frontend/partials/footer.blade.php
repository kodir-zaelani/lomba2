<footer id="footer" class="footer position-relative light-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="" class=" d-flex align-items-center">
                    <h2 class="sitename text-kindegarten">{{ !empty($global_option->webname) ? $global_option->webname:'Silahkan Sesuaikan ' }}</h2>
                </a>
                <div class="pt-3 footer-contact">
                    @if ($global_option <> '0')
                    <p>
                        {{ !empty($global_option->address) ? $global_option->address:'Silahkan Sesuaikan ' }}
                    </p>
                    <p>
                        {{ !empty($global_option->city) ? $global_option->city:'Silahkan Sesuaikan ' }}, <br>
                        {{ !empty($global_option->state) ? $global_option->state:'Silahkan Sesuaikan ' }} <br>
                        {{ !empty($global_option->country) ? $global_option->country:'Silahkan Sesuaikan ' }}, {{ !empty($global_option->postalcode) ? $global_option->postalcode:'Silahkan Sesuaikan ' }} <br><br>
                    </p>
                    @endif
                    <p class="mt-3"><strong>Phone:</strong> <span>{{ !empty($global_option->phone) ? $global_option->phone:'Silahkan Sesuaikan ' }}</span></p>
                    <p><strong>Email:</strong> <span>{{ !empty($global_option->email) ? $global_option->email:'Silahkan Sesuaikan ' }}</span></p>
                </div>
                <div class="mt-4 social-links d-flex">
                    @if ($social_media)
                    @foreach ($social_media as $socialmedia)
                    <a href="{{ $socialmedia->url }}" target="_blank">{!! $socialmedia->icon !!}</a>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Profil</h4>
                <ul>
                    @if ($bottom_left)
                    @foreach ($bottom_left as $bottomleft)
                    @if ($bottomleft['status'] == 1)
                    <li><a href="{{ $bottomleft['link'] }}" target="{{ $bottomleft['target'] }}">{{ $bottomleft['label']}}</a></li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Tautan Daerah</h4>
                <ul>
                    @if ($bottom_middle)
                    @foreach ($bottom_middle as $bottommiddle)
                    @if ($bottommiddle['status'] == 1)
                    <li><a href="{{ $bottommiddle['link'] }}" target="{{ $bottommiddle['target'] }}">{{ $bottommiddle['label']}}</a></li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Tautan Pusat</h4>
                <ul>
                    @if ($bottom_right)
                    @foreach ($bottom_right as $bottomright)
                    @if ($bottomright['status'] == 1)
                    <li><a href="{{ $bottomright['link'] }}" target="{{ $bottomright['target'] }}">{{ $bottomright['label']}}</a></li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Statistik</h4>
                <p>Jumlah pengunjung</p>
            </div>
        </div>
    </div>

    <div class="container mt-4 text-center copyright">
        <p>
            &copy;
            @php
            echo date('Y');
            @endphp
            <span>Copyright</span>
            <strong class="px-1 sitename">
                @if ($global_option != '0')
                {{ !empty($global_option->webname) ? $global_option->webname : 'Silahkan Sesuaikan ' }}
                @else
                Silahkan Sesuaikan di menu setting
                @endif
            </strong>
            <span>All Rights Reserved</span>
            || Versi: {{ config('app.version', '1.0') }} | created with <i class="mx-2 bi bi-heart-fill "></i> for <i class="mx-2 flag-icon flag-icon-id " title="Indonesia" id="id"></i>
        </p>
        <div class="credits">
            Modif by <a href="https://marokokreatif.com/" target="_blank">Maroko Kreatif</a>
        </div>
    </div>
</footer>

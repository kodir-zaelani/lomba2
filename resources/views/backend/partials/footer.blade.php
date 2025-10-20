    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">FAQ</a>
                </li>
            </ul>
        </div>
        &copy;
        @php
        echo date('Y');
        @endphp
        | <span class="mx-5 text-white ">
            <a href="{{ route('root') }}">
                @if ($global_option != '0')
                {{ !empty($global_option->webname) ? $global_option->webname : 'Silahkan Sesuaikan ' }}
                @else
                Silahkan Sesuaikan di menu setting
                @endif
            </a>
        </span>|| Versi: {{ config('app.version', '1.0') }} | Dibuat dengan <i class="mx-5 fa fa-heart"
        aria-hidden="true"></i> untuk <i class="mx-5 flag-icon flag-icon-id" title="Indonesia" id="id"></i>
    </footer>

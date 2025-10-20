    <aside class="main-sidebar">
        <section class="sidebar position-relative">
            <div class="multinav">
                <div class="multinav-scroll" style="height: 100%;">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li>
                            <a href="{{ route('root') }}" target="_blank" title="View Site">
                                <i class="fa fa-desktop" aria-hidden="true"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="header">Dashboard & Apps</li>
                        <li class="{{ setActive('backend/home') }}">
                            <a href="{{ route('backend.dashboard') }}" title="Dashboard">
                                <i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- @if (auth()->user()->can('posts.index') ||
                        auth()->user()->can('pagecategories.index') || auth()->user()->can('greetings.index') )
                        @can('categoryposts.index')
                        <li class="{{ setActive('backend/postcategories') }}">
                            <a href="{{ route('backend.postscategories.index') }}" title="Post Category">
                                <i class="fa fa-folder"><span class="path1"></span><span class="path2"></span></i>
                                <span>Post Category</span>
                            </a>
                        </li>
                        @endcan
                        @can('tags.index')
                        <li class="{{ setActive('backend/tags') }}">
                            <a href="{{ route('backend.tags.index') }}" title="Tag">
                                <i class="fa fa-tags"><span class="path1"></span><span class="path2"></span></i>
                                <span>Tag</span>
                            </a>
                        </li>
                        @endcan
                        @can('posts.index')
                        <li class="{{ setActive('backend/posts') }}">
                            <a href="{{ route('backend.posts.index') }}" title="Post">
                                <i class="fa fa-file-text-o"><span class="path1"></span><span class="path2"></span></i>
                                <span>Post</span>
                            </a>
                        </li>
                        @endcan
                        @can('greetings.index')
                        <li class="{{ setActive('backend/greetings') }}">
                            <a href="{{ route('backend.greetings.index') }}" title="Greetings">
                                <i class="fa fa-bullhorn" aria-hidden="true"><span class="path1"></span><span class="path2"></span></i>
                                <span>Greetings</span>
                            </a>
                        </li>
                        @endcan
                        @endif
                        <li class="header">Pages</li>
                        @if (auth()->user()->can('pages.index') ||
                        auth()->user()->can('pagecategories.index'))
                        @can('pagecategories.index')
                        <li class="{{ setActive('backend/pagecategories') }}">
                            <a href="{{ route('backend.pagecategories.index') }}" title="Page Category">
                                <i class="fa fa-folder"><span class="path1"></span><span class="path2"></span></i>
                                <span>Page Category</span>
                            </a>
                        </li>
                        @endcan
                        @can('pages.index')
                        <li class="{{ setActive('backend/pages') }}">
                            <a href="{{ route('backend.pages.index') }}" title="Pages">
                                <i class="fa fa-file-text-o"><span class="path1"></span><span class="path2"></span></i>
                                <span>Pages</span>
                            </a>
                        </li>
                        @endcan
                        @endif --}}
                        {{-- Pages Menu  --}}

                        @if (auth()->user()->can('tahun ajaran.index') ||
                        auth()->user()->can('semester.index') )
                        @endif
                        <li class="header">Master Data</li>
                         @if (auth()->user()->can('tahun ajaran.index') ||
                        auth()->user()->can('semester.index') )
                        <li class="treeview {{ setActive('backend/tahunajaran') . setActive('backend/semester') }} {{ setOpen('backend/tahunajaran') . setOpen('backend/semester')}}">
                        <a href="#">
                            <i class="icon-Chat-locked"><span class="path1"></span><span
                                class="path2"></span></i>
                                <span>Master data</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('tahun ajaran.index')
                                <li class="{{ setActive('backend/tahunajaran') }}">
                                    <a href="{{ route('backend.tahunajaran.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Tahun Ajaran
                                    </a>
                                </li>
                                @endcan
                                @can('semester.index')
                                <li class="{{ setActive('backend/semester') }}">
                                    <a href="{{ route('backend.semester.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Semester
                                    </a>
                                </li>
                                @endcan
                                @can('jenistagihan.index')
                                <li class="{{ setActive('backend/jenistagihan') }}">
                                    <a href="{{ route('backend.jenistagihan.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Jenis Tagihan
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->can('sekolah.index') ||
                        auth()->user()->can('yayasan.index') )
                        @endif
                        <li class="header">Data Lembaga</li>
                         @if (auth()->user()->can('sekolah.index') ||
                        auth()->user()->can('yayasan.index') )
                        <li class="treeview {{ setActive('backend/sekolah') . setActive('backend/yayasan') }} {{ setOpen('backend/sekolah') . setOpen('backend/yayasan')}}">
                        <a href="#">
                            <i class="icon-Chat-locked"><span class="path1"></span><span
                                class="path2"></span></i>
                                <span>Data Lembaga</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('sekolah.index')
                                <li class="{{ setActive('backend/sekolah') }}">
                                    <a href="{{ route('backend.sekolah.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Sekolah
                                    </a>
                                </li>
                                @endcan
                                @can('yayasan.index')
                                <li class="{{ setActive('backend/yayasan') }}">
                                    <a href="{{ route('backend.yayasan.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Yayasan
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        {{-- Referensi  --}}
                        @if (auth()->user()->can('bentuk pendidikan.index') || auth()->user()->can('agama.index') || auth()->user()->can('master wilayah.index') || auth()->user()->can('jenjang pendidikan.index') || auth()->user()->can('tingkat pendidikan.index') || auth()->user()->can('status kepemilikan.index')
                        || auth()->user()->can('kebutuhan khusus.index') || auth()->user()->can('akreditasi.index') || auth()->user()->can('jenis rombel.index') || auth()->user()->can('jenis ptk.index') || auth()->user()->can('jurusan.index') || auth()->user()->can('kurikulum.index') || auth()->user()->can('matapelajaran.index') )
                        <li class="header">Referensi</li>
                        @if (auth()->user()->can('bentuk pendidikan.index') || auth()->user()->can('agama.index') || auth()->user()->can('master wilayah.index') || auth()->user()->can('jenjang pendidikan.index') || auth()->user()->can('tingkat pendidikan.index') || auth()->user()->can('status kepemilikan.index')
                        || auth()->user()->can('kebutuhan khusus.index') || auth()->user()->can('akreditasi.index') || auth()->user()->can('jenis rombel.index') || auth()->user()->can('jenis ptk.index') || auth()->user()->can('jurusan.index') || auth()->user()->can('kurikulum.index') || auth()->user()->can('matapelajaran.index') )
                        <li class="treeview {{ setActive('backend/bentukpendidikan') . setActive('backend/jenjangpendidikan') . setActive('backend/agama')  . setActive('backend/indonesia') . setActive('backend/tingkatpendidikan')  . setActive('backend/statuskepemilikan') . setActive('backend/kebutuhankhusus')
                        . setActive('backend/akreditasi') . setActive('backend/jenisrombel') . setActive('backend/jenisptk') . setActive('backend/jurusan')  . setActive('backend/kurikulum') . setActive('backend/matapelajaran') }}
                        {{ setOpen('backend/bentukpendidikan') . setOpen('backend/jenjangpendidikan') . setOpen('backend/agama')  . setOpen('backend/indonesia') . setOpen('backend/tingkatpendidikan') . setOpen('backend/statuskepemilikan')  . setOpen('backend/kebutuhankhusus')
                        . setOpen('backend/akreditasi') . setOpen('backend/jenisrombel') . setOpen('backend/jenisptk') . setOpen('backend/jurusan') . setOpen('backend/kurikulum') . setOpen('backend/matapelajaran')}}">
                        <a href="#">
                            <i class="icon-Settings-2">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span>Referensi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('agama.index')
                            <li class="{{ setActive('backend/agama') }}">
                                <a href="{{ route('backend.agama.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Agama
                                </a>
                            </li>
                            @endcan
                            @can('akreditasi.index')
                            <li class="{{ setActive('backend/akreditasi') }}">
                                <a href="{{ route('backend.akreditasi.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Akeditasi
                                </a>
                            </li>
                            @endcan
                            @can('jenis ptk.index')
                            <li class="{{ setActive('backend/jenisptk') }}">
                                <a href="{{ route('backend.jenisptk.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Jenis PTK
                                </a>
                            </li>
                            @endcan
                            @can('jurusan.index')
                            <li class="{{ setActive('backend/jurusan') }}">
                                <a href="{{ route('backend.jurusan.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Jurusan
                                </a>
                            </li>
                            @endcan

                            @can('bentuk pendidikan.index')
                            <li class="{{ setActive('backend/bentukpendidikan') }}">
                                <a href="{{ route('backend.bentukpendidikan.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Bentuk Pendidikan
                                </a>
                            </li>
                            @endcan
                            @can('jenjang pendidikan.index')
                            <li class="{{ setActive('backend/jenjangpendidikan') }}">
                                <a href="{{ route('backend.jenjangpendidikan.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Jenjang Pendidikan
                                </a>
                            </li>
                            @endcan
                            @can('tingkat pendidikan.index')
                            <li class="{{ setActive('backend/tingkatpendidikan') }}">
                                <a href="{{ route('backend.tingkatpendidikan.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Tingkat Pendidikan
                                </a>
                            </li>
                            @endcan
                            @can('jenis rombel.index')
                            <li class="{{ setActive('backend/jenisrombel') }}">
                                <a href="{{ route('backend.jenisrombel.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Jenis Rombel
                                </a>
                            </li>
                            @endcan
                            @can('kurikulum.index')
                            <li class="{{ setActive('backend/kurikulum') }}">
                                <a href="{{ route('backend.kurikulum.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Kurikulum
                                </a>
                            </li>
                            @endcan
                            @can('matapelajaran.index')
                            <li class="{{ setActive('backend/matapelajaran') }}">
                                <a href="{{ route('backend.matapelajaran.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Mata Pelajaran
                                </a>
                            </li>
                            @endcan
                            @can('status kepemilikan.index')
                            <li class="{{ setActive('backend/statuskepemilikan') }}">
                                <a href="{{ route('backend.statuskepemilikan.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Status Kepemilikan
                                </a>
                            </li>
                            @endcan
                            @can('kebutuhan khusus.index')
                            <li class="{{ setActive('backend/kebutuhankhusus') }}">
                                <a href="{{ route('backend.kebutuhankhusus.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Kebutuhan Khusus
                                </a>
                            </li>
                            @endcan
                            @can('master wilayah.index')
                            <li class="{{ setActive('backend/indonesia') }}">
                                <a href="{{ route('backend.wilayah.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Wilayah Indonesia
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                    @endif
                    {{-- Data Master  --}}
                    {{-- Setting Menu  --}}
                    @if (auth()->user()->can('settings.index') ||
                    auth()->user()->can('widgets.index') ||
                    auth()->user()->can('menu.index'))
                    <li class="header">LOGIN && CONFIGURATION</li>
                    @if (auth()->user()->can('settings.index') ||
                    auth()->user()->can('widgets.index') ||
                    auth()->user()->can('menu.index'))
                    <li class="treeview {{ setActive('backend/allwidget') . setActive('backend/jenjangpendidikan') . setActive('backend/menu') . setActive('backend/settings') }}
                        {{ setOpen('backend/allwidget') . setOpen('backend/jenjangpendidikan') . setOpen('backend/menu') . setOpen('backend/settings') }}">
                    <a href="#">
                        <i class="icon-Settings-2">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        <span>Configuration</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        @can('settings.index')
                        <li class="{{ setActive('backend/settings') }}">
                            <a href="{{ route('backend.settings.index') }}">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                Setting Web
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endif
                {{-- Setting Menu  --}}

                {{-- Authentication Menu  --}}
                @if (auth()->user()->can('roles.index') ||
                auth()->user()->can('permissions.index') ||
                auth()->user()->can('users.index'))
                <li
                class="treeview {{ setActive('backend/roles/index') . setActive('backend/permissions/index') . setActive('backend/users/index') }} {{ setOpen('backend/roles/index') . setOpen('backend/permissions/index') . setOpen('backend/users/index') }}">
                <a href="#">
                    <i class="icon-Chat-locked"><span class="path1"></span><span
                        class="path2"></span></i>
                        <span>Authentication</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permissions.index')
                        <li class="{{ setActive('backend/permissions/index') }}">
                            <a href="{{ route('backend.permissions.index') }}">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                Permissions
                            </a>
                        </li>
                        @endcan
                        @can('roles.index')
                        <li class="{{ setActive('backend/roles/index') }}">
                            <a href="{{ route('backend.roles.index') }}">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                Roles
                            </a>
                        </li>
                        @endcan
                        @can('users.index')
                        <li class="{{ setActive('backend/users/index') }}">
                            <a href="{{ route('backend.users.index') }}">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                Users
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                {{-- Authentication Menu  --}}

            </ul>
        </div>
    </div>
</section>
<div class="sidebar-footer">
    <a href="#" class="link" data-bs-toggle="tooltip" title="Email">
        <span class="icon-Mail"></span>
    </a>

</div>
</aside>

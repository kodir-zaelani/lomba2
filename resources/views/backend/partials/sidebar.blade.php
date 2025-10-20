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

                        {{-- <li class="header">Pages</li>
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
                         <li class="{{ setActive('backend/binaan') }}">
                            <a href="{{ route('backend.binaan.index') }}" title="Pages">
                                <i class="fa fa-file-text-o"><span class="path1"></span><span class="path2"></span></i>
                                <span>Pendampingan</span>
                            </a>
                        </li>
                        <li class="header">Galleries</li>
                        {{-- Galeries Menu --}}
                        @if (auth()->user()->can('agendas.index') ||
                        auth()->user()->can('downloadfiles.index') ||
                        auth()->user()->can('downloadcategories.index') ||
                        auth()->user()->can('sliders.index') ||
                        auth()->user()->can('hero.index') ||
                        auth()->user()->can('albums.index') ||
                        auth()->user()->can('albums.create') ||
                        auth()->user()->can('advertisements.index') ||
                        auth()->user()->can('advertisements.create') ||
                        auth()->user()->can('video.index') ||
                        auth()->user()->can('haribesar.index') ||
                        auth()->user()->can('facility.index') ||
                        auth()->user()->can('video.create'))
                        <li
                        class="treeview {{ setActive('backend/agenda') . setActive('backend/dldcategory') . setActive('backend/facility') . setActive('backend/haribesar') . setActive('backend/sliders') . setActive('backend/albums') . setActive('backend/photos') . setActive('backend/advertisements') . setActive('backend/video') . setActive('backend/heros')}}
                        {{ setOpen('backend/agenda') . setOpen('backend/dldcategory') . setOpen('backend/facility') . setOpen('backend/haribesar') . setOpen('backend/sliders') . setOpen('backend/sliders') . setOpen('backend/photos') . setOpen('backend/advertisements') . setOpen('backend/video') . setOpen('backend/heros') }}">
                        <a href="#">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            <span class="path1"></span><span class="path2"></span></i>
                            <span>Galeries</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            @can('albums.index')
                            <li class="{{ setActive('backend/albums') }}">
                                <a href="{{ route('backend.albums.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span>
                                    </i>Albums Photo
                                </a>
                            </li>
                            @endcan
                            @can('video.index')
                            <li class="{{ setActive('backend/video') }}">
                                <a href="{{ route('backend.video.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span>
                                    </i>Video
                                </a>
                            </li>
                            @endcan
                            @can('hero.index')
                            <li class="{{ setActive('backend/hero') }}">
                                <a href="{{ route('backend.heros.index') }}">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    Hero Static
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                    {{-- End Galeries Menu --}}
                    @if (auth()->user()->can('tahun ajaran.index') ||
                    auth()->user()->can('employee.index') ||
                    auth()->user()->can('semester.index') )
                    @endif
                    <li class="header">Master Data</li>
                    @if (auth()->user()->can('tahun ajaran.index') ||
                            auth()->user()->can('employee.index') ||
                    auth()->user()->can('semester.index') )
                    <li class="treeview {{ setActive('backend/tahunajaran') . setActive('backend/pegawai') . setActive('backend/semester') }} {{ setOpen('backend/tahunajaran') . setOpen('backend/pegawai') . setOpen('backend/semester')}}">
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
                                @can('employee.index')
                                <li class="{{ setActive('backend/pegawai') }}">
                                    <a href="{{ route('backend.pegawai.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Pegawai
                                    </a>
                                </li>
                                @endcan
                                <li class="{{ setActive('backend/dukungan') }}">
                                    <a href="{{ route('backend.dukungan.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Dukungan
                                    </a>
                                </li>
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
                                            Satuan Pendidikan
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endif
                            {{-- Setting Menu  --}}
                            @if (
                            auth()->user()->can('settings.index') ||
                            auth()->user()->can('socialmedia.index') ||
                            auth()->user()->can('menu.index') ||
                            auth()->user()->can('roles.index') ||
                            auth()->user()->can('permissions.index') ||
                            auth()->user()->can('users.index')
                            )
                            <li class="header">LOGIN && CONFIGURATION</li>
                            @if (auth()->user()->can('settings.index') ||
                            auth()->user()->can('socialmedia.index') ||
                            auth()->user()->can('menu.index'))
                            <li class="treeview {{setActive('backend/menu') . setActive('backend/settings')  . setActive('backend/socialmedia') }}
                        {{  setOpen('backend/menu') . setOpen('backend/settings')   . setOpen('backend/socialmedia') }}">
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
                                    <a href="{{ route('backend.settings') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Setting Web
                                    </a>
                                </li>
                                @endcan
                                @can('menu.index')
                                <li class="{{ setActive('backend/menu') }}">
                                    <a href="{{ route('backend.menu.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Menu
                                    </a>
                                </li>
                                @endcan
                                @can('socialmedia.index')
                                <li class="{{ setActive('backend/socialmedia') }}">
                                    <a href="{{ route('backend.socialmedia.index') }}">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                        Social Media
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

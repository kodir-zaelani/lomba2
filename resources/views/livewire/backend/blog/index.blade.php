<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">{{$title_page}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">
                                <i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Blog
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-body">
                        <x-flash-message/>
                        <ul class="nav nav-tabs customtab2" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#pos-all" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fa fa-folder-open" aria-hidden="true"></i></span> <span class="hidden-xs-down">All</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#blog-own" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Own</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#blog-published" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="fa fa-folder-open-o" aria-hidden="true"></i></span> <span class="hidden-xs-down">Published</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#blog-draft" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="fa fa-hdd-o" aria-hidden="true"></i></span> <span class="hidden-xs-down">Draft</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#blog-trash" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span> <span class="hidden-xs-down">Trash</span></a> </li>
                            <li class="nav-item"> <a class="nav-link"  href="{{route('backend.blog.create')}}"><span class="hidden-sm-up"><i class="fa fa-plus-square" aria-hidden="true"></i></span> <span class="hidden-xs-down fw-bold">Add New</span></a> </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="pos-all" role="tabpanel">
                                @livewire('backend.blog.all')
                            </div>
                            <div class="tab-pane" id="blog-own" role="tabpanel">
                                @livewire('backend.blog.own')
                            </div>
                            <div class="tab-pane" id="blog-published" role="tabpanel">
                                    @livewire('backend.blog.published')
                            </div>
                            <div class="tab-pane" id="blog-draft" role="tabpanel">
                                @livewire('backend.blog.draft')
                            </div>
                            <div class="tab-pane" id="blog-trash" role="tabpanel">
                                    @livewire('backend.blog.trash')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

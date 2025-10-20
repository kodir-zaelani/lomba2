<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">@yield('title')</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                                class="fa fa-home"><span class="path1"></span><span
                                class="path2"></span></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Video</li>
                                <li class="breadcrumb-item active" aria-current="page">List</li>
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
                        <div class="box-header with-border">
                            <h4 class="box-title">@yield('title')</h4>
                            <div class="box-controls pull-right">
                                <a class="btn btn-primary btn-xs" href="{{ route('backend.video.create') }}">
                                    <i class="py-2 bi bi-plus-circle-fill"></i> Add</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <x-flash-message/>
                                <div class="mb-2 row">
                                    <div class="mb-2 col-xl-2 col-lg-2 col-md-2 col-12">
                                        <select wire:model.live="paginate" name="" id=""
                                        class="w-auto form-control-sm custom-select">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-lg-5 col-md-5 col-12">
                                    @if ($checked)
                                    <div class="mb-5 btn-group">
                                        <button type="button" class="waves-effect waves-light btn btn-info">With
                                            Checked ({{ count($checked) }})</button>
                                            <button type="button"
                                            class="waves-effect waves-light btn btn-info dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item" type="button"
                                            data-bs-toggle="modal" data-bs-target="#modalFormDeleteAll">
                                            Delete Selected
                                        </a>
                                        <a href="#" class="dropdown-item" type="button"
                                        data-bs-toggle="modal" data-bs-target="#modalFormExportExcel">
                                        Export Excel
                                    </a>
                                    <a href="#" class="dropdown-item" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modalFormExportPDF">
                                    Export PDF
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="mb-2 text-right col-md-5 col-lg-5 col-12 ">
                        <div class="form-group">
                            <div class="mb-3 input-group">
                                <input type="search" wire:model..live.debounce.500ms="search" class="form-control"
                                wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch"
                                class="float-right form-control" placeholder="Search by ...">
                                <span class="input-group-text"><i class="ti-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                        @if ($datavideoall->count())
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover">
                                <tbody>
                                    <tr>
                                        <th width="4%" scope="col">#</th>
                                        {{-- <th>
                                            <div class="checkbox">
                                                <input id="checkbox2" type="checkbox" wire:model="selectPage">
                                                <label for="checkbox2"> </label>
                                            </div>
                                        </th> --}}
                                        @foreach ($headersTable as $key => $value)
                                        <th scope="col"
                                        wire:click.prevent="sortBy('{{ $key }}')"
                                        style="cursor: pointer">
                                        {{ $value }}
                                        @if ($sortColumn == $key)
                                        <span>{!! $sortDirection == 'asc' ? '&#8659' : '&#8657' !!}</span>
                                        @endif
                                    </th>
                                    @endforeach
                                    <th scope="col" width="20%" class="text-center">Action</th>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach ($datavideoall as $no => $item)
                                <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                                    <th class="text-right" scope="row">
                                        {{ $no + $datavideoall->firstItem() }}</th>
                                        {{-- <td>
                                            <div class="checkbox">
                                                <input type="checkbox" id="Checkbox_{{ $no + $datavideoall->firstItem() }}" value="{{ $item->id }}" wire:model="checked">
                                                <label for="Checkbox_{{ $no + $datavideoall->firstItem() }}"></label>
                                            </div>
                                        </td> --}}
                                        <td width="10%">
                                            <img class="rounded w-80"
                                            src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                                            alt="...">
                                        </td>
                                        <td>
                                            {{ !empty($item->title) ? $item->title : '' }}<br />
                                            <span class="text-primary">{{ TanggalID('j M Y', $item->created_at) }}</span>
                                        </td>
                                        {{-- <td width="10%">
                                            {!! $item->statuslabel !!}
                                        </td> --}}
                                        {{-- <td <td width="20%">
                                            {{ TanggalID("j M Y", $item->created_at) }}
                                        </td> --}}
                                        <td class="text-center align-midle">
                                            @if ($item->status == 1)
                                            <button
                                            wire:click="selectItem('{{ $item->id }}', 'draft')"
                                            class="btn btn-xs btn-success"
                                            title="Change to Draft"><i
                                            class="fa fa-eye"></i></button>
                                            @else
                                            <button
                                            wire:click="selectItem('{{ $item->id }}', 'publish')"
                                            class="btn btn-xs btn-default"
                                            title="Change to Publish"><i
                                            class="fa fa-eye"></i></button>
                                            @endif
                                            <a title="Edit" class="btn btn-xs btn-warning edit-row"
                                            href="{{ route('backend.video.edit', $item->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button
                                        wire:click="selectItem('{{ $item->id }}' , 'delete')"
                                        class="mx-1 my-1 btn btn-xs btn-danger"
                                        title="Delete"><i
                                        class="fa fa-trash "></i></button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-xl-12 col-md-12 col-lg-12 col-12 text-start small text-muted">
                            @if ($datavideoall->total() > 10)
                            {{ $datavideoall->links() }}
                            @else
                            Page : {{ $datavideoall->currentPage() }} | Show {{ $datavideoall->count() }} data
                            of {{ $datavideoall->total() }}
                            @endif
                        </div>
                    </div>
                    @else
                    <hr>
                    <h2 style="color: red" class="text-center">@yield('title') not available</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal center-modal fade" id="modalFormDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Selected Item {{ $selectedItem }} --}}
                <p>
                    <h3>Do you wish to continue?</h3>
                </p>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button wire:click="delete" class="btn btn-primary float-end">Yes</button>
            </div>
        </div>
    </div>
</div>
</section>
</div>

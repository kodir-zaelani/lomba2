<div>
    {{-- @section('title', 'List of Agenda') --}}
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
                                <li class="breadcrumb-item" aria-current="page">Agenda</li>
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
                                <a class="btn btn-sm btn-primary" href="{{ route('backend.agendas.create') }}">
                                    <i class="bi bi-plus-circle-fill"></i> Add
                                </a>
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
                            <div class="mb-2 ms-auto col-md-5 col-lg-5 col-12 ">
                                <div class="form-group">
                                    <div class="mb-3 input-group">
                                        <input type="search" wire:model.live.debounce.500ms="search" class="form-control"
                                        wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch"
                                        class="float-right form-control" placeholder="Search by ...">
                                        <span class="input-group-text"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                @if ($dataagendaall->count())
                                <div class="table-responsive">
                                    <table class="table mb-0 table-hover">
                                        <tbody>
                                            <tr>
                                                <th width="4%" scope="col">#</th>
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
                                        @foreach ($dataagendaall as $no => $item)
                                        <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                                            <th class="text-right" scope="row">
                                                {{ $no + $dataagendaall->firstItem() }}</th>
                                                <td width="10%">
                                                    <img class="rounded w-80"
                                                    src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                                                    alt="...">
                                                </td>
                                                <td>
                                                    {{ !empty($item->title) ? $item->title : '' }}<br />
                                                </td>
                                                <td width="10%">
                                                    {!! $item->statuslabel !!}
                                                </td>
                                                <td>
                                                    {{ TanggalID('j M Y', $item->created_at) }}
                                                </td>
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
                                                    href="{{ route('backend.agendas.edit', $item->id) }}">
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
                                    @if ($dataagendaall->total() > 10)
                                    {{ $dataagendaall->links() }}
                                    @else
                                    Page : {{ $dataagendaall->currentPage() }} | Show {{ $dataagendaall->count() }} data
                                    of {{ $dataagendaall->total() }}
                                    @endif
                                </div>
                            </div>
                            @else
                            <h2 style="color: red" class="text-center">@yield('title') not available</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Delete --}}
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

            {{-- Modal Delete --}}
            <div class="modal center-modal fade" id="modalFormRemoveImage" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Remove Image Item</h5>
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
                            <button wire:click="remove_image" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Delete --}}
            {{-- Modal Delete All --}}
            <div class="modal center-modal fade" id="modalFormDeleteAll" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Selected Item</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <p>
                                <h3>Are you sure you want to delete these Selected Records?</h3>
                            </p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button wire:click="deleteRecords()" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Delete All --}}
            {{-- Modal Export Excel --}}
            <div class="modal center-modal fade" id="modalFormExportExcel" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Selected Item</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <p>
                                <h3>Are you sure you want to Export Spreadsheet these Selected Records?</h3>
                            </p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Export Excel --}}
            {{-- Modal Export PDF --}}
            <div class="modal center-modal fade" id="modalFormExportPDF" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Selected Item</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <p>
                                <h3>Are you sure you want to Export PDF these Selected Records?</h3>
                            </p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Export PDF --}}
        </section>
        @push('scripts')
        <script>
            // Sweet Alert
            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    type: event.detail.icon,
                });
            });

            //  Open modal restore
            window.addEventListener('openmodalFormRemoveImage', event => {
                $("#modalFormRemoveImage").modal('show');
            });

            //  Close modal restore
            window.addEventListener('closemodalFormRemoveImage', event => {
                $("#modalFormRemoveImage").modal('hide');
            });
        </script>
        @endpush
    </div>

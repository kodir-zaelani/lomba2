<div>
    @php
    $currentUser =  Auth::user();
    @endphp
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">{{ $title}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span
                                class="path1"></span><span class="path2"></span></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Jenis Tagihan</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title}}</li>
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
                            <select wire:model.live="paginate" id="paginate_id" class="pb-2 form-control-sm custom-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <button  wire:click="addtagihan" class="btn btn-success btn-sm ms-3" title="Add New"> <i class="fa fa-plus me-2" aria-hidden="true"></i> Add</button>
                            <ul class="box-controls pull-right">
                                <li>
                                    <div class="ms-auto form-group me-2 expand">
                                        <div class="input-group ">
                                            <input type="text" wire:model.live.debounce.500ms="search" class="form-control border-primary" wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" class="form-control" placeholder="Search by ..." autofocus>
                                            <span class="input-group-text bg-primary"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <x-flash-message/>
                            @if ($statusUpdate == true)
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                    <div class="box box-bordered border-primary">
                                        @include('livewire.backend.jenistagihan.edit')
                                    </div>
                                </div>
                            </div>
                            @elseif($statusCreate == true)
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                    <div class="box box-bordered border-primary">
                                        @include('livewire.backend.jenistagihan.create')
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                    @if ($datajenistagihan->count())
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover">
                                            <tbody>
                                                <tr>
                                                    <th width="4%" scope="col">#</th>
                                                    @foreach ($headersTable as $key => $value)
                                                    <th scope="col" wire:click.prevent="sortBy('{{ $key }}')" style="cursor: pointer">
                                                        {{ $value }}
                                                        @if ($sortColumn == $key)
                                                        <span>{!! $sortDirection == 'asc' ? '&#8659':'&#8657' !!}</span>
                                                        @endif
                                                    </th>
                                                    @endforeach
                                                    <th scope="col" width="20%">Action</th>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                @foreach ($datajenistagihan as $no =>  $item)
                                                <tr class="@if ($this->isChecked($item->id))
                                                table-primary
                                                @endif">
                                                    <th class="text-right" scope="row">{{ $no + $datajenistagihan->firstItem() }}</th>
                                                    <td>
                                                        {{ !empty($item->tahunajaran_id) ? $item->tahunajaran->nama:'' }}
                                                    </td>
                                                    <td>
                                                        {{ !empty($item->nama) ? $item->nama:'' }}
                                                    </td>
                                                    <td width="10%">
                                                        {!! $item->periodiklabel !!}
                                                    </td>
                                                    <td>
                                                        {!! $item->jenisperiodiktext !!}
                                                    </td>
                                                    <td class="text-center align-midle">
                                                        {{-- @if ($item->masterstatus == config('cms.default_masteruser') || $currentUser->id == $item->id)
                                                        <button class="btn btn-xs btn-success disabled" title="No Change"><i class="fa fa-eye"></i></button>
                                                        @else
                                                        @if ($item->status == 1)
                                                        <button wire:click="selectItem('{{ $item->id }}', 'inactive')" class="btn btn-xs btn-success" title="Change to InActive"><i class="fa fa-eye"></i></button>
                                                        @else
                                                        <button wire:click="selectItem('{{ $item->id }}', 'active')" class="btn btn-xs btn-default" title="Change to Active"><i class="fa fa-eye"></i></button>
                                                        @endif
                                                        @endif
                                                        <a href="{{ route('backend.users.edit', $item->id) }}" class="btn btn-xs btn-warning">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        @if ($item->masterstatus == config('cms.default_masteruser') || $currentUser->id == $item->id)
                                                        <button   class="mx-1 my-1 btn btn-xs btn-danger disabled" title="Delete"><i class="fa fa-trash "></i></button>
                                                        @else
                                                        <button wire:click="selectItem('{{ $item->id }}', 'delete')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash "></i></button>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 row">
                                        @if ($datajenistagihan->total() > 10)
                                        <div class="col-12 ">
                                            {{ $datajenistagihan->links() }}
                                        </div>
                                        @else
                                        <div class="col-12 text-start small text-muted">
                                            Page : {{ $datajenistagihan->currentPage() }} | Show {{ $datajenistagihan->count() }} data
                                            of {{ $datajenistagihan->total() }}
                                        </div>
                                        @endif
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
            {{-- Modal Delete--}}
            <div class="modal center-modal fade" id="modalFormDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Selected Item {{ $selectedItem }} --}}
                            <p><h3>Do you wish to continue?</h3></p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button wire:click="delete" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Delete--}}
            <div class="modal center-modal fade" id="modalFormDeleteAll" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Selected Item</h5>
                        </div>
                        <div class="modal-body">
                            <p><h3>Are you sure you want to delete these Selected Records?</h3></p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button wire:click="deleteRecords()" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
        <script src="{{ asset('') }}assets/vendor_components/sweetalert/sweetalert.min.js"></script>
        {{-- <script src="{{ asset('') }}assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js"></script> --}}
        <script>
            // Sweet Alert
            window.addEventListener('swal:modaldelete', event => {
                swal({
                    type: event.detail.icon,
                    title: event.detail.title,
                    text: event.detail.text,
                    timer: event.detail.timer,
                });
            });

        </script>
        @endpush
    </div>

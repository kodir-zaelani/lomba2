<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">{{ $title}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.dashboard') }}">
                                    <i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Satuan Pendidikan</li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <x-flash-message/>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <div class="mb-2 row">
                            <div class="mb-2 col-xl-3 col-lg-3 col-md-3 col-12">
                                <select wire:model.live="paginate" name="" id="" class="w-auto form-control-sm custom-select">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                @if ($statusCreate == false )
                                <button class="btn btn-sm btn-primary ms-3"  wire:click="createData">
                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                    Add
                                </button>
                                {{-- @elseif ($statusUpdate == true)
                                <button class="btn btn-sm btn-primary ms-3 " wire:click="cancelEdit">
                                    Batal
                                </button>
                                @elseif ($statusCreate == true)
                                <button class="btn btn-sm btn-primary ms-3" wire:click="cancelAdd">
                                    Batal
                                </button> --}}

                                @endif
                            </div>
                            <div class="mb-2 ms-auto col-md-5 col-lg-5 col-12 ">
                                <div class="form-group">
                                    <div class="mb-3 input-group">
                                        <input type="search" wire:model.live.debounce.500ms="search" class="form-control" wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" class="float-right form-control" placeholder="Search by ...">
                                        <span class="input-group-text"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($statusCreate == true)
                    @include('livewire.backend.sekolah.create')
                    @elseif ($statusUpdate == true)
                    @include('livewire.backend.sekolah.edit')
                    @else
                    @include('livewire.backend.sekolah.list')
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@push('styles')
<link rel="stylesheet"
href="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
@endpush
@push('scripts')
<script src="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ asset('') }}assets/vendor_components/select2/dist/js/select2.full.js"></script>
@endpush

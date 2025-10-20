<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Tags</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                                        class="fa fa-home"><span class="path1"></span><span
                                            class="path2"></span></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tags</li>
                            <li class="breadcrumb-item active" aria-current="page">Tag List</li>
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
                            <select wire:model.live="paginate" id="paginate_id" class="form-control-sm custom-select ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <ul class="box-controls pull-right">
                                <li>
                                    <div class="ms-auto form-group me-2">
                                        <div class="input-group ">
                                            <input type="search" wire:model.live="search" class="form-control border-primary" wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" class="form-control" placeholder="Search by ...">
                                            <span class="input-group-text bg-primary"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <div class="box-body">
                        <x-flash-message/>
                        <div class="row">
                            <div class="col">
                                @if ($statusUpdate == true)
                                    @include('livewire.backend.tag.edit')
                                @else
                                    @include('livewire.backend.tag.create')
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                @if ($datatag->count())
                                    <div class="table-responsive">
                                        <table class="table mb-0 editable-table table-hover">
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
                                                    <th scope="col" width="20%">Action</th>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                @foreach ($datatag as $no => $item)
                                                    <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                                                        <th class="text-right" scope="row">
                                                            {{ $no + $datatag->firstItem() }}</th>
                                                        <td>
                                                            <a title="Show"
                                                                href="#"
                                                                target="_blank" style="text-decoration: none; ">
                                                                {{ !empty($item->title) ? $item->title : '' }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-midle">
                                                            <button wire:click="edit('{{ $item->id }}')" class="btn btn-xs btn-warning" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                @else
                                    <hr>
                                    <h2 style="color: red" class="text-center">@yield('title') not available</h2>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 row">
                            @if ($datatag->total() > 10)
                            <div class="col-12 ">
                                {{ $datatag->links() }}
                            </div>
                            @else
                            <div class="col-12 text-start small text-muted">
                                Page : {{ $datatag->currentPage() }} | Show {{ $datatag->count() }} data
                                of {{ $datatag->total() }}
                            </div>
                            @endif
                        </div>
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
    </section>
@push('scripts')

<script>
    // Sweet Alert
    window.addEventListener('swal:modal', event => {
        swal({
            title: event.detail.title,
            text: event.detail.text,
            type: event.detail.type,
        });
    });
    window.addEventListener('swal:modaldelete', event => {
        swal({
            type: event.detail.type,
            title: event.detail.title,
            text: event.detail.text,
            timer: event.detail.timer,

        });
    });
</script>
@endpush
</div>

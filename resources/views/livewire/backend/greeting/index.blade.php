<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">{{$title_page}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                                class="fa fa-home"><span class="path1"></span><span
                                class="path2"></span></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Principle Greetings</li>
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
                            <h4 class="box-title">{{$title_page}}</h4>
                            <div class="box-controls pull-right">
                                <a class="btn btn-sm btn-primary" href="{{ route('backend.greetings.create') }}">
                                    <i
                                    class="bi bi-plus-circle-fill"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="mb-2 row">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-12">
                                    <select wire:model.live="paginate" name="" id=""
                                    class="w-auto form-control-sm custom-select">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="ms-auto col-md-5 col-lg-5 col-12 ">
                                <div class="form-group">
                                    <div class="mb-3 input-group">
                                        <input type="search" wire:model.live.debounce.250ms="search" class="form-control"
                                        wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch"
                                        class="float-right form-control" placeholder="Search by ...">
                                        <span class="input-group-text"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                @if ($datagreetingall->count())
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
                                        @foreach ($datagreetingall as $no => $item)
                                        <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                                            <th class="text-right" scope="row">
                                                {{ $no + $datagreetingall->firstItem() }}</th>
                                                <td width="16%" class="text-center">
                                                    <img class="rounded w-80"
                                                    src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                                                    alt="...">
                                                    @if ($item->image)
                                                    <br>
                                                    <small>
                                                        @if ($item->masterstatus == 0)
                                                        Image Publish
                                                        @else
                                                        Image unPublish
                                                        @endif
                                                    </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Show" href="#" target="_blank" style="text-decoration: none; color:#212529;">
                                                        {{ !empty($item->title) ? $item->title : '' }}
                                                    </a></br>
                                                    {!! $item->statuslabel !!} |
                                                    {{ TanggalID('j M Y', $item->created_at) }}
                                                </td>
                                                <td>
                                                    {{ TanggalID('j M Y', $item->published_at) }}
                                                </td>
                                                <td class="text-center align-midle">
                                                    @if ($item->status == 1)
                                                    <button wire:click="selectItem('{{ $item->id }}', 'inactive')" class="btn btn-xs btn-success" title="Change to Draft">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    @else
                                                    <button
                                                    wire:click="selectItem('{{ $item->id }}', 'active')"
                                                    class="btn btn-xs btn-default"
                                                    title="Change to Publish"><i
                                                    class="fa fa-eye"></i></button>
                                                    @endif
                                                    @if ($item->masterstatus == 0)
                                                    <button
                                                    wire:click="selectItem('{{ $item->id }}', 'imageinactive')"
                                                    class="btn btn-xs btn-danger"
                                                    title="unPublish Image"><i
                                                    class="fa fa-image"></i></button>
                                                    @else
                                                    <button
                                                    wire:click="selectItem('{{ $item->id }}', 'imageactive')"
                                                    class="btn btn-xs btn-default"
                                                    title="Publish Image"><i
                                                    class="fa fa-image"></i></button>
                                                    @endif
                                                    <a title="Edit" class="btn btn-xs btn-warning edit-row"
                                                    href="{{ route('backend.greetings.edit', $item->id) }}">
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
                                    @if ($datagreetingall->total() > 10)
                                    {{ $datagreetingall->links() }}
                                    @else
                                    Page : {{ $datagreetingall->currentPage() }} | Show {{ $datagreetingall->count() }} data
                                    of {{ $datagreetingall->total() }}
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

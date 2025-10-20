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
                                <li class="breadcrumb-item" aria-current="page">Album</li>
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
                                <a class="btn btn-sm btn-primary" href="{{ route('backend.albums.create') }}"><i
                                    class="bi bi-plus-circle-fill"></i> Add</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="mb-2 row">
                                    <div class="mb-2 col-xl-2 col-lg-2 col-md-2 col-12">
                                        <select wire:model="paginate" name="" id=""
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
                                            <input type="search" wire:model.debounce.500ms="search" class="form-control"
                                            wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch"
                                            class="float-right form-control" placeholder="Search by ...">
                                            <span class="input-group-text"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                    @if ($dataalbumall->count())
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
                                                <th scope="col" width="25%" class="text-center">Photos</th>
                                                <th scope="col" width="15%" class="text-center">Action</th>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            @foreach ($dataalbumall as $no => $item)
                                            <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                                                <th class="text-right" scope="row">
                                                    {{ $no + $dataalbumall->firstItem() }}</th>
                                                    <td width="10%">
                                                        <img class="rounded w-80"
                                                        src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                                                        alt="...">
                                                    </td>
                                                    <td>
                                                        <a title="Show"
                                                        href="#"
                                                        target="_blank" style="text-decoration: none;">
                                                        {{ !empty($item->title) ? $item->title : '' }}
                                                    </a><br>
                                                    {{-- <small> {{ TanggalID('j M Y', $item->created_at) }}</small> --}}
                                                    <small> {{ $item->fotos->count() }} photo</small>
                                                </td>
                                                <td class="text-center">
                                                    <button title="Photos" class="btn btn-sm
                                                    @if ($item->fotos->count()) btn-info
                                                            @else
                                                               btn-success @endif"
                                                    wire:click="selectItem('{{ $item->id }}' , 'addphotos')">
                                                    <i class="bi bi-images"></i>
                                                    @if ($item->fotos->count())
                                                    Update
                                                    @else
                                                    Add
                                                    @endif
                                                </button>
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
                                                href="{{ route('backend.albums.edit', $item->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if ($item->fotos->count() == 0)
                                            <button
                                            wire:click="selectItem('{{ $item->id }}' , 'delete')"
                                            class="mx-1 my-1 btn btn-xs btn-danger"
                                            title="Delete"><i class="fa fa-trash "></i></button>
                                            @endif

                                        </td>
                                    </tr>
                                    @if ($item->fotos->count())
                                    <tr>
                                        <td colspan="5">
                                            <div class="accordion accordion-flush" id="accordionFlushExample-{{$item->id}}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{$item->id}}" aria-expanded="false" aria-controls="flush-collapseOne-{{$item->id}}">
                                                            List Foto
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne-{{$item->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample-{{$item->id}}">
                                                        <div class="accordion-body">
                                                            @php
                                                            $fotos = App\Models\Foto::with('album')->where('album_id', $item->id)->get()
                                                            @endphp
                                                            <div class="row">
                                                                @forelse ($fotos as $item)
                                                                <div class="col-3">
                                                                    {{-- <img class="rounded w-80" src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}" alt="..."> --}}
                                                                    <img class="rounded w-80" src="{{asset('')}}/uploads/images/fotos/{{$item->image}}" alt="...">
                                                                    <br/>
                                                                    <button wire:click="selectItem('{{ $item->id }}' , 'deletefoto')" class="mx-1 my-1 btn btn-xs btn-danger" title="Delete">
                                                                        <i class="fa fa-trash "></i>
                                                                    </button>
                                                                </div>
                                                                @empty
                                                                data kosong
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-xl-12 col-md-12 col-lg-12 col-12 text-start small text-muted">
                                @if ($dataalbumall->total() > 10)
                                {{ $dataalbumall->links() }}
                                @else
                                Page : {{ $dataalbumall->currentPage() }} | Show {{ $dataalbumall->count() }} data
                                of {{ $dataalbumall->total() }}
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
    </div>
</div>
{{-- Modal Delete --}}
<div class="modal center-modal fade" id="modalFormDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item Album</h5>
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
<div class="modal center-modal fade" id="modalfotoFormDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item Foto</h5>
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
                <button wire:click="deletefoto" class="btn btn-primary float-end">Yes</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add Photo --}}
<div class="modal center-modal fade" id="modalFormAddPhotos" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-images"></i> Add Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class=" modal-body">
                {{-- Selected Item {{ $selectedItem }} --}}
                {{-- @livewire('backend.foto.addfotos') --}}
                <form id="post-form" enctype="multipart/form-data" action="{{ route('backend.albums.storefoto') }}" method="post">
                    @csrf
                    <div class="form-group" hidden>
                        <h5>Album id <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="album_id"
                            class="form-control @error('album_id') is-invalid @enderror"
                            value="{{ $selectedItem }}" >
                        </div>
                        @error('album_id')
                        <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h5>Title </h5>
                        <div class="controls">
                            <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" >
                        </div>
                        @error('title')
                        <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                        @enderror
                    </div>
                    <div class="text-center form-group">
                        <div class=" fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                <img src="{{ asset('/assets/images/no_image.png') }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;">
                            </div>
                            <div>
                                <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                    image</span><span class="fileinput-exists">Change</span>
                                    <input type="file" class="@error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                    data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            @error('image')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>
                        <button type="submit"class="btn btn-primary float-end">
                            Add Foto
                        </button>
                        <button type="button" class="btn btn-danger float-start" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Add Photo --}}
</section>
@push('styles')
<!-- Jasny Bootstrap 4 -->
<link rel="stylesheet"
href="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
@endpush

@push('scripts')
<script src="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<script>
    //  Open modal add photo
    window.addEventListener('openmodalFormAddPhotos', event => {
        $("#modalFormAddPhotos").modal('show');
    });

    //  Close modal add photo
    window.addEventListener('closemodalFormAddPhotos', event => {
        $("#modalFormAddPhotos").modal('hide');
    });
    //  Open modal delete photo
    window.addEventListener('openmodalFormdeleteFoto', event => {
        $("#modalfotoFormDelete").modal('show');
    });

    //  Close modal delete photo
    window.addEventListener('closemodalFormdeleteFoto', event => {
        $("#modalfotoFormDelete").modal('hide');
    });
</script>
@endpush
</div>

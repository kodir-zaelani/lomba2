<div>
    <div class="row pt-15">
        <div class="mb-2 col-xl-3 col-lg-3 col-md-3 col-12">
            <select wire:model.live="paginate" name="" id="" class="w-auto form-control-sm custom-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="text-right ms-auto col-md-5 col-lg-5 col-12 ">
            <div class="form-group">
                <div class="mb-3 input-group">
                    <input type="search" wire:model.live.debounce.500ms="search" class="form-control" wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" class="float-right form-control" placeholder="Search by ...">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12 col-12">
            @if ($datapostall->count())
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
                            <th scope="col" wire:click.prevent="sortBy('{{ $key }}')"
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
                    @foreach ($datapostall as $no => $item)
                    <tr class="@if ($this->isChecked($item->id)) table-primary @endif">
                        <th class="text-right" scope="row">{{ $no + $datapostall->firstItem() }}</th>
                        <td width="10%">
                            <img class="rounded w-80"
                            src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                            alt="...">
                        </td>
                        <td>
                            {{ !empty($item->title) ? $item->title : '' }}
                            <br>
                            @if ($item->statuspost == 0)
                            News |
                            @else
                            Blog |
                            @endif
                            <i class="fa fa-user ms-2 me-2" aria-hidden="true"></i>
                            {{ $item->author->name }}
                            <i class="fa fa-folder-open me-2 ms-2" aria-hidden="true"></i>
                            {{ !empty($item->postcategory_id) ? $item->postcategory->title : '' }}
                            <i class="fa fa-tags ms-2 me-2" aria-hidden="true" title="Tags"></i>
                            {!! $item->tags_html !!}
                        </td>
                        <td class="text-center align-midle">
                            @if ($item->author_id == $author_id || $currentUser->masterstatus == 1)
                            <button wire:click="selectItem('{{ $item->id }}', 'restore')"
                                class="btn btn-xs btn-warning" title="Restore"><i
                                class="fa fa-undo "></i></button>
                                <button wire:click="selectItem('{{ $item->id }}' , 'forcedelete')"
                                    class="mx-1 my-1 btn btn-xs btn-danger" title="Force Delete"><i
                                    class="fa fa-times "></i></button>
                                    @else
                                    <button class="btn btn-sm btn-warning" title="Forbidden" disabled><i
                                        class="fa fa-undo "></i></button>
                                        <button class="mx-1 my-1 btn btn-xs btn-danger" title="Forbidden"
                                        disabled><i class="fa fa-times "></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-xl-7 col-md-7 col-lg-7 col-12 ">
                            {{ $datapostall->links() }}
                        </div>
                        <div class="text-center col-xl-5 col-md-5 col-lg-5 col-12">
                            Page : {{ $datapostall->currentPage() }} | Show {{ $datapostall->count() }} data of
                            {{ $datapostall->total() }}
                        </div>
                    </div>
                    @else
                    <hr>
                    <h2 style="color: red" class="text-center">Posts Trashed not available</h2>
                    @endif
                </div>
            </div>
            <div class="modal center-modal fade" id="modalForceFormDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Force Delete Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Selected Item {{ $selectedItem }} --}}
                            <p>
                                <h3>Do you wish to continue ?</h3>
                            </p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button wire:click="force_delete" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal center-modal fade" id="modalFormRestore" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Restore Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <h3>Do you wish to continue restore?</h3>
                            </p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button wire:click="restore" class="btn btn-primary float-end">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
        <script>
            //  Open modal delete
            window.addEventListener('openDeleteModaltrash', event => {
                $("#modalForceFormDelete").modal('show');
            });

            //  Close modal delete
            window.addEventListener('closeDeleteModaltrash', event => {
                $("#modalForceFormDelete").modal('hide');
            });

            window.addEventListener('openRestoreModal', event => {
                $("#modalFormRestore").modal('show');
            });

            window.addEventListener('closeRestoreModal', event => {
                $("#modalFormRestore").modal('hide');
            });
        </script>
        @endpush

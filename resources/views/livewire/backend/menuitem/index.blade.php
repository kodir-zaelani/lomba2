<div>

    <section class="content">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <select wire:model.live="paginate" name="" id=""
                        class="w-auto form-control-sm custom-select me-2">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <a href="{{ route('backend.menuitem.create') }}" class="btn btn-success btn-sm">
                        Add Menu Item
                    </a>
                    <a href="{{ route('backend.menuitem.structure') }}" class="btn btn-primary btn-sm ms-2">
                        Structure
                    </a>

                    <div class="form-group pull-right">
                        <div class="mb-3 input-group">
                            <input type="search" wire:model.live.debounce.500ms="search" class="form-control"
                            wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch"
                            class="float-right form-control" placeholder="Search by ...">
                            <span class="input-group-text"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                            @if ($statusUpdate == true)
                            @include('livewire.backend.menuitem.menuitemedit')
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                            @if ($datamenuitem->count())
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
                                        <th scope="col" width="25%" class="text-center">Action
                                        </th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    @foreach ($datamenuitem as $no => $item)
                                    <tr
                                    class="@if ($this->isChecked($item->id)) table-primary @endif">
                                    <th class="text-right" scope="row">
                                        {{ $no + $datamenuitem->firstItem() }}</th>
                                        <td>
                                            {{ !empty($item->label) ? $item->label : '' }}</br>
                                            <small class="text-primary">
                                                <a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a>
                                            </small>
                                            {{-- @if ($item->typemenu == 1)
                                            <small class="text-primary">
                                                <a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a>
                                            </small>
                                            @elseif ($item->typemenu == 9)
                                            <small class="text-primary"><a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a></small>
                                            @else
                                            <small class="text-primary"><a target="_blank" href="{{ $item->linkid }}">{{ $item->linkid }}</a></small>
                                            @endif --}}
                                        </td>
                                        {{-- <td>
                                            @if ($item->paren > 0)
                                            {{ !empty($item->parent) ? $item->parent_menu->label:'' }}
                                            @else
                                            <span class="fw-bold">-</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            {{ !empty($item->menu) ? $item->parent_menu->name : '' }}
                                        </td>
                                        <td class="text-center align-midle">
                                            @if ($item->status == 1)
                                            <button
                                            wire:click="selectItem('{{ $item->id }}', 'inactive')"
                                            class="btn btn-xs btn-success"
                                            title="Change to InActive"><i
                                            class="fa fa-eye"></i></button>
                                            @else
                                            <button
                                            wire:click="selectItem('{{ $item->id }}', 'active')"
                                            class="btn btn-xs btn-default"
                                            title="Change to Active"><i
                                            class="fa fa-eye"></i></button>
                                            @endif
                                            <button
                                            wire:click="edit('{{ $item->id }}')"
                                            class="btn btn-xs btn-warning"
                                            title="Edit"><i
                                            class="fa fa-edit "></i></button>
                                            @can('menu.delete')
                                            <button
                                            wire:click="selectItem('{{ $item->id }}' , 'delete')"
                                            class="mx-1 my-1 btn btn-xs btn-danger"
                                            title="Delete"><i
                                            class="fa fa-trash "></i></button>
                                            @else
                                            <button title="Forbidden"
                                            class="btn btn-xs btn-danger " disabled><i
                                            class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-xl-12 col-md-12 col-lg-12 col-12 text-start small text-muted">
                                @if ($datamenuitem->total() > 10)
                                {{ $datamenuitem->links() }}
                                @else
                                Page : {{ $datamenuitem->currentPage() }} | Show {{ $datamenuitem->count() }} data
                                of {{ $datamenuitem->total() }}
                                @endif
                            </div>
                        </div>
                        @else
                        <h2 style="color: red" class="text-center">Menu Item not available
                        </h2>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>

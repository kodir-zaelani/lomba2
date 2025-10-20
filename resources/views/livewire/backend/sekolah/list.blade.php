<div>

    <div class="box-body">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                @if ($datasekolah->count())
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
                                <th>Action</th>
                            </tr>
                        </tbody>
                        <tbody>
                            @foreach ($datasekolah as $no =>  $item)
                            <tr>
                                <th class="text-right" scope="row">{{ $no + $datasekolah->firstItem() }}</th>
                                <td>
                                    {{ !empty($item->npsn) ? $item->npsn:'' }}
                                </td>
                                <td>
                                    {{ !empty($item->nama) ? $item->nama:'' }}
                                </td>
                                <td class="text-center align-midle">
                                    <button wire:click="edit('{{ $item->id }}')" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-edit "></i></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-3 row">
                    <div class="col-xl-12 col-md-12 col-lg-12 col-12 ">
                        @if ($datasekolah->total() > 10)
                        {{ $datasekolah->links() }}
                        @else
                        Page : {{ $datasekolah->currentPage() }} | Show {{ $datasekolah->count() }} data
                        of {{ $datasekolah->total() }}
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

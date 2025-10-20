<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">{{ $title}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span
                                class="path1"></span><span class="path2"></span></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Referensi</li>
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
                            <div class="mb-2 row">
                                <div class="mb-2 col-xl-2 col-lg-2 col-md-2 col-12">
                                    <select wire:model.live="paginate" name="" id="" class="w-auto form-control-sm custom-select">
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
                                            <input type="search" wire:model.live.debounce.500ms="search" class="form-control" wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" class="float-right form-control" placeholder="Search by ...">
                                            <span class="input-group-text"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                                    @if ($datajenisptk->count())
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
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                @foreach ($datajenisptk as $no =>  $item)
                                                <tr class="@if ($this->isChecked($item->agamaid))
                                                table-primary
                                                @endif">
                                                    <th class="text-right" scope="row">{{ $no + $datajenisptk->firstItem() }}</th>
                                                    <td>
                                                        {{ !empty($item->jenis_ptk) ? $item->jenis_ptk:'' }}<br/>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 row">
                                        <div class="col-xl-12 col-md-12 col-lg-12 col-12 ">
                                            @if ($datajenisptk->total() > 10)
                                            {{ $datajenisptk->links() }}
                                            @else
                                            Page : {{ $datajenisptk->currentPage() }} | Show {{ $datajenisptk->count() }} data
                                            of {{ $datajenisptk->total() }}
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

        </script>
        @endpush
    </div>

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
                                <li class="breadcrumb-item" aria-current="page">Wilayah </li>
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
                        <div class="box-body">
                            <div class="form-group @error('provinceCode') has-error @enderror">
                                <h5 >Provinsi <span class="text-danger">*</span></h5>
                                <select class="form-control select2" style="width: 100%;" wire:model.live="provinceCode" id="selcetprovince_code">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach ($dataprovinsi as $item)
                                    <option value="{{ $item->code }}" {{ old('province_code') == $item->code ? 'selected' : '' }}>
                                        {{ $item->code }} | {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('provinceCode')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group @error('cityCode') has-error @enderror">
                                <h5 >Kab./Kota <span class="text-danger">*</span></h5>
                                <select class="form-control select2" style="width: 100%;" wire:model.live="cityCode">
                                    <option value="" holder>Kab./Kota</option>
                                    @foreach ($datapcity as $city)
                                    <option value="{{ $city->code }}">
                                        {{ $city->code }} | {{ $city->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('cityCode')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group @error('districtCode') has-error @enderror">
                                <h5 >Kecamatan <span class="text-danger">*</span></h5>
                                <select class="form-control select2" style="width: 100%;" wire:model.live="districtCode">
                                    <option value="" holder>Kecamatan</option>
                                    @foreach ($datadistrict as $district)
                                    <option value="{{ $district->code }}">
                                        {{ $district->code }} |  {{ $district->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('districtCode')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group @error('villageCode') has-error @enderror">
                                <h5 >Desa/Kelurahan <span class="text-danger">*</span></h5>
                                <select class="form-control select2" style="width: 100%;" wire:model.live="villageCode">
                                    <option value="" holder>Desa/Kelurahan</option>
                                    @foreach ($datavillage as $village)
                                    <option value="{{ $village->code }}">
                                        {{ $village->code }} | {{ $village->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('villageCode')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

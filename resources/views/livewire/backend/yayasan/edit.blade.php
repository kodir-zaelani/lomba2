<div>
    <div class="box-header with-border">
        <h4 class="box-tile">Edit Data</h4>
        <div class="box-controls pull-right">
            <button class="btn btn-sm btn-info" wire:click='cancelEdit'>Batal</button>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="box ">
                    <div class="text-center box-body">
                        <div class="widget-user-image">
                            <img class="rounded-circle h-160" src="{{ $yayasan->logoyayasanThumbUrl ? $yayasan->logoyayasanThumbUrl : '/uploads/images/default/no_image.png' }}" alt="{{ $yayasan->nama }}">
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body box-profile box-bordered border-success">
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <p>Pimpinan :</p>
                                    <p><span class="text-gray">{{$yayasan->nama}}</span> </p>
                                    <p>No SK Pendidiran : </p>
                                    <p><span class="text-gray">{{$yayasan->no_pendirian_yayasan}}</span> </p>
                                    <p>Tanggal SK Pendirian : </p>
                                    <p><span class="text-gray">{{$yayasan->tgl_pendirian_yayasan}}</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-7 col-xl-8">
                <ul class="nav nav-tabs customtab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#umumedit" role="tab"><span class="hidden-sm-up">
                            <i class="ion-home"></i></span> <span class="hidden-xs-down">Umum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mapsview" role="tab"><span class="hidden-sm-up">
                            <i class="ion-email"></i></span> <span class="hidden-xs-down">Peta</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="umumedit" role="tabpanel">
                        <div class="pt-20 ps-5">
                            <div class="box box-bordered border-success">
                                <form enctype="multipart/form-data" >
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model="namaedit" class="form-control @error('namaedit') is-invalid @enderror" value="{{ old('namaedit') }}" placeholder="Nama Yayasan" required>
                                                    </div>
                                                    @error('namaedit')
                                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">No SK Pendirian <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model="no_pendirian_yayasanedit" class="form-control @error('no_pendirian_yayasanedit') is-invalid @enderror" value="{{ old('no_pendirian_yayasanedit') }}" placeholder="Nomor Sk Pendiriran" required>
                                                    </div>
                                                    @error('no_pendirian_yayasanedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Tanggal SK <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="date" wire:model="tgl_pendirian_yayasanedit" class="form-control @error('tgl_pendirian_yayasanedit') is-invalid @enderror" value="{{ old('tgl_pendirian_yayasanedit') }}" placeholder="Tanggal Pendirian" required>
                                                        <small class="text-danger"><code>Tangal/bulan/Tahun | 30/01/2025</code></small>
                                                    </div>
                                                    @error('tgl_pendirian_yayasanedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Website</label>
                                                    <div class="col-sm-9">
                                                        <input type="url" wire:model="websiteedit" class="form-control @error('websiteedit') is-invalid @enderror" value="{{ old('websiteedit') }}" placeholder=" website">
                                                        <small class="form-control-feedback"><code> www.namawebsite.com </code></small>
                                                    </div>
                                                    @error('websiteedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-email-input" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" wire:model="emailedit" class="form-control @error('emailedit') is-invalid @enderror" value="{{ old('emailedit') }}" placeholder=" emailedit">
                                                        <small class="form-control-feedback"><code> Email Aktif</code></small>
                                                    </div>
                                                    @error('emailedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-tel-input" class="col-sm-3 col-form-label">Tel./Fax</label>
                                                    <div class="col-sm-4">
                                                        <input type="number" wire:model="no_telpedit" class="form-control @error('no_telpedit') is-invalid @enderror" value="{{ old('no_telpedit') }}" placeholder=" No Telepon">
                                                        <small class="form-control-feedback"><code> Nomor Telepon/HP </code></small>
                                                    </div>
                                                    @error('no_telpedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                    <div class="col-sm-5">
                                                        <input type="number" wire:model="no_faxedit" class="form-control @error('no_faxedit') is-invalid @enderror" value="{{ old('no_faxedit') }}" placeholder="No Fax">
                                                        <small class="form-control-feedback"><code> Nomor Fax </code></small>
                                                    </div>
                                                    @error('no_faxedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-fax-input" class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <textarea rows="5" wire:model="alamatedit" class="form-control @error('alamatedit') is-invalid @enderror" placeholder="alamatedit">{{ old('alamatedit') }} </textarea>
                                                        <small class="form-control-feedback"><code> Alamat jalan </code></small>
                                                    </div>
                                                    @error('alamatedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-fax-input" class="col-sm-3 col-form-label">RT/RW</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" wire:model="rtedit" class="form-control @error('rtedit') is-invalid @enderror" value="{{ old('rtedit') }}" placeholder=" RT">
                                                        <small class="form-control-feedback"><code> RT 00000 </code></small>
                                                    </div>
                                                    @error('rtedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                    <div class="col-sm-5">
                                                        <input type="text" wire:model="rwedit" class="form-control @error('rwedit') is-invalid @enderror" value="{{ old('rwedit') }}" placeholder=" RW">
                                                        <small class="form-control-feedback"><code> RW 00000 </code></small>
                                                    </div>
                                                    @error('rwedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Nama Dusun</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model="nama_dusunedit" class="form-control @error('nama_dusunedit') is-invalid @enderror" value="{{ old('nama_dusunedit') }}" placeholder=" RT">
                                                    </div>
                                                    @error('nama_dusunedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Kode Pos</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model="kode_posedit" class="form-control @error('kode_posedit') is-invalid @enderror" value="{{ old('kode_posedit') }}" placeholder=" RT">
                                                    </div>
                                                    @error('kode_posedit')
                                                    <div class="form-control-feedback"><small>
                                                        <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Provinsi</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" value="{{$yayasan->province->name}}" id="example-dusun-input">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control select2" style="width: 100%;" wire:model.live="provinceCode" >
                                                            <option value="" holder>Pilih Provinsi</option>
                                                            @foreach ($dataprovinsi as $item)
                                                            <option value="{{ $item->code }}" {{ old('province_code') == $item->code ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('provinceCode')
                                                        <div class="form-control-feedback"><small>
                                                            <code>{{ $message }}</code> </small>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Kab./Kota</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" value="{{$yayasan->city->name}}" id="example-dusun-input">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control select2" style="width: 100%;" wire:model.live="cityCode">
                                                            <option value="" holder>Kab./Kota</option>
                                                            @foreach ($datapcity as $city)
                                                            <option value="{{ $city->code }}" {{ old('city_code') == $item->code ? 'selected' : ''}}>
                                                                {{ $city->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('cityCode')
                                                        <div class="form-control-feedback"><small>
                                                            <code>{{ $message }}</code> </small>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Kecamatan</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" value="{{$yayasan->district->name}}" id="example-dusun-input">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control select2" style="width: 100%;" wire:model.live="districtCode">
                                                            <option value="" holder>Kecamatan</option>
                                                            @foreach ($datadistrict as $district)
                                                            <option value="{{ $district->code }}">
                                                                {{ $district->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('districtCode')
                                                        <div class="form-control-feedback"><small>
                                                            <code>{{ $message }}</code> </small>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-dusun-input" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" value="{{$yayasan->village->name}}" id="example-dusun-input">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control select2" style="width: 100%;" wire:model.live="villageCode">
                                                            <option value="" holder>Desa/Kelurahan</option>
                                                            @foreach ($datavillage as $village)
                                                            <option value="{{ $village->code }}" >
                                                                {{ $village->name }}
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
                                        <div class="row">
                                            <div class="col">
                                                <p>
                                                    <small class="text-danger"><code>* Wajib diisi</code></small>
                                                </p>
                                                <button class="btn btn-sm btn-info me-2" wire:click='cancelEdit'>Batal</button>
                                                <button type="submit" class="btn btn-sm btn-success" wire:click.prevent="ubahdata('{{ $editId }}')"> Perbaharui</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mapsview" role="tabpanel">
                    <div class="p-15">
                        <div class="row">
                            <div class="box box-bordered border-success">
                                <form enctype="multipart/form-data" >
                                    <div class="box-header">
                                        <button class="btn btn-sm btn-info me-2" wire:click='cancelEdit'>Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success" wire:click.prevent="ubahpeta('{{ $editId }}')">Perbaharui</button>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Lintang</h5>
                                                    <div class="controls">
                                                        <input type="text" wire:model="lintangedit" class="form-control @error('lintangedit') is-invalid @enderror"  placeholder=" Lintang">
                                                    </div>

                                                    @error('lintangedit')
                                                    <div class="form-control-feedback">
                                                        <small> <code>{{ $message }}</code> </small>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Bujur</h5>
                                                    <div class="controls">
                                                        <input type="text" wire:model="bujuredit" class="form-control @error('bujuredit') is-invalid @enderror"  placeholder=" Bujur">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Maps Script</h5>
                                            <div class="controls">
                                                <textarea rows="5" name="maps_update" class="form-control @error('maps_update') is-invalid @enderror" placeholder="maps_update">{{ old('maps_update') }} </textarea>
                                            </div>
                                            <div class="form-control-feedback">
                                                <small>
                                                    Exp:
                                                    <code>
                                                        https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6519218789713!2d117.08926731409771!3d-0.5232837354157259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f93048b4a03%3A0x77d556abf72c93d0!2sPENERBIT%20BUKU%20MEDIATAMA%20CABANG%20SAMARINDA!5e0!3m2!1sen!2sid!4v1643782605913!5m2!1sen!2sid
                                                    </code>
                                                </small>
                                            </div>
                                            @error('maps_update')
                                            <div class="form-control-feedback">
                                                <small> <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Peta Saat Ini</h5>
                                            <div class="controls">
                                                <iframe src="{{$mapsedit}}" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="logoview" role="tabpanel">
                    <div class="p-15">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-bordered border-success">
                                    <form  enctype="multipart/form-data" action="{{ route('backend.yayasan.updatelogo', $yayasan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-center box-body ">
                                            <label class="form-label">Size : 600 pixel x 400 pixel</label>
                                            <div class="form-group">
                                                <div class=" fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                                        <img src="{{ asset('') }}assets/images/no_image.png" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;"></div>
                                                    <div>
                                                        <span class="btn btn-outline-secondary btn-file">
                                                            <span class="fileinput-new"> Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" class="@error('logo_yayasan') is-invalid @enderror" name="logo_yayasan" value="{{ old('logo_yayasan') }}">
                                                        </span>
                                                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                                @error('logo_yayasan')
                                                <div class="form-control-feedback">
                                                    <small> <code>{{ $message }}</code> </small>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center box-footer">
                                            <button type="submit" class="btn btn-sm btn-primary" >
                                                <i class="fa fa-save me-2" aria-hidden="true"></i> Ganti Logo
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

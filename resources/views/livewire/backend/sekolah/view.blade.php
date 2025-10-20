<div>
    <div class="box-header with-border">
        <h4 class="box-tile">Sekolah {{$sekolah->nama}}</h4>
        <div class="box-controls pull-right">
            <button wire:click="edit('{{ $sekolah->id }}')" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit "></i> Edit</button>
        </div>
    </div>
    <div class="box-body">
         <div class="row">
            <div class="col-12">
                <div class="box ">
                    <div class="text-center box-body">
                        <div class="widget-user-image">
                            <img class="h-160 rounded-circle" src="{{ $sekolah->logosekolahThumbUrl ? $sekolah->logosekolahThumbUrl : '/uploads/images/default/no_image.png' }}" alt="{{ $sekolah->nama }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="box box-bordered border-success">
                    <div class="box-body">
                        <form  enctype="multipart/form-data" action="{{ route('backend.sekolah.updatelogo', $sekolah->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="text-center box-body ">
                                <label class="form-label">Size : 600 pixel x 400 pixel | 1 MB</label>
                                <div class="form-group">
                                    <div class=" fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                            <img src="{{ $sekolah->logosekolahThumbUrl ? $sekolah->logosekolahThumbUrl : '/uploads/images/default/no_image.png' }}" alt="...">
                                            {{-- <img src="{{ asset('') }}assets/images/no_image.pncreate')g" alt="..."> --}}
                                        </div>
                                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;"></div>
                                        <div>
                                            <span class="btn btn-outline-secondary btn-file">
                                                <span class="fileinput-new"> Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="@error('logo_sekolah') is-invalid @enderror" name="logo_sekolah" value="{{ old('logo_sekolah') }}">
                                            </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    @error('logo_sekolah')
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
            <div class="col-12 col-lg-7 col-xl-8">
                <ul class="nav nav-tabs customtab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#infoiew" role="tab"><span class="hidden-sm-up">
                            <i class="ion-home"></i></span> <span class="hidden-xs-down">Info</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="tab" href="#umumview" role="tab"><span class="hidden-sm-up">
                            <i class="ion-home"></i></span> <span class="hidden-xs-down">Kontak</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mapsview" role="tab"><span class="hidden-sm-up">
                            <i class="ion-email"></i></span> <span class="hidden-xs-down">Maps</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="infoview" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="box box-bordered border-success">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row form-group">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Pimpinan </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{$sekolah->pimpinan}}</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Akta Pendirian</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{$sekolah->no_pendirian_sekolah}}</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Tanggal Akta</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ TanggalID('j M Y', $sekolah->tgl_pendirian_sekolah) }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="umumview" role="tabpanel">
                        <div class="pt-20 ps-5">
                            <div class="box box-bordered border-success">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row form-group">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Website</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->website}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Email</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->email}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Tel./Fax</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->no_telp}} / {{$sekolah->no_fax}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Alamat</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->alamat}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">RT/RW</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->rt}} / {{$sekolah->rw}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Nama Dusun</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->nama_dusun}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kode Pos</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$sekolah->kode_pos}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Provinsi</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{ !empty($sekolah->province_code) ? $sekolah->province->name:'' }}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kab./Kota</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{!empty($sekolah->city_code) ? $sekolah->city->name :''}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kecamatan</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{!empty($sekolah->district_code) ? $sekolah->district->name :''}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Desa/Kelurahan</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{!empty($sekolah->village_code) ? $sekolah->village->name :''}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="mapsview" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="box box-bordered border-success">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Lintang</h5>
                                                    <div class="controls">
                                                        <input type="text" name="lintang" class="form-control " value="{{ $sekolah->lintang }}" placeholder=" Lintang" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Bujur</h5>
                                                    <div class="controls">
                                                        <input type="text" name="bujur" class="form-control " value="{{ $sekolah->bujur }}" placeholder=" Bujur" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Maps</h5>
                                            <div class="controls">
                                                <iframe src="{{$sekolah->maps}}" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
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
    </div>
</div>

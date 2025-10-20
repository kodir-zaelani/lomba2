<div>
    <div class="box-header with-border">
        <h4 class="box-tile">Yayasan {{$yayasan->nama}}</h4>
        <div class="box-controls pull-right">
            <button wire:click="edit('{{ $yayasan->id }}')" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit "></i> Edit</button>
            <a href="{{route('backend.yayasan.export')}}" class="btn btn-sm btn-success me-3" title="Export"><i class="fa fa-file "></i> Export</a>
        </div>
    </div>
    <div class="box-body">
         <div class="row">
            <div class="col-12">
                <div class="box ">
                    <div class="text-center box-body">
                        <div class="widget-user-image">
                            <img class="rounded-circle h-160" src="{{ $yayasan->logoyayasanThumbUrl ? $yayasan->logoyayasanThumbUrl : '/uploads/images/default/no_image.png' }}" alt="{{ $yayasan->nama }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="box box-bordered border-success">
                    <div class="box-body">
                        <form  enctype="multipart/form-data" action="{{ route('backend.yayasan.updatelogo', $yayasan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="text-center box-body ">
                                <label class="form-label">Size : 600 pixel x 400 pixel | 1 MB</label>
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
                                                        <label class="col-form-label">: {{$yayasan->pimpinan}}</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Akta Pendirian</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{$yayasan->no_pendirian_yayasan}}</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Tanggal Akta</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ TanggalID('j M Y', $yayasan->tgl_pendirian_yayasan) }}</label>
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
                                                    <label class="col-form-label">: {{$yayasan->website}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Email</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->email}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Tel./Fax</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->no_telp}} / {{$yayasan->no_fax}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Alamat</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->alamat}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">RT/RW</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->rt}} / {{$yayasan->rw}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Nama Dusun</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->nama_dusun}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kode Pos</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->kode_pos}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Provinsi</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->province->name}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kab./Kota</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->city->name}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Kecamatan</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->district->name}}</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Desa/Kelurahan</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label class="col-form-label">: {{$yayasan->village->name}}</label>
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
                                                        <input type="text" name="lintang" class="form-control " value="{{ $yayasan->lintang }}" placeholder=" Lintang" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Bujur</h5>
                                                    <div class="controls">
                                                        <input type="text" name="bujur" class="form-control " value="{{ $yayasan->bujur }}" placeholder=" Bujur" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Maps</h5>
                                            <div class="controls">
                                                <iframe src="{{$yayasan->maps}}" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
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

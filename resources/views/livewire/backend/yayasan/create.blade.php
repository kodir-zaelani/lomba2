<div>
    <div class="box-header with-border">
        <h4 class="box-tile">Tambah data</h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-12">
               <div class="box box-bordered border-success">
                <div class="box-body">
                     <form action="{{ route('backend.yayasan.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="importfile" class="form-control @error('importfile') is-invalid @enderror" required>
                    @error('importfile')
                    <div class="form-control-feedback">
                        <small> <code>{{ $message }}</code> </small>
                    </div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-sm">Import</button>
                </form>
                <div class="py-20">
                    Silahkan untuh Template  file spreadsheet terlebih dahulu <a class="btn btn-info btn-sm ms-3" href="{{asset('')}}uploads/files/templates/1_template_yayasan.xlsx" >Template</a>
                </div>
                </div>
               </div>
            </div>
        </div>
        <ul class="nav nav-tabs customtab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home7" role="tab"><span class="hidden-sm-up">
                    <i class="ion-home"></i></span> <span class="hidden-xs-down">Umum & Kontak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#maps7" role="tab"><span class="hidden-sm-up">
                    <i class="ion-email"></i></span> <span class="hidden-xs-down">Maps</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="home7" role="tabpanel">
                <div class="p-15">
                    <div class="box">
                        <form enctype="multipart/form-data" >
                            <div class="box-body">
                                <div class="form-group">
                                    <h5>Nama Yayasan <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Yayasan" required>
                                    </div>
                                    @error('nama')
                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>Nomor SK Pendirian <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="url" wire:model="no_pendirian_yayasan" class="form-control @error('no_pendirian_yayasan') is-invalid @enderror" value="{{ old('no_pendirian_yayasan') }}" placeholder="Nomor Sk Pendiriran" required>
                                    </div>
                                    @error('no_pendirian_yayasan')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>Tanggal Pendirian <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" wire:model="tgl_pendirian_yayasan" class="form-control @error('tgl_pendirian_yayasan') is-invalid @enderror" value="{{ old('tgl_pendirian_yayasan') }}" placeholder="Tanggal Pendirian" required>
                                    </div>
                                    <div class="form-control-feedback">
                                        <small><code>Tangal/bulan/Tahun | 30/01/2000</code></small>
                                    </div>
                                    @error('tgl_pendirian_yayasan')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>Website </h5>
                                    <div class="controls">
                                        <input type="url" wire:model="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}" placeholder=" website">
                                    </div>
                                    <div class="form-control-feedback">
                                        <small><code> Alamat Website </code></small>
                                    </div>
                                    @error('website')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>Email </h5>
                                    <div class="controls">
                                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder=" email">
                                    </div>
                                    <div class="form-control-feedback">
                                        <small><code> Email </code></small>
                                    </div>
                                    @error('email')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <h5>Nomor Telepon </h5>
                                            <div class="controls">
                                                <input type="number" wire:model="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" placeholder=" No Telepon">
                                            </div>
                                            <div class="form-control-feedback">
                                                <small><code> Nomor Telepon/HP </code></small>
                                            </div>
                                            @error('no_telp')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <h5>Nomor Fax </h5>
                                            <div class="controls">
                                                <input type="number" wire:model="no_fax" class="form-control @error('no_fax') is-invalid @enderror" value="{{ old('no_fax') }}" placeholder="No Fax">
                                            </div>
                                            @error('no_fax')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Alamat Jalan </h5>
                                    <div class="controls">
                                        <textarea rows="5" wire:model="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat">{{ old('alamat') }} </textarea>
                                    </div>
                                    <div class="form-control-feedback">
                                        <small><code> Alamat jalan </code></small>
                                    </div>
                                    @error('alamat')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h5>RT</h5>
                                            <div class="controls">
                                                <input type="text" wire:model="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}" placeholder=" RT">
                                            </div>
                                            <div class="form-control-feedback">
                                                <small><code> RT 00000 </code></small>
                                            </div>
                                            @error('rt')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h5>RW</h5>
                                            <div class="controls">
                                                <input type="text" wire:model="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw') }}" placeholder=" RW">
                                            </div>
                                            <div class="form-control-feedback">
                                                <small><code> RW 00000 </code></small>
                                            </div>
                                            @error('rw')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <h5>Nama Dusun</h5>
                                            <div class="controls">
                                                <input type="text" wire:model="nama_dusun" class="form-control @error('nama_dusun') is-invalid @enderror" value="{{ old('nama_dusun') }}" placeholder=" Nama Dusun">
                                            </div>
                                            <div class="form-control-feedback">
                                                <small><code> Nama Dusun </code></small>
                                            </div>
                                            @error('nama_dusun')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <h5>Kode Pos</h5>
                                            <div class="controls">
                                                <input type="text" wire:model="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" value="{{ old('kode_pos') }}" placeholder=" Kode Pos">
                                            </div>
                                            <div class="form-control-feedback">
                                                <small><code> Kode Pos </code></small>
                                            </div>
                                            @error('kode_pos')
                                            <div class="form-control-feedback"><small>
                                                <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group @error('provinceCode') has-error @enderror">
                                            <h5 >Provinsi <span class="text-danger">*</span></h5>
                                            <select class="form-control select2" style="width: 100%;" wire:model.live="provinceCode" id="selcetprovince_code">
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
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group @error('cityCode') has-error @enderror">
                                            <h5 >Kab./Kota <span class="text-danger">*</span></h5>
                                            <select class="form-control select2" style="width: 100%;" wire:model.live="cityCode">
                                                <option value="" holder>Kab./Kota</option>
                                                @foreach ($datapcity as $city)
                                                <option value="{{ $city->code }}">
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
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group @error('districtCode') has-error @enderror">
                                            <h5 >Kecamatan <span class="text-danger">*</span></h5>
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
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group @error('villageCode') has-error @enderror">
                                            <h5 >Desa/Kelurahan <span class="text-danger">*</span></h5>
                                            <select class="form-control select2" style="width: 100%;" wire:model.live="villageCode">
                                                <option value="" holder>Desa/Kelurahan</option>
                                                @foreach ($datavillage as $village)
                                                <option value="{{ $village->code }}">
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
                            <div class="box-footer">
                                <input type="text" name="status_yayasan_update" value="1" hidden>
                                <button class="btn btn-sm btn-primary"  wire:click.prevent="store">
                                    <i class="fa fa-save me-2" aria-hidden="true"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="maps7" role="tabpanel">
                <div class="p-15">
                    <div class="row">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h5>Lintang</h5>
                                            <div class="controls">
                                                <input type="text" wire:model="lintang" class="form-control @error('lintang') is-invalid @enderror" value="{{ old('lintang') }}" placeholder=" Lintang">
                                            </div>

                                            @error('lintang')
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
                                                <input type="text" wire:model="bujur" class="form-control @error('bujur') is-invalid @enderror" value="{{ old('bujur') }}" placeholder=" Bujur">
                                            </div>

                                            @error('bujur')
                                            <div class="form-control-feedback">
                                                <small> <code>{{ $message }}</code> </small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Maps Script</h5>
                                    <div class="controls">
                                        <textarea rows="5" name="maps" class="form-control @error('maps') is-invalid @enderror" placeholder="maps">{{ old('maps') }} </textarea>
                                    </div>
                                    <div class="form-control-feedback">
                                        <small>
                                            Exp:
                                            <code>
                                                https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6519218789713!2d117.08926731409771!3d-0.5232837354157259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f93048b4a03%3A0x77d556abf72c93d0!2sPENERBIT%20BUKU%20MEDIATAMA%20CABANG%20SAMARINDA!5e0!3m2!1sen!2sid!4v1643782605913!5m2!1sen!2sid
                                            </code>
                                        </small>
                                    </div>
                                    @error('maps')
                                    <div class="form-control-feedback">
                                        <small> <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalImportLabel">Import Data Yayasan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('backend.yayasan.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="importfile" class="form-control @error('importfile') is-invalid @enderror" required>
                        @error('importfile')
                        <div class="form-control-feedback">
                            <small> <code>{{ $message }}</code> </small>
                        </div>
                        @enderror
                        <button type="submit" class="mt-3 btn btn-primary btn-sm">Import</button>
                    </form>
                    <div class="py-20">
                        Silahkan untuh Template  file spreadsheet terlebih dahulu <a class="btn btn-info btn-sm ms-3" href="{{asset('')}}uploads/files/templates/1_template_yayasan.xlsx" >Template</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="box-header with-border">
        <h4 class="box-tile">Edit data</h4>
    </div>
    <div class="box-body">
        <form enctype="multipart/form-data" >
            <div class="box-body">
                 <div class="form-group @error('tahunajaran_id') has-error @enderror">
                    <h5 >Tahun Ajaran <span class="text-danger">*</span></h5>
                    <select class="form-control select2" style="width: 100%;" wire:model.live="tahunajaran_id" id="selcetprovince_code">
                        <option value="" holder>Pilih Provinsi</option>
                        @foreach ($dataptahunajaran as $item)
                        <option value="{{ $item->id }}" {{ old('id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('tahunajaran_id')
                    <div class="form-control-feedback"><small>
                        <code>{{ $message }}</code> </small>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>Nama Tagihan <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder=" Nama Tagihan">
                    </div>
                    @error('nama')
                    <div class="form-control-feedback"><small>
                        <code>{{ $message }}</code> </small>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Periodik :</label>
                    <div class="demo-radio-button">
                        <input value="1" wire:model="periodik"
                        type="radio" id="radio_30" class="with-gap radio-col-success" />
                        <label for="radio_30">Ya</label>
                        <input value="0" wire:model="periodik"
                        type="radio" id="radio_32" class="with-gap radio-col-success" checked />
                        <label for="radio_32">Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Type Periodik :</label>
                    <div class="demo-radio-button">
                        <input value="bulan" wire:model="jenis_periodik"
                        type="radio" id="radio_33" class="with-gap radio-col-success" />
                        <label for="radio_33">Bulan</label>
                        <input value="tahun_ajaran" wire:model="jenis_periodik"
                        type="radio" id="radio_34" class="with-gap radio-col-success" checked />
                        <label for="radio_34">Tahun Masuk</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Perlu Tagihan :</label>
                    <div class="demo-radio-button">
                        <input value="1" wire:model="perlu_tagihan"
                        type="radio" id="radio_30perlu_tagihan" class="with-gap radio-col-success" />
                        <label for="radio_30perlu_tagihan">Ya</label>
                        <input value="0" wire:model="perlu_tagihan"
                        type="radio" id="radio_32perlu_tagihan" class="with-gap radio-col-success" checked />
                        <label for="radio_32perlu_tagihan">Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <h5>Besaran<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="number" wire:model="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Sekolah" required>
                    </div>
                    @error('nama')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>Tanggal Berlaku <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="date" wire:model="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" placeholder="Tanggal Berlaku" required>
                    </div>
                    <div class="form-control-feedback">
                        <small><code>Tangal/bulan/Tahun | 30/01/2000</code></small>
                    </div>
                    @error('tanggal_mulai')
                    <div class="form-control-feedback"><small>
                        <code>{{ $message }}</code> </small>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>Tanggal Berakhir <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="date" wire:model="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" placeholder="Tanggal Berlaku" required>
                    </div>
                    <div class="form-control-feedback">
                        <small><code>Tangal/bulan/Tahun | 30/01/2000</code></small>
                    </div>
                    @error('tanggal_selesai')
                    <div class="form-control-feedback"><small>
                        <code>{{ $message }}</code> </small>
                    </div>
                    @enderror
                </div>

            </div>
            <div class="box-footer">
                <input type="text" name="status_sekolah_update" value="1" hidden>
                <button class="btn btn-sm btn-primary"  wire:click.prevent="store">
                    <i class="fa fa-save me-2" aria-hidden="true"></i> Save
                </button>
            </div>
        </form>
    </div>

</div>

@extends('layouts.appb')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">{{$title}}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span
                            class="path1"></span><span class="path2"></span></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                href="{{ route('backend.binaan.index') }}">Pendampingan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Detail Pendampingan
                            </h4>
                            <div class="box-controls pull-right">
                                <a class="btn btn-sm btn-primary" href="{{ route('backend.binaan.index') }}">
                                     Kembali
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group @error('sekolah_id') has-error @enderror">
                                        <h5 >Satuan Pendidikan <span class="text-danger">*</span></h5>
                                        <select class="form-control select2" style="width: 100%;" name="sekolah_id" disabled>
                                            <option value="" holder>Satuan Pendidikan</option>
                                            @foreach ($sekolah as $item)
                                            <option value="{{ $item->id }}" {{ old('sekolah_id') == $item->id ? 'selected' : '' }}
                                                @if ($item->id == $spbinaan->sekolah_id) selected @endif>
                                                {{ $item->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('sekolah_id')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group @error('jenjangpendidikan_id') has-error @enderror">
                                        <h5 >Jenjang Pendidikan <span class="text-danger">*</span></h5>
                                        <select class="form-control select2" style="width: 100%;" name="jenjangpendidikan_id" disabled>
                                            <option value="" holder>Jenjang Pendidikan</option>
                                            @foreach ($datajenjangpendidikan as $item)
                                            <option value="{{ $item->id }}" {{ old('jenjangpendidikan_id') == $item->id ? 'selected' : '' }}
                                                @if ($item->id == $spbinaan->jenjangpendidikan_id) selected @endif>
                                                {{ $item->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('jenjangpendidikan_id')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group @error('dukungan_id') has-error @enderror">
                                        <h5 >Prioritas Dukungan <span class="text-danger">*</span></h5>
                                        <select class="form-control select2" style="width: 100%;" name="dukungan_id" disabled>
                                            <option value="" holder>Pilih  Prioritas</option>
                                            @foreach ($dukungan as $item)
                                            <option value="{{ $item->id }}" {{ old('dukungan_id') == $item->id ? 'selected' : '' }}
                                                @if ($item->id == $spbinaan->dukungan_id) selected @endif>
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('dukungan_id')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <div class="form-group">
                                        <h5>Strategi Pendampingan <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="strategi"
                                            class="form-control @error('strategi') is-invalid @enderror"
                                            value="{{ old('strategi') ?? $spbinaan->strategi}}" placeholder="Title" readonly>
                                        </div>
                                        @error('strategi')
                                        <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Lingkup Pembahasan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="lingkup_pembahasan"
                                    class="form-control @error('lingkup_pembahasan') is-invalid @enderror"
                                    value="{{ old('lingkup_pembahasan') ?? $spbinaan->lingkup_pembahasan}}" placeholder="Title" readonly>
                                </div>
                                @error('lingkup_pembahasan')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Program kerja satpen /praktik baik <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('program_kerja') is-invalid @enderror"
                                name="program_kerja" readonly>{{ old('program_kerja') ?? $spbinaan->program_kerja}}</textarea>
                                @error('program_kerja')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kelebihan <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('kelebihan') is-invalid @enderror"
                                name="kelebihan" readonly>{{ old('kelebihan') ?? $spbinaan->kelebihan}}</textarea>
                                @error('kelebihan')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kondisi Real <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('kondisi_real') is-invalid @enderror"
                                name="kondisi_real">{{ old('kondisi_real') ?? $spbinaan->kondisi_real}}</textarea>
                                @error('kondisi_real')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Strategi – umpan balik <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('umpan_balik') is-invalid @enderror"
                                name="umpan_balik" readonly>{{ old('umpan_balik') ?? $spbinaan->umpan_balik}}</textarea>
                                @error('umpan_balik')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Perubahan <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('perubahan') is-invalid @enderror"
                                name="perubahan" readonly>{{ old('perubahan') ?? $spbinaan->perubahan}}</textarea>
                                @error('perubahan')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Rencana perbaikan / tindak lanjut <span class="text-danger">*</span></label>
                                <textarea  rows="10" cols="80" class="form-control @error('rencana_perbaikan') is-invalid @enderror"
                                name="rencana_perbaikan" readonly>{{ old('rencana_perbaikan') ?? $spbinaan->rencana_perbaikan}}</textarea>
                                @error('rencana_perbaikan')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        @push('styles')
        <!-- Jasny Bootstrap 4 -->
        <link rel="stylesheet"
        href="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
        @endpush

        @push('scripts')
        <script src="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
        <script src="{{ asset('') }}assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="{{ asset('') }}assets/vendor_components/select2/dist/js/select2.full.js"></script>
        <script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
        <script src="{{ asset('') }}assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
        {{-- <script src="{{ asset('') }}assets/backend/js/dukungans/editor.js"></script> --}}
        <script>
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
        </script>
        <script>
            CKEDITOR.replace('editor1', options);
            //Initialize Select2 Elements
            $('.select2').select2();
            //Save Draft
            $('#draft-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(0);
                $('#post-form').submit();
            });
            //Save Publish
            $('#publish-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(1);
                $('#post-form').submit();
            });

        </script>
        @endpush
        @endsection

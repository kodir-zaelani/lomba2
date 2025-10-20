@extends('layouts.appb')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">{{$title}}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('backend.pegawai.index') }}">PTK</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit a pegawai</li>
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
                    <h4 class="box-title">@yield('title')</h4>
                </div>
                <div class="box-body">
                    <form id="post-form" enctype="multipart/form-data"
                    action="{{ route('backend.pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-8 col-md-8 col-lg-8 col-12">
                            <div class="form-group">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input name="name" type="text" required
                                value="{{ old('name') ?? $pegawai->name }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter a Your full name">
                                @error('name')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input name="email" type="email" required
                                value="{{ old('email') ?? $pegawai->email }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter a pegawai email">
                                @error('email')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group @error('jenispegawai_id') has-error @enderror">
                                <label class="form-label">Jenis PTK <span class="text-danger">*</span></label>
                                <select class="form-control select" style="width: 100%;" name="jenispegawai_id">
                                    <option value="" holder>Select Jenis PTK</option>
                                    @foreach ($jenispegawais as $item)
                                    <option value="{{ $item->id }}" {{ old('jenispegawai_id') == $item->id ? 'selected' : '' }} @if ($item->id == $pegawai->jenispegawai_id) selected @endif>
                                        {{ $item->jenis_pegawai }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jenispegawai_id')
                                <span class="help-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input name="jabatan" type="text" value="{{ old('jabatan') ?? $pegawai->jabatan }}" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Enter a jabatan">
                                @error('jabatan')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>

                            @if ($pegawai->masterstatus == config('cms.default_masterpegawai'))
                            <div class="form-group">
                                <label class="form-label">Status : {!! $pegawai->statustext !!}</label>
                                <input type="text" name="status" value="1" hidden>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="form-label">Status :</label>
                                <div class="demo-radio-button">
                                    <input {{ $pegawai->status == 1 ? 'checked' : '' }} value="1" name="status" type="radio" id="radio_30" class="with-gap radio-col-success" checked />
                                    <label for="radio_30">Active</label>
                                    <input {{ $pegawai->status == 0 ? 'checked' : '' }} value="0" name="status" type="radio" id="radio_32" class="with-gap radio-col-success" />
                                    <label for="radio_32">Inactive</label>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-xl-4 col-md-4 col-lg-4 col-12">
                            <div class="box">
                                <div class="text-center box-body ">
                                    <h4 class="box-title">
                                        Foto
                                    </h4>
                                    <div class="form-group">
                                        <div class=" fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                                <img src="{{ $pegawai->imageThumbUrl ? $pegawai->imageThumbUrl : '/assets/images/no_image.png' }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists img-thumbnail"
                                            style="max-width: 200px;"></div>
                                            <div>
                                                <span class="btn btn-outline-secondary btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" class="@error('image') is-invalid @enderror"
                                                    name="image" value="{{ old('image') }}"></span>
                                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">
                                                        Remove
                                                    </a>
                                                </div>
                                            </div>
                                            @error('image')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('backend.pegawai.index') }}" class="btn btn-warning me-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('styles')
<link rel="stylesheet"
href="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
@endpush

@push('scripts')
<script src="{{ asset('') }}assets/vendor_plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ asset('') }}assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
    };
</script>
<script>
    $(function() {
        "use strict";
        // instance, using default configuration.
        CKEDITOR.replace('editor1', options);
        // CKEDITOR.replace('editor1');

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
    });
</script>

@endpush


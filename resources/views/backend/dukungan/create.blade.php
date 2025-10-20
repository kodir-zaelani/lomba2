@extends('layouts.appb')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="greeting-title">{{$title}}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span
                                            class="path1"></span><span class="path2"></span></i></a></li>
                            <li class="breadcrumb-item" aria-current="greeting"><a
                                    href="{{ route('backend.dukungan.index') }}">Dukungans</a></li>
                            <li class="breadcrumb-item active" aria-current="greeting">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <section class="content">
        <form  enctype="multipart/form-data" action="{{ route('backend.dukungan.store') }}" method="post">
            <div class="row">
                @csrf
                <div class="col-lg-8 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Create a Dukungan
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <h5>Title <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" placeholder="Title" required>
                                </div>
                                @error('title')
                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea id="editor1" rows="10" cols="80" class="form-control @error('content') is-invalid @enderror"
                                    name="content">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Update
                                <small>Publish or Draft</small>
                            </h4>
                        </div>
                        <div class="box-body">
                             <input type="text" name="status" id="status" hidden>
                            <button id="draft-btn" type="submit" class="btn btn-warning me-1">
                                Draft
                            </button>
                            <button  type="submit"class="btn btn-primary">
                                Publish
                            </button>
                        </div>

                    </div>

                </div>
            </div>
            </div>
        </form>
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
        {{-- <script src="{{ asset('') }}assets/backend/js/editorials/editor.js"></script> --}}
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

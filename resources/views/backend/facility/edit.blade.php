@extends('layouts.appb')
@section('title', $title)

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">@yield('title')</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span
                            class="path1"></span><span class="path2"></span></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                href="{{ route('backend.facility.index') }}">All Facility</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit a facility</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <form id="post-form" enctype="multipart/form-data" action="{{ route('backend.facility.update', $facility) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Edit a Facility
                                {{-- <small>Advanced and full of features</small> --}}
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <h5>Title <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') ?? $facility->title }}" placeholder="Title" required>
                                </div>
                                @error('title')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                           <div class="form-group @error('class') has-error @enderror">
                                    <label class="form-label">Class <span class="text-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="class">
                                        <option value="" holder>Select Class</option>
                                        <option value="primary" {{ old('class') == "primary" ? 'selected' : '' }}  @if ($facility->class == "primary") selected @endif><span class="text-blue">Primary</span> </option>
                                        <option value="success" {{ old('class') == "success" ? 'selected' : '' }} @if ($facility->class == "success") selected @endif><span class="text-green">Success</span> </option>
                                        <option value="warning" {{ old('class') == "warning" ? 'selected' : '' }} @if ($facility->class == "warning") selected @endif><span class="text-ornage">Warning</span> </option>
                                        <option value="info" {{ old('class') == "info" ? 'selected' : '' }} @if ($facility->class == "info") selected @endif><span class="text-info">Info</span> </option>
                                        <option value="danger" {{ old('class') == "danger" ? 'selected' : '' }} @if ($facility->class == "danger") selected @endif><span class="text-red">Danger</span> </option>
                                    </select>
                                    @error('class')
                                    <span class="help-block"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            <div class="form-group">
                                <h5>Icon </h5>
                                <div class="input-group ">
                                    <div class="input-group-addon">
                                        <i class="{{$facility->icon}}"></i>
                                    </div>
                                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{old('icon') ?? $facility->icon}}" placeholder="Icon" required autofocus>
                                </div>
                                <small>
                                    example: bi bi-bus-front |
                                    <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-bootstrap"></i> Select Icon Bootsrap
                                    </a>
                                </small>
                                @error('icon')
                                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea id="editor1" rows="10" cols="80" class="form-control @error('content') is-invalid @enderror"
                                name="content">{{ old('content') ?? $facility->content }}</textarea>
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
                            <h4 class="box-title">Save
                                <small>Publish or Draft</small>
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <label for="status">
                                    Status :
                                    @if ($facility->status == 1)
                                    <font style="color: rgb(18, 168, 13)">Publish</font>
                                    @else
                                    <font style="color: rgb(58, 40, 224)"> Draft</font>
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="box-footer text-end">
                            <input type="text" name="status" id="status" hidden>
                            <button id="draft-btn" type="submit" class="btn btn-warning me-1">
                                Draft
                            </button>
                            <button id="publish-btn" type="submit"class="btn btn-primary">
                                Publish
                            </button>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Fitur Image
                            </h4>
                        </div>
                        <div class="text-center box-body ">
                            <div class="form-group">
                                <div class=" fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                        <img src="{{ $facility->imageThumbUrl ? $facility->imageThumbUrl : '/assets/images/no_image.png' }}"
                                        alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;">
                                    </div>
                                    <div>
                                        <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span>
                                            <input type="file" class="@error('image') is-invalid @enderror"
                                            name="image" value="{{ old('image') }}"></span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                            data-dismiss="fileinput">Remove</a>
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
        <script>
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
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

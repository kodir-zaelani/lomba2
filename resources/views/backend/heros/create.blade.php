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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('backend.heros.index') }}">Heros</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create a hero</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <form id="post-form" enctype="multipart/form-data" action="{{ route('backend.heros.store') }}" method="post">
        <div class="row">
            @csrf
            <div class="col-lg-8 col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">
                            Create a Hero
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
                            <h5>Total Student </h5>
                            <div class="controls">
                                <input type="number" name="student"
                                class="form-control @error('student') is-invalid @enderror"
                                value="{{ old('student') }}" placeholder="Total Teacher" >
                            </div>
                            @error('student')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Total Teacher </h5>
                            <div class="controls">
                                <input type="number" name="teacher"
                                class="form-control @error('teacher') is-invalid @enderror"
                                value="{{ old('teacher') }}" placeholder="Total Teacher" >
                            </div>
                            @error('teacher')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Total Staff </h5>
                            <div class="controls">
                                <input type="number" name="administration"
                                class="form-control @error('administration') is-invalid @enderror"
                                value="{{ old('administration') }}" placeholder="Total Administrative Staff" >
                            </div>
                            @error('administration')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Student - Teahcer Ratio</h5>
                            <div class="controls">
                                <input type="text" name="ratio"
                                class="form-control @error('ratio') is-invalid @enderror"
                                value="{{ old('ratio') }}" placeholder="Student - Teahcer Ratio" >
                            </div>
                            @error('ratio')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>

                        <div class="form-group @error('link_hero') has-error @enderror">
                                <label class="form-label">Link Page </label>
                                <select class="form-control select2" style="width: 100%;" name="link_hero">
                                    <option value="" holder>Select Post Category</option>
                                    @foreach ($pages as $item)
                                        <option value="{{ $item->slug }}"
                                            {{ old('link_hero') == $item->slug ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('link_hero')
                                    <span class="help-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        <div class="row">
                            <div class="col-md-5 col-12">
                                <div class="form-group">
                                    <h5>Label Button </h5>
                                    <div class="controls">
                                        <input type="text" name="title_btn_link"
                                        class="form-control @error('title_btn_link') is-invalid @enderror"
                                        value="{{ old('title_btn_link') }}"
                                        placeholder="Label Button" >
                                    </div>
                                    @error('title_btn_link')
                                    <div class="form-control-feedback"><small>
                                        <code>{{ $message }}</code> </small>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="form-group">
                                    <h5> Icon Button</h5>
                                    <div class="controls">
                                        <input type="text" name="icon_link"
                                        class="form-control @error('icon_link') is-invalid @enderror"
                                        value="{{ old('icon_link') }}"
                                        placeholder="Icon">
                                        <small><a
                                            href="https://icons.getbootstrap.com/"
                                            target="_blank"
                                            rel="noopener noreferrer"><i
                                            class="bi bi-bootstrap"></i> Select
                                            Icon
                                            Bootsrap</a></small>
                                        </div>
                                        @error('icon_link')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Target View:</label>
                                <div class="demo-radio-button">
                                    <input value="_self" name="target_link_hero"
                                    type="radio" id="radio_20"
                                    class="with-gap radio-col-success" />
                                    <label for="radio_20">Self</label>
                                    <input value="_blank" name="target_link_hero"
                                    type="radio" id="radio_21"
                                    class="with-gap radio-col-success" />
                                    <label for="radio_21">Blank</label>
                                </div>
                                @error('target_link_hero')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="video_hero">Video Youtube</label>
                                <input id="video_hero" name="video_hero"
                                type="text"
                                class="form-control @error('video_hero') is-invalid @enderror"
                                placeholder="Video"
                                value="{{ old('video_hero') }}">
                                <span class="font-italic"> Example:  https://www.youtube.com/watch?v=LJ_YrtyEnck</span>
                                @error('video_hero')
                                <div class="form-control-feedback"><small>
                                    <code>{{ $message }}</code> </small>
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <h5>Label Button Video </h5>
                                        <div class="controls">
                                            <input type="text" name="title_btn_video"
                                            class="form-control @error('title_btn_video') is-invalid @enderror"
                                            value="{{ old('title_btn_video') }}"
                                            placeholder="Label Button Video" required>
                                        </div>
                                        @error('title_btn_video')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="form-group">
                                        <h5>Icon Link Button Video</h5>
                                        <div class="controls">
                                            <input type="text" name="icon_btn_video" class="form-control @error('icon_btn_video') is-invalid @enderror" value="{{ old('icon_btn_video') }}" placeholder="Icon">
                                            <small>
                                                <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">
                                                    <i class="bi bi-bootstrap"></i>
                                                    Select  Icon Bootsrap
                                                </a>
                                            </small>
                                        </div>
                                        @error('icon_btn_video')
                                        <div class="form-control-feedback"><small>
                                            <code>{{ $message }}</code> </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea id="editor1" rows="80" cols="80" class="form-control @error('description') is-invalid @enderror"
                                name="description">{{ old('description') }}</textarea>
                                @error('description')
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
                        <div class="box-footer text-end">
                            <input type="text" name="status" id="status" hidden>
                            <button id="draft-btn" type="submit" class="btn btn-warning me-1">
                                Draft
                            </button>
                            <button id="publish-btn" type="submit" class="btn btn-primary"  @if (auth()->user()->can('postsubcribe.create')) hidden @endif>
                                Publish
                            </button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Image Hero
                            </h4>
                        </div>
                        <div class="text-center box-body ">
                            <div class="form-group">
                                <div class=" fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                        <img src="{{ asset('/assets/images/no_image.png') }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px;"></div>
                                    <div>
                                        <span class="btn btn-outline-secondary btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" class="@error('imagehero') is-invalid @enderror"
                                            name="imagehero" value="{{ old('imagehero') }}"></span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                    @error('imagehero')
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
        @endsection

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
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('backend.posts.index') }}">
                                    Posts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create a post</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <section class="content">
        <form id="post-form" enctype="multipart/form-data" action="{{ route('backend.posts.store') }}" method="post">
            <div class="row">
                @csrf
                <div class="col-lg-8 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Create a Post
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
                                <label class="form-label">Headline :</label>
                                <div class="demo-radio-button">
                                    <input value="0" name="headline" type="radio" id="radio_32"
                                        class="with-gap radio-col-success" checked  />
                                    <label for="radio_32">Inactive</label>
                                    <input value="1" name="headline" type="radio" id="radio_30"
                                        class="with-gap radio-col-success" />
                                    <label for="radio_30">Active</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Primary / Selection :</label>
                                <div class="demo-radio-button">
                                    <input value="0" name="selection" type="radio" id="radio_33"
                                        class="with-gap radio-col-primary" checked  />
                                    <label for="radio_33">Primary</label>
                                    <input value="1" name="selection" type="radio" id="radio_34"
                                        class="with-gap radio-col-primary" />
                                    <label for="radio_34">Selection</label>
                                </div>
                            </div>
                            <div class="form-group row" hidden>
                                <label class="form-label">News/Blog:</label>
                                <div class="c-inputs-stacked ">
                                    <input value="0" name="statuspost" type="radio" id="radio_41"
                                        class="with-gap radio-col-primary" checked />
                                    <label for="radio_41">News</label>
                                    <input value="1" name="statuspost" type="radio" id="radio_40"
                                        class="with-gap radio-col-primary" />
                                    <label for="radio_40">Blog</label>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="video">Video</label>
                                <input id="video" name="video" type="text"
                                    class="form-control @error('video') is-invalid @enderror" placeholder="Video"
                                    value="{{ old('video') }}">
                                <span class="font-italic"> Example ID Video on Youtube: DfMz1NMIVe4</span>
                                @error('video')
                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="caption_video">Caption Video</label>
                                <textarea name="caption_video" id="caption_video" class="form-control  @error('caption_video') is-invalid @enderror"
                                    placeholder="Caption Video">{{ old('caption_video') }}</textarea>
                                @error('caption_video')
                                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea id="editor1" rows="80" cols="80" class="form-control @error('content') is-invalid @enderror"
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
                            <h4 class="box-title">Save
                                <small>Publish or Draft</small>
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group row" hidden>
                            <label class="form-label">Comments :</label>
                            <div class="c-inputs-stacked">
                                <input value= "0" name="comment_status" type="radio" id="radio_36" class="with-gap radio-col-success" checked/>
                                <label for="radio_36">Inactive</label>
                                <input value= "1" name="comment_status" type="radio" id="radio_35" class="with-gap radio-col-success"  />
                                <label for="radio_35">Active</label>
                            </div>
                        </div>


                            <div class="form-group row">
                                <label class="col-form-label">Published At</label>
                                <div class="col">
                                    <input class="form-control @error('published_at') is-invalid @enderror"
                                        name="published_at" type="date" value="{{ old('published_at') }}"
                                        id="example-date-input">
                                    @error('published_at')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end">
                            <input type="text" name="status" id="status" hidden>
                            <a href="{{route('backend.posts.index')}}" type="submit" class="btn btn-info me-1">
                                Cancel
                            </a>
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
                                Category | Tags
                            </h4>
                        </div>

                        <div class="box-body">
                            <div class="form-group @error('postcategory_id') has-error @enderror">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-control select2" style="width: 100%;" name="postcategory_id">
                                    <option value="" holder>Select Category</option>
                                    @foreach ($postcatagories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('postcategory_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('postcategory_id')
                                    <span class="help-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tags</label>
                                <select class="form-control select2" multiple="multiple" name="tags[]"
                                    data-placeholder="Select a Tag" style="width: 100%;">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Feature Image
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
                                        <span class="btn btn-outline-secondary btn-file"><span
                                                class="fileinput-new">Select image</span><span
                                                class="fileinput-exists">Change</span>
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
                            <div class="form-group">
                                <label for="caption_image">Caption Image</label>
                                <textarea name="caption_image" id="caption_image" class="form-control @error('caption_image') is-invalid @enderror"
                                    placeholder="Caption Image">{{ old('caption_image') }}</textarea>
                                @error('caption_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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

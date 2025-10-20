
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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('backend.postscategories.index') }}">Post Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <form id="post-form" enctype="multipart/form-data" action="{{ route('backend.postscategories.store') }}" method="post">
        <div class="row">
            @csrf
            <div class="col-lg-8 col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">
                            Create a Post Category
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="mb-3 form-group">
                            <h5>Title <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Title" required>
                            </div>
                            @error('title')
                            <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group @error('parent_id') has-error @enderror">
                            <label class="form-label">Parent </label>
                            <select class="form-control select2" style="width: 100%;" name="parent_id">
                                <option value="" holder>Select Parent Category</option>
                                @foreach ($datapostcategory as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('parent_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center form-group">
                            <div class=" fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                    <img src="{{ asset('/assets/images/no_image.png') }}" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                style="max-width: 200px;"></div>
                                <div >
                                    <span class="btn btn-outline-secondary btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"></span>
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
                        <div class="box-footer text-end">
                            <a href="{{ route('backend.postscategories.index') }}" class="btn btn-warning me-2">
                                Cancel
                            </a>
                            <button id="publish-btn" type="submit"class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Current Post  Category
                            </h4>
                        </div>
                        <div class="box-body ">
                            @if ($datapostcategory->count())
                            <div class="table-responsive">
                                <table class="table mb-0 table-hover">
                                    <tbody>
                                        @foreach ($datapostcategory as $no =>  $item)
                                        <tr class="mb-0">
                                            <td>
                                                {{ !empty($item->title) ? $item->title:'' }}<br/>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h5 style="color: red" class="text-center">Data not available</h5>
                            @endif
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
    @endpush

    @endsection

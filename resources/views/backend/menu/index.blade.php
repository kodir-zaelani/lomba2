@extends('layouts.appb')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="greeting-title">{{$title}}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}"><i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="greeting">Manajemen Menu</li>
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
                    <h4 class="box-title">Manajemen Menu</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-lg-12 col-12">
                            {!! Menu::render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
{!! Menu::scripts() !!}
@endpush
@endsection


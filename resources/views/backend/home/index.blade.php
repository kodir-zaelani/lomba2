@extends('layouts.appb')
@section('content')
@auth
@php
$currentUser = Auth::user()
@endphp
@endauth
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="overflow-hidden box bg-gradient-primary pull-up">
                <div class="py-0 box-body pe-0 ps-lg-50 ps-15">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-8">
                            <h1 class="text-white fs-40">Hello {{ $currentUser->name }} !</h1>
                            <p class="mb-0 text-white fs-20">
                                Sistem Pendampingan Penilik, Kota Samarinda, Kalimantan Timur
                            </p>
                        </div>
                        <div class="col-12 col-lg-4"><img src="{{ asset('')}}assets/images/svg-icon/color-svg/custom-15.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

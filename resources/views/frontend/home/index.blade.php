@extends('layouts.appf')

@section('content')

@include('frontend.home.slider')
{{-- @include('frontend.home.hero') --}}
<section class="py-1 bg-primary info-sekolah">
    <div class="container-pluid">
        <div class="row justify-items-center align-items-center">
            <div class="pt-2 col-lg-2 col-md-2 col-12">
                <h6 class="py-3 text-center text-white fw-bold bg-warning">Info <i class="bi bi-megaphone ms-2"></i></h6>
            </div>
            <div class="col-lg-7 col-md-7 col-12">
                <div class="px-2">
                    <marquee class="py-2 text-white fw-bold" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                        <a href="http://smptunasberiman.test/kontak" class="text-white text-decoration-none ">Selamat datang di website kami marokokreatif.com </a>- Sharing Teknologi - Berbagi Ilmu Tentang Teknologi
                    </marquee>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12 d-md-block d-lg-block d-xl-block d-none">
                <h6 class="py-2 text-white fw-bold"><span id="tanggalwaktu"></span></h6>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
        else (a=tw.getTime());
        tw.setTime(a);
        var tahun= tw.getFullYear ();
        var hari= tw.getDay ();
        var bulan= tw.getMonth ();
        var tanggal= tw.getDate ();
        var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
        var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
        document.getElementById("tanggalwaktu").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun+"<br/> Pukul " + ((tw.getHours() < 10) ? "0" : "") + tw.getHours() + ":" + ((tw.getMinutes() < 10)? "0" : "") + tw.getMinutes() + (" W.I.B ");
    </script>
    @endpush
</section>
@include('frontend.home.program')
@include('frontend.home.facility')
@include('frontend.home.haribesar')
@include('frontend.home.editorial')
@include('frontend.home.recent-news')
@include('frontend.home.blog')
@include('frontend.home.ptk')
@include('frontend.home.video')
@include('frontend.home.foto')
@include('frontend.home.events')

@endsection

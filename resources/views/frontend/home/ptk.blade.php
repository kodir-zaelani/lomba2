@if ($ptk)
<section id="faculty--staff" class="pb-5 faculty--staff section">
    <div class="container">
        <div class="mx-auto mb-5 text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3 text-kindegarten">Pendidik dan Tenaga Kependidikan</h1>
        </div>
        <div class="faculty-grid">
            <div class="row g-4 justify-content-center ">
                @forelse ($ptks as $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="faculty-card">
                        <div class="faculty-image">
                            <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}" alt="{{$item->name}}" class="img-fluid" alt="Faculty Member">
                            <div class="social-links">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="faculty-info">
                            <h3>{{$item->name}}</h3>
                            <a href="#" class="profile-link">{{$item->jabatan}}</a>
                        </div>
                    </div>
                </div>
                @empty
                Belum ada data PTK
                @endforelse
            </div>
        </div>
    </div>
</section>
@endif

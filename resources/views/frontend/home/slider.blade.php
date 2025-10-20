<div id="myCarousel" class="mb-0 carousel slide d-md-block d-lg-block d-xl-block d-none" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($sliders as $key => $item)
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active':''}}" aria-current="true" aria-label="Slide {{$key}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($sliders as $key => $item)
        <div class="carousel-item {{$key == 0 ? 'active':''}}">
            <img src="{{ $item->imageUrl ? $item->imageUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="Education" class="w-100 img-fluid h-100" >
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="d-md-none d-lg-none d-xl-none d-block">
    <div id="myCarousel-responsive" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $item)
            <div class="carousel-item {{$key == 0 ? 'active':''}}">
                <img src="{{ $item->imageUrl ? $item->imageUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="Education" class="w-100" >
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel-responsive" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel-responsive" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


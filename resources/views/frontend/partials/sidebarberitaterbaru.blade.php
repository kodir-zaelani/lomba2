    @foreach ($berita_terbaru as $item)
    <article class="tab-post">
        <div class="row g-0 align-items-center">
            <div class="col-4">
                <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/uploads/images/logo/' . $global_option->logo }}" alt="{{$item->title}}" class="img-fluid">
            </div>
            <div class="col-8">
                <div class="post-content">
                    <span class="category">{{$item->postcategory->title}}</span>
                    <h4 class="post-title">
                        <a href="{{route('post.detail', $item->slug)}}">{{$item->title}}</a>
                    </h4>
                    <div class="post-author">
                        <a href="#">
                            @if ($item->author->displayname)
                            {{ $item->author->displayname }}
                            @else
                            {{ $item->author->name }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    @endforeach

@if(!empty(request()->get('menu')))
<div class="accordion" id="accordionExample">
    @php
    $pages = \App\Models\Page::get(['id', 'title', 'slug'])->map(function($page){
        return [
        'url' => '/page/detail/'.$page->slug,
        'icon' => '',
        'label' => $page->title,
        ];
    });
    @endphp
    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Pages',
    'urls' => $pages,
    'show' => true
    ])

    @php
    $categories = \App\Models\Postcategory::get(['id', 'title', 'slug'])->map(function($postcategory){
        return [
        'url' => '/berita/kategori/'.$postcategory->slug,
        'icon' => '',
        'label' => $postcategory->title,
        ];
    });
    @endphp

    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Kategori Berita',
    'urls' => $categories,
    ])

    @php
    $categoriesblog = \App\Models\Postcategory::get(['id', 'title', 'slug'])->map(function($blogcategory){
        return [
        'url' => '/blog/kategori/'.$blogcategory->slug,
        'icon' => '',
        'label' => $blogcategory->title,
        ];
    });
    @endphp

    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Kategori BLog',
    'urls' => $categoriesblog,
    ])

    @php
    $program = \App\Models\Program::get(['id', 'title', 'slug'])->map(function($program){
        return [
        'url' => '/program/detail/'.$program->slug,
        'icon' => '',
        'label' => $program->title,
        ];
    });
    @endphp

    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Program',
    'urls' => $program,
    ])

    @php
    $facility = \App\Models\Facility::get(['id', 'title', 'slug'])->map(function($facility){
        return [
        'url' => '/fasilitas/detail/'.$facility->slug,
        'icon' => '',
        'label' => $facility->title,
        ];
    });
    @endphp

    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Fasilitas',
    'urls' => $facility,
    ])

    @php
    $static = [
    [
    'url' => '/galleri-video',
    'icon' => '',
    'label' => 'Video',
    ],
    [
    'url' => '/galleri-foto',
    'icon' => '',
    'label' => 'Foto',
    ],
    [
    'url' => '/kontak',
    'icon' => '',
    'label' => 'Kontak',
    ],
    [
    'url' => '/ptk',
    'icon' => '',
    'label' => 'PTK',
    ]
    ];
    @endphp
    @include('nguyendachuy-menu::accordions.default', [
    'name' => 'Static',
    'urls' => $static,
    ])
    @include('nguyendachuy-menu::accordions.add-link', ['name' => 'Custom Link'])

</div>
@endif

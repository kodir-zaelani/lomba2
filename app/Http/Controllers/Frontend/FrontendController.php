<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ptk;
use App\Models\Blog;
use App\Models\Foto;
use App\Models\Hero;
use App\Models\Page;
use App\Models\Post;
use App\Models\Video;
use App\Models\Agenda;
use App\Models\Slider;
use App\Models\Program;
use App\Models\Facility;
use App\Models\Editorial;
use App\Models\Haribesar;
use Illuminate\Http\Request;
use NguyenHuy\Menu\Facades\Menu;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public $segment;
    protected $limit = 6;
     public function default(){
        return view('frontend.beranda.index',[
            'title' => 'Beranda'
        ]);
     }
    public function index(){
            $editorial = Editorial::publish()->orderBy('created_at', 'desc')->first();

        return view('frontend.home.index',[
            'sliders' => Slider::published()->latest()->get(),
            'hero' => Hero::published()->orderBy('created_at', 'desc')->take('1')->get(),
            'editorial' => $editorial,
            'editorials' => Editorial::publish()->orderBy('created_at', 'desc')->where('id','<>',$editorial->id)->take(2)->get(),
            'ptk' => Ptk::published()->where('jenisptk_id', '9ffd939a-137b-4292-b630-b8873a6bb026')->first(),
            'ptks' => Ptk::published()->get(),
            'postpopular' => Post::Publishedate()->News()->popular()->orderBy('published_at', 'desc')->first(),
            'posts' => Post::Publishedate()->News()->orderBy('published_at', 'desc')->take(4)->get(),
            'blogs' => Blog::Publishedate()->orderBy('published_at', 'desc')->take(4)->get(),
            'videos' => Video::published()->orderBy('created_at', 'desc')->take(3)->get(),
            'fotos' => Foto::published()->orderBy('created_at', 'desc')->take(6)->get(),
            'haribesar' => Haribesar::published()->orderBy('created_at', 'desc')->take(1)->get(),
            'program' => Program::published()->orderBy('created_at', 'desc')->get(),
            'agenda' => Agenda::published()->orderBy('created_at', 'desc')->get(),
            'facilities' => Facility::published()->orderBy('created_at', 'desc')->take(4)->get(),
            'title' => 'Beranda'
        ]);
    }
    public function contact(){
        return view('frontend.page.contact',[
            'title' => 'Kontak'
        ]);
    }

    public function pagedetail(Request $request, Page $page){
        $this->segment = $request->segment(3);
        $page = Page::published()->where('slug', $this->segment)->first();
        $page->increment('view_count');

        return view('frontend.page.detail',[
            'pages' => Page::published()->where('pagecategory_id', $page->pagecategory_id)->get(),
            'page' => $page,
            'title' => 'Detail Page'
        ]);
    }

    public function programdetail(Request $request, Program $program){
        $this->segment = $request->segment(3);
        $program = Program::published()->where('slug', $this->segment)->first();
        $program->increment('view_count');

        return view('frontend.program.detail',[
            'programs' => Program::published()->where('id' ,'<>', $program->id)->get(),
            'program' => $program,
            'title' => 'Detail Program'
        ]);
    }

    public function haribesardetail(Request $request, Haribesar $haribesar){
        $this->segment = $request->segment(3);
        $haribesar = Haribesar::where('slug', $this->segment)->first();
        $haribesar->increment('view_count');

        return view('frontend.haribesar.detail',[
            'haribesars' => Haribesar::published()->where('id' ,'<>', $haribesar->id)->paginate($this->limit),
            'haribesar' => $haribesar,
            'title' => 'Detail Hari Besar'
        ]);
    }

    public function fasilitas(Request $request, Facility $facility){
        $this->segment = $request->segment(3);
        $fasility = Facility::where('slug', $this->segment)->first();
        $fasility->increment('view_count');

        return view('frontend.facility.detail',[
            'fasilities' => Facility::published()->where('id' ,'<>', $fasility->id)->paginate($this->limit),
            'fasility' => $fasility,
            'title' => 'Detail Fasilitas'
        ]);
    }

    public function agenda(Request $request, Agenda $agenda){
        $this->segment = $request->segment(3);
        $agenda = Agenda::where('slug', $this->segment)->first();
        $agenda->increment('view_count');

        return view('frontend.agenda.detail',[
            'agendas' => Agenda::published()->where('id' ,'<>', $agenda->id)->paginate($this->limit),
            'agenda' => $agenda,
            'title' => 'Detail Agenda'
        ]);
    }

    public function editorialdetail(Request $request){
        $this->segment = $request->segment(3);
        $editorial = Editorial::publish()->where('slug', $this->segment)->first();
        $editorial->increment('view_count');

        return view('frontend.editorial.detail',[
            'editorials' => editorial::publish()->get(),
            'editorial' => $editorial,
            'title' => 'Detail Editorial'
        ]);
    }

    public function editorialall(Request $request){

        return view('frontend.editorial.all',[
            'editorials' => Editorial::Published()
            ->Publishedate()
            ->latest()
            ->paginate($this->limit),
            'title' => 'Semua Editorial'
        ]);
    }



    public function fotoAll()
    {
        return view('frontend.foto.all', [
            'fotos' => Foto::with('album')
            ->latest()
            ->paginate($this->limit),
            'title' => 'Galeri Foto'
        ]);
    }
    public function videoAll()
    {
        return view('frontend.video.all', [
            'videos' => Video::latest()
            ->paginate($this->limit),
            'title' => 'Galeri Video'
        ]);
    }

}
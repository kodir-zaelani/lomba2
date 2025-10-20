<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hero;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroStoreRequest;
use App\Http\Requests\HeroUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class HeroController extends Controller
{
    protected $uploadPath;

    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryHero'));
    }

    public static function middleware(): array
    {
        return [
            'permission:hero.index|hero.create|hero.edit|hero.delete|hero.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.heros.index', [
            'title' => 'Hero List'
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.heros.create', [
            'title' => 'Hero Create',
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(HeroStoreRequest $request)
    {

        // Default data
        $data = [
            'title'            => $request->input('title'),
            'description'      => $request->input('description'),
            'slug'             => Str::slug($request->input('title')),
            'link_hero'        => $request->input('link_hero'),
            'teacher'          => $request->input('teacher'),
            'student'          => $request->input('student'),
            'administration'   => $request->input('administration'),
            'ratio'            => $request->input('ratio'),
            'title_btn_link'   => $request->input('title_btn_link'),
            'icon_link'        => $request->input('icon_link'),
            'target_link_hero' => $request->input('target_link_hero'),
            'video_hero'       => $request->input('video_hero'),
            'title_btn_video'  => $request->input('title_btn_video'),
            'icon_btn_video'   => $request->input('icon_btn_video'),
            'status'           => $request->input('status'),
        ];

        //upload imagehero (cara kedua)
        if ($request->has('imagehero')) {
            # upload with imagehero
            $imagehero = $request->file('imagehero');
            $fileName = 'imagehero_' . time() . $imagehero->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($imagehero);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = 300;
                $height = 200;
                $extension = $imagehero->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'imagehero' => $image_data
            ]);
        }

        $hero = Hero::create($data);

        return redirect()->route('backend.heros.index')->with(['success' => 'Add Hero ' . $hero['titel'] . ' was successfully!']);

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Hero $hero)
    {
        return view('backend.heros.edit', [
            'hero' => $hero,
            'pages' => Page::published()->where('status', '1')->get(),
            'title' => 'Hero Edit',
        ]);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(HeroUpdateRequest $request, Hero $hero)
    {
        // Default data
        $data = [
            'title'            => $request->input('title'),
            'description'      => $request->input('description'),
            'slug'             => Str::slug($request->input('title')),
            'link_hero'        => $request->input('link_hero'),
            'teacher'          => $request->input('teacher'),
            'student'          => $request->input('student'),
            'administration'   => $request->input('administration'),
            'ratio'            => $request->input('ratio'),
            'title_btn_link'   => $request->input('title_btn_link'),
            'icon_link'        => $request->input('icon_link'),
            'target_link_hero' => $request->input('target_link_hero'),
            'video_hero'       => $request->input('video_hero'),
            'title_btn_video'  => $request->input('title_btn_video'),
            'icon_btn_video'   => $request->input('icon_btn_video'),
            'status'           => $request->input('status'),
        ];

        //upload imagehero (cara kedua)
        if ($request->has('imagehero')) {
            # upload with imagehero
            $imagehero = $request->file('imagehero');
            $fileName = 'imagehero_' . time() . $imagehero->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($imagehero);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = 300;
                $height = 200;
                $extension = $imagehero->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'imagehero' => $image_data
            ]);
        }

        $hero->update($data);
        // $hero = Hero::update($data);

        return redirect()->route('backend.heros.index')->with(['warning' => 'Edit Hero ' . $hero['titel'] . ' was successfully!']);
    }
}
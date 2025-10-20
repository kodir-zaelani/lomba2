<?php

namespace App\Http\Controllers\Backend;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestVideoStore;
use App\Http\Requests\RequestVideoUpdate;
use Intervention\Image\Laravel\Facades\Image;

class VideoController extends Controller
{
    protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryVideos'));
    }

    public static function middleware(): array
    {
        return [
            'permission:video.index|video.create|video.edit|video.delete|video.trash',
        ];
    }
    public function index()
    {
        return view('backend.video.index',[
            'title' => 'List Video'
        ]);
    }

    public function create()
    {
        return view('backend.video.create',[
            'title' => 'Create Video',
        ]);
    }

    public function store(RequestVideoStore $request)
    {
        // Default data
        $data = [
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'content'   => $request->input('content'),
            'status'    => $request->input('status'),
            'video'     => $request->input('video'),
            'author_id' => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'video_' . time().$image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image)->resize(600,400);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailvideo.width');
                $height = config('cms.image.thumbnailvideo.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);

        }

        $video = Video::create($data);

        if($video){
            //redirect dengan pesan sukses
            return redirect()->route('backend.video.index')->with(['success' => 'Add Video ' . $video['title'] . ' was successfully!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('backend.video.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Video $video)
    {
        return view('backend.video.edit', [
            'video' => $video,
            'title' => 'Edit Video'
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RequestVideoUpdate $request, Video $video)
    {
        //cek gambar lama
        $oldImage = $video->image;

        // Default data
        $data = [
            'title'      => $request->input('title'),
            'slug'       => Str::slug($request->input('title')),
            'content'    => $request->input('content'),
            'status'     => $request->input('status'),
            'video'      => $request->input('video'),
            'updated_by' => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'video_' . time().$image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image)->resize(600,400);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailvideo.width');
                $height = config('cms.image.thumbnailvideo.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);

        }

        $video->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $video->image) {
            $this->removeImage($oldImage);
        }

        if($video){
            //redirect dengan pesan sukses
            return redirect()->route('backend.video.index')->with(['success' => 'Update Video ' . $video['title'] . ' was successfully!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('backend.video.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    // function remove image
    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }
}

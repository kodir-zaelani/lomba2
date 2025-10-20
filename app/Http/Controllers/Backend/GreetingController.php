<?php

namespace App\Http\Controllers\Backend;

use App\Models\Greeting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestGreetingStore;
use App\Http\Requests\RequestGreetingUpdate;
use Intervention\Image\Laravel\Facades\Image;

class GreetingController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryGreetings'));
    }

     public static function middleware(): array
    {
        return [
            'permission:greetings.index|greetings.create|greetings.edit|greetings.delete|greetings.trash',
        ];
    }
    public function index()
    {
        return view('backend.greeting.index',[
            'title' => 'Greetings',
        ]);
    }

    public function create()
    {
        return view('backend.greeting.create',[
            'title' => 'Greeting Create',
        ]);
    }

    public function store(RequestGreetingStore $request)
    {
        // Default data
        $data = [
            'title'              => $request->input('title'),
            'slug'               => Str::slug($request->input('title')),
            'content'            => $request->input('content'),
            'caption_image'      => $request->input('caption_image'),
            'video'              => $request->input('video'),
            'caption_video'      => $request->input('caption_video'),
            'status'             => $request->input('status'),
            'published_at'       => $request->input('published_at'),
            'author_id'          => Auth::id(),
        ];

        // dd($data);

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'greeting_' . Str::slug($request->title) . '.' . $extension;
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80); //SIMPAN FILE ORIGINAL YANG BELUM BERISI WATERMARK

            if ($imageUploaded) {

                //KEMUDIAN KITA SISIPKAN WATERMARK DENGAN TEXT LAMAN KREASI
                //X = 200, Y = 150. SILAHKAN DISESUAIKAN UNTUK POSISINYA
                $imageUploaded->text('SDN 005 Samarida Ilir', 300, 150, function ($font) {
                    // $font->file(public_path('fonts/milkyroad.ttf'));   //LOAD FONT-NYA JIKA ADA, SILAHKAN DOWNLOAD SENDIRI
                    $font->file(public_path('uploads/fonts/amandasignature.ttf'));   //LOAD FONT-NYA JIKA ADA, SILAHKAN DOWNLOAD SENDIRI
                    $font->size(30);
                    $font->color('#f5f0e6');
                    $font->align('center');
                    $font->valign('bottom');
                    $font->angle(0);
                });

                // Watermark
                $filenameWatermark = str_replace(".{$extension}", "_watermark.{$extension}", $fileName);

                // Save watermark
                $imageUploaded->resize(1024, 768)
                    ->save($destination . '/' . $filenameWatermark, 80); //SIMPAN FILE ORIGINAL YANG BERISI WATERMARK

                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailgreeting.width');
                $height = config('cms.image.thumbnailgreeting.height');
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                $imageUploaded->resize($width, $height)
                    ->save($destination . '/' . $thumbnail); //SIMPAN FILE THUMBNAIL YANG BERISI WATERMARK

            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            $image_watermark = $filenameWatermark;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data,
            ]);

            $data = array_merge($data, [
                'image_watermark' => $image_watermark,
            ]);
        }

        $greeting = Greeting::create($data);


        return redirect()->route('backend.greetings.index')->with(['success' => 'Data Greeting Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Greeting $greeting)
    {

        return view('backend.greeting.edit', [
            'greeting'   => $greeting,
            'title' => 'Greeting Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestGreetingUpdate $request, Greeting $greeting)
    {
        //cek gambar lama
        $oldImage = $greeting->image;


        // Default data
        $data = [
            'title'           => $request->input('title'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
            'video'           => $request->input('video'),
            'caption_video'   => $request->input('caption_video'),
            'caption_image'   => $request->input('caption_image'),
            'status'          => $request->input('status'),
            'published_at'    => $request->input('published_at'),
            'updated_by'      => Auth::id(),
        ];

        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'greeting_' . Str::slug($request->title) . '.' . $extension;
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80); //SIMPAN FILE ORIGINAL YANG BELUM BERISI WATERMARK

            if ($imageUploaded) {
                $extension = $image->getClientOriginalExtension();

                //KEMUDIAN KITA SISIPKAN WATERMARK DENGAN TEXT LAMAN KREASI
                //X = 200, Y = 150. SILAHKAN DISESUAIKAN UNTUK POSISINYA
                $imageUploaded->text('TK Tunas Beriman', 300, 150, function ($font) {
                    // $font->file(public_path('fonts/milkyroad.ttf'));   //LOAD FONT-NYA JIKA ADA, SILAHKAN DOWNLOAD SENDIRI
                    $font->file(public_path('uploads/fonts/amandasignature.ttf'));   //LOAD FONT-NYA JIKA ADA, SILAHKAN DOWNLOAD SENDIRI
                    $font->size(30);
                    $font->color('#f5f0e6');
                    $font->align('center');
                    $font->valign('bottom');
                    $font->angle(0);
                });

                // Watermark
                $filenameWatermark = str_replace(".{$extension}", "_watermark.{$extension}", $fileName);

                // Save watermark
                $imageUploaded->resize(1024, 768)
                    ->save($destination . '/' . $filenameWatermark, 80); //SIMPAN FILE ORIGINAL YANG BERISI WATERMARK

                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailgreeting.width');
                $height = config('cms.image.thumbnailgreeting.height');
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                $imageUploaded->resize($width, $height)
                    ->save($destination . '/' . $thumbnail); //SIMPAN FILE THUMBNAIL YANG BERISI WATERMARK

            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            $image_watermark = $filenameWatermark;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data,
            ]);

            $data = array_merge($data, [
                'image_watermark' => $image_watermark,
            ]);
        }

        $greeting->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $greeting->image) {
            $this->removeImage($oldImage);
        }


        return redirect()->route('backend.greetings.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }

    // function remove image
    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath     = $this->uploadPath . '/' . $image;

            $ext           = substr(strrchr($image, '.'), 1);

            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            $watermark     = str_replace(".{$ext}", "_watermark.{$ext}", $image);
            $watermarkPath = $this->uploadPath . '/' . $watermark;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
            if (file_exists($watermarkPath)) unlink($watermarkPath);
        }
    }
}

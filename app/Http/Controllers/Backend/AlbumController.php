<?php

namespace App\Http\Controllers\Backend;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestFotoStore;
use App\Http\Requests\RequestAlbumStore;
use App\Http\Requests\RequestAlbumUpdate;
use Intervention\Image\Laravel\Facades\Image;

class AlbumController extends Controller
{
    protected $uploadPath;
    protected $uploadPathfoto;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryAlbums'));
        $this->uploadPathfoto = public_path(config('cms.image.directoryFoto'));
    }


    public static function middleware(): array
    {
        return [
            'permission:albums.index|albums.create|albums.edit|albums.delete|albums.trash',
        ];
    }

    public function index()
    {
        return view('backend.album.index',[
            'title' => 'Albums'
        ]);
    }

    public function create()
    {
        return view('backend.album.create', [
            'title' => 'Create Album'
        ]);
    }

    public function store(RequestAlbumStore $request)
    {
        // Default data
        $data = [
            'title'              => $request->input('title'),
            'slug'               => Str::slug($request->input('title')),
            'content'            => $request->input('content'),
            'status'             => $request->input('status'),
            'author_id'          => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'album_' . Str::slug($request->title) . '.' . $extension;
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80);

            if ($imageUploaded) {
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
                $width = config('cms.image.thumbnailalbum.width');
                $height = config('cms.image.thumbnailalbum.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                $imageUploaded->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);
        }

        $album = Album::create($data);

        if ($album) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.albums.index')->with(['success' => 'Data Album Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.albums.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('backend.album.edit', [
            'album' => $album,
            'title' => 'Edit Album'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestAlbumUpdate $request, Album $album)
    {
        //cek gambar lama
        $oldImage = $album->image;

        // Default data
        $data = [
            'title'              => $request->input('title'),
            'content'            => $request->input('content'),
            'status'             => $request->input('status'),
            'author_id'          => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'album_' . Str::slug($request->title) . '.' . $extension;
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80);

            if ($imageUploaded) {

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
                $width = config('cms.image.thumbnailalbum.width');
                $height = config('cms.image.thumbnailalbum.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                $imageUploaded->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);
        }

        $album->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $album->image) {
            $this->removeImage($oldImage);
        }

        if ($album) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.albums.index')->with(['success' => 'Add Album' . $album['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.albums.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

     public function storefoto(RequestFotoStore $request)
    {
        // Default data
        $data = [
            'album_id'  => $request->input('album_id'),
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
            'author_id' => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'foto_' . Str::slug($request->title) . '_'. time() . '.' . $extension;
            $destinationfoto = $this->uploadPathfoto;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destinationfoto . $fileName, 80);

            if ($imageUploaded) {
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
                    ->save($destinationfoto . '/' . $filenameWatermark, 80); //SIMPAN FILE ORIGINAL YANG BERISI WATERMARK

                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailfoto.width');
                $height = config('cms.image.thumbnailfoto.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                $imageUploaded->resize($width, $height)
                    ->save($destinationfoto . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);
        }

        $foto = Foto::create($data);

        if ($foto) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.albums.index')->with(['success' => 'Add Foto was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.albums.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
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
    // function remove image
    private function removeFoto($image)
    {
        if (!empty($image)) {
            $imagePath     = $this->uploadPathfoto . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPathfoto . '/' . $thumbnail;

            $watermark     = str_replace(".{$ext}", "_watermark.{$ext}", $image);
            $watermarkPath = $this->uploadPathfoto . '/' . $watermark;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
            if (file_exists($watermarkPath)) unlink($watermarkPath);
        }
    }
}

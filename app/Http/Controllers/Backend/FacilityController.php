<?php

namespace App\Http\Controllers\Backend;

use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestFacilityStore;
use App\Http\Requests\RequestFacilityUpdate;
use Intervention\Image\Laravel\Facades\Image;

class FacilityController extends Controller
{
    protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryFacilities'));
    }


    public static function middleware(): array
    {
        return [
            'permission:facility.index|facility.create|facility.edit|facility.delete|facility.trash',
        ];
    }

    public function index()
    {
        return view('backend.facility.index',[
            'title' => 'Facility'
        ]);
    }

    public function create()
    {
        return view('backend.facility.create', [
            'title' => 'Create Facility'
        ]);
    }

    public function store(RequestFacilityStore $request)
    {
        // Default data
        $data = [
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'content'   => $request->input('content'),
            'icon'      => $request->input('icon'),
            'status'    => $request->input('status'),
            'class' => $request->input('class'),
            'author_id' => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'facility_' . Str::slug($request->title) . '.' . $extension;
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
                $width = config('cms.image.thumbnailfacility.width');
                $height = config('cms.image.thumbnailfacility.height');
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

        $facility = Facility::create($data);

        if ($facility) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.facility.index')->with(['success' => 'Data Facility Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.facility.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Facility $facility)
    {
        return view('backend.facility.edit', [
            'facility' => $facility,
            'title' => 'Edit Facility'
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RequestFacilityUpdate $request, Facility $facility)
    {
        //cek gambar lama
        $oldImage = $facility->image;

        // Default data
        $data = [
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
            'icon'      => $request->input('icon'),
            'status'    => $request->input('status'),
            'class' => $request->input('class'),
            'author_id' => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'facility_' . Str::slug($request->title) . '.' . $extension;
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
                $width = config('cms.image.thumbnailfacility.width');
                $height = config('cms.image.thumbnailfacility.height');
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

        $facility->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $facility->image) {
            $this->removeImage($oldImage);
        }

        if ($facility) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.facility.index')->with(['success' => 'Add Facility' . $facility['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.facility.index')->with(['error' => 'Data Gagal Diperbaharui!']);
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
}

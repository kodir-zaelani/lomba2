<?php

namespace App\Http\Controllers\Backend;

use App\Models\Announcement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestFotoStore;
use App\Http\Requests\RequestAnnouncementStore;
use App\Http\Requests\RequestAnnouncementUpdate;
use Intervention\Image\Laravel\Facades\Image;

class AnnouncementController extends Controller
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
        $this->uploadPath = public_path(config('cms.image.directoryAnnouncements'));
    }


    public static function middleware(): array
    {
        return [
            'permission:announcements.index|announcements.create|announcements.edit|announcements.delete|announcements.trash',
        ];
    }

    public function index()
    {
        return view('backend.announcement.index',[
            'title' => 'Announcements'
        ]);
    }

    public function create()
    {
        return view('backend.announcement.create', [
            'title' => 'Create Announcement'
        ]);
    }

    public function store(RequestAnnouncementStore $request)
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
            $fileName = 'announcement_' . Str::slug($request->title) . '.' . $extension;
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
                $width = config('cms.image.thumbnailannouncement.width');
                $height = config('cms.image.thumbnailannouncement.height');
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

        $announcement = Announcement::create($data);

        if ($announcement) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.announcement.index')->with(['success' => 'Data Announcement Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.announcement.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        return view('backend.announcement.edit', [
            'announcement' => $announcement,
            'title' => 'Edit Announcement'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestAnnouncementUpdate $request, Announcement $announcement)
    {
        //cek gambar lama
        $oldImage = $announcement->image;

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
            $fileName = 'announcement_' . Str::slug($request->title) . '.' . $extension;
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
                $width = config('cms.image.thumbnailannouncement.width');
                $height = config('cms.image.thumbnailannouncement.height');
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

        $announcement->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $announcement->image) {
            $this->removeImage($oldImage);
        }

        if ($announcement) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.announcement.index')->with(['success' => 'Add Announcement' . $announcement['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.announcement.index')->with(['error' => 'Data Gagal Diperbaharui!']);
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

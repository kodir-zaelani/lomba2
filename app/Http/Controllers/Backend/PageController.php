<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Support\Str;
use App\Models\Pagecategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestPageStore;
use App\Http\Requests\RequestPageUpdate;
use Intervention\Image\Laravel\Facades\Image;

class PageController extends Controller
{
    protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryPages'));
    }

     public static function middleware(): array
    {
        return [
            'permission:pages.index|pages.create|pages.edit|pages.delete|pages.trash',
        ];
    }

    public function index()
    {
        return view('backend.page.index', [
            'title' => 'Page'
        ]);
    }

    public function create()
    {
        return view('backend.page.create', [
            'pagecatagories' => Pagecategory::orderBy('title', 'asc')->get(),
            'title' => 'Page Create'
        ]);
    }

    public function store(RequestPageStore $request)
    {
        // Default data
        $data = [
            'title'           => $request->input('title'),
            'pagecategory_id' => $request->input('pagecategory_id'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
            'status'          => $request->input('status'),
        ];
        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'page_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image)->resize(1024, 768);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailpage.width');
                $height = config('cms.image.thumbnailpage.height');
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

        $page = Page::create($data);

        if ($page) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.pages.index')->with(['success' => 'Add Page ' . $page['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.pages.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Page $page)
    {
        return view('backend.page.edit', [
            'pagecatagories' => Pagecategory::orderBy('title', 'asc')->get(),
            'page' => $page,
            'title' => 'Page Edit'
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RequestPageUpdate $request, Page $page)
    {
        //cek gambar lama
        $oldImage = $page->image;

        // Default data
        $data = [
            'title'           => $request->input('title'),
            'pagecategory_id' => $request->input('pagecategory_id'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
            'status'          => $request->input('status'),
            'updated_by'      => Auth::id(),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'page_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image)->resize(1024, 768);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailpage.width');
                $height = config('cms.image.thumbnailpage.height');
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

        $page->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $page->image) {
            $this->removeImage($oldImage);
        }

        if ($page) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.pages.index')->with(['warning' => 'Edit Page ' . $page['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.pages.index')->with(['error' => 'Data Gagal Diperbaharui!']);
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

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
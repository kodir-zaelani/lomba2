<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Models\Pagecategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PagecategoryRequest;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\PagecategoryupdateRequest;

class PagecategoryController extends Controller
{
    protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryPagecategory'));
    }

    public static function middleware(): array
    {
        return [
            'permission:pagecategories.index|pagecategories.create|pagecategories.edit|pagecategories.delete|pagecategories.trash',
        ];
    }

    public function index()
    {
        return view('backend.pagecategory.index', [
            'title' => 'Page Category'
        ]);
    }

    public function create()
    {
        return view('backend.pagecategory.create', [
            'datapagecategory' => Pagecategory::orderBy('created_at', 'asc')->get(),
            'title' => 'Page Category Create'
        ]);
    }

    public function store(PagecategoryRequest $request)
    {
        // Default data
        $data = [
            'title'            => $request->input('title'),
            'slug'             => Str::slug($request->input('title')),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'pagecategory_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            // $fileName = 'pagecategory_' . Str::slug($request->title) . '_' . time() . $image->getClientOriginalName();
            // $fileName = 'pagecategory_' . time() . $extension;
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailpagecategory.width');
                $height = config('cms.image.thumbnailpagecategory.height');
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

        $pagecategory = Pagecategory::create($data);

        return redirect()->route('backend.pagecategories.index')->with(['success' => 'Add Page Category ' . $pagecategory['title'] . ' was successfully!']);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Pagecategory $pagecategory)
    {

        return view('backend.pagecategory.edit', [
            'pagecategory' => $pagecategory,
            'datapagecategory' => Pagecategory::orderBy('created_at', 'asc')->get(),
            'title'        => 'Page Category Edit',
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(PagecategoryupdateRequest $request, Pagecategory $pagecategory)
    {
        $oldImage = $pagecategory->image;
        // Default data
        $data = [
            'title'            => $request->input('title'),
            'slug'             => Str::slug($request->input('title')),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'pagecategory_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            // $fileName = 'pagecategory_' . time() . $image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($image);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailpagecategory.width');
                $height = config('cms.image.thumbnailpagecategory.height');
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

        $pagecategory->update($data);
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $pagecategory->image) {
            $this->removeImage($oldImage);
        }

        return redirect()->route('backend.pagecategories.index')->with(['warning' => 'Edit Page Category ' . $pagecategory['title'] . ' was successfully!']);
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
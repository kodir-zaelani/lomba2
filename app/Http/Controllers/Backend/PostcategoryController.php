<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\PostcategorystoreRequest;
use App\Http\Requests\PostcategoryupdateRequest;

class PostcategoryController extends Controller
{
     protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryCategorypost'));
    }

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'permission:categoryposts.index|categoryposts.create|categoryposts.edit|categoryposts.delete|categoryposts.trash',
        ];
    }

    public function index()
    {
        return view('backend.postcategory.index', [
            'title' => 'Post Category'
        ]);
    }

     public function create()
    {
        return view('backend.postcategory.create', [
            'datapostcategory' => Postcategory::orderBy('created_at', 'asc')->get(),
            'title' => 'Post Category Create'
        ]);
    }

    public function store(PostcategorystoreRequest $request)
    {
        // Default data
        $data = [
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'parent_id' => $request->input('parent_id'),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'postcategory_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
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

        $postcategory = Postcategory::create($data);

        return redirect()->route('backend.postscategories.index')->with(['success' => 'Add Post Category ' . $postcategory['title'] . ' was successfully!']);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Postcategory $postcategory)
    {

        return view('backend.postcategory.edit', [
            'postcategory' => $postcategory,
            'datapostcategory' => Postcategory::orderBy('created_at', 'asc')->get(),
            'title'        => 'Post Category Edit',
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(PostcategoryupdateRequest $request, Postcategory $postcategory)
    {
        $oldImage = $postcategory->image;
        // Default data
        $data = [
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'parent_id' => $request->input('parent_id'),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = 'postcategory_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            // $fileName = 'postcategory_' . time() . $image->getClientOriginalName();
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

        $postcategory->update($data);
        // Jika gambar lama ada maka lakukan hapus gambar
            if ($oldImage !== $postcategory->image) {
                $this->removeImage($oldImage);
            }

        return redirect()->route('backend.postscategories.index')->with(['warning' => 'Edit Post Category ' . $postcategory['title'] . ' was successfully!']);
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
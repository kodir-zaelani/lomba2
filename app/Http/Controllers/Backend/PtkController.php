<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ptk;
use App\Models\Jenisptk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PtkStoreRequest;
use App\Http\Requests\PtkUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class PtkController extends Controller
{
    protected $uploadPath;

    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryPtk'));
    }

    public static function middleware(): array
    {
        return [
            'permission:ptk.index|ptk.create|ptk.edit|ptk.delete|ptk.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.ptk.index', [
            'title' => 'PTK List'
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.ptk.create', [
            'jenisptks' => Jenisptk::orderBy('jenis_ptk', 'asc')->get(),
            'title' => 'PTK Create',
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PtkStoreRequest $request)
    {

        // Default data
        $data = [
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'jabatan' => $request->input('jabatan'),
            'jenisptk_id' => $request->input('jenisptk_id'),
        ];


         //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'ptk_' . time() . $image->hashName();
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80);

            if ($imageUploaded) {

                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailptk.width');
                $height = config('cms.image.thumbnailptk.height');
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

        $ptk = Ptk::create($data);

        //assign role to ptk
        return redirect()->route('backend.ptk.index')->with(['success' => 'Add PTK ' . $ptk['name'] . ' was successfully!']);

    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ptk $ptk)
    {
        return view('backend.ptk.edit', [
            'jenisptks' => Jenisptk::orderBy('jenis_ptk', 'asc')->get(),
            'ptk' => $ptk,
            'title' => 'Edit PTK'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PtkUpdateRequest $request, Ptk $ptk)
    {
        //cek gambar lama
        $oldImage = $ptk->image;

        // Default data
        $data = [
            'name'        => $request->input('name'),
            'email'       => $request->input('email'),
            'jabatan'     => $request->input('jabatan'),
            'jenisptk_id' => $request->input('jenisptk_id'),
        ];

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'ptk_' . time() . $image->hashName();
            $destination = $this->uploadPath;

            $imageUploaded = Image::read($image)->resize(1024, 768);
            $imageUploaded->save($destination . $fileName, 80);

            if ($imageUploaded) {

                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailptk.width');
                $height = config('cms.image.thumbnailptk.height');
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

        $ptk->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $ptk->image) {
            $this->removeImage($oldImage);
        }

        if ($ptk) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.ptk.index')->with(['success' => 'Edit PTK' . $ptk['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.ptk.index')->with(['error' => 'Data Gagal Diperbaharui!']);
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
<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pegawai;
use App\Models\Jenisptk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiStoreRequest;
use App\Http\Requests\PegawaiUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class PegawaiController extends Controller
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
            'permission:pegawai.index|pegawai.create|pegawai.edit|pegawai.delete|pegawai.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.pegawai.index', [
            'title' => 'Pegawai List'
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.pegawai.create', [
            'jenisptks' => Jenisptk::orderBy('jenis_ptk', 'asc')->get(),
            'title' => 'Tambah Pegawai',
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PegawaiStoreRequest $request)
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
            $fileName = 'pegawai_' . time() . $image->hashName();
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

        $pegawai = Pegawai::create($data);

        //assign role to pegawai
        return redirect()->route('backend.pegawai.index')->with(['success' => 'Add Pegawai ' . $pegawai['name'] . ' was successfully!']);

    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('backend.pegawai.edit', [
            'jenisptks' => Jenisptk::orderBy('jenis_ptk', 'asc')->get(),
            'pegawai' => $pegawai,
            'title' => 'Edit Pegawai'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiUpdateRequest $request, Pegawai $pegawai)
    {
        //cek gambar lama
        $oldImage = $pegawai->image;

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
            $fileName = 'pegawai_' . time() . $image->hashName();
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

        $pegawai->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $pegawai->image) {
            $this->removeImage($oldImage);
        }

        if ($pegawai) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.pegawai.index')->with(['success' => 'Edit Pegawai' . $pegawai['title'] . ' was successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.pegawai.index')->with(['error' => 'Data Gagal Diperbaharui!']);
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

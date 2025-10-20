<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Yayasan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Exports\YayasanExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\YayasanExportfromView;
use App\Imports\YayasanImportfromView;
use Illuminate\Support\Facades\Storage;
use App\Imports\YayasanimportCollection;
use App\Http\Requests\yayasanUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\logoYayasanUpdateRequest;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

class YayasanController extends Controller
{
    protected $uploadPath;
    protected $uploadPathexcel    = 'files/excel/';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryLogo'));
    }


    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'permission:yayasan.index|yayasan.create|yayasan.edit|yayasan.delete|yayasan.trash',
        ];
    }
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {

        return view('backend.yayasan.index', [
            'title' => 'Data Yayasan'
        ]);
        // $yayasan= Yayasan::where('status_yayasan_update', '1')->first();

        // if (!empty($yayasan)) {
        //     return redirect()->route('backend.yayasan.edit', $yayasan->id);
        // } else {
        //     return view('backend.yayasan.create', [
        //     'dataprovinsi' => Provinsi::orderBy('name', 'asc')->get(),
        //         'title' => 'Data Yayasan'
        //     ]);
        // }
    }

    public function edit($yayasan)
    {
        return view('backend.yayasan.edit', [
            'dataprovinsi' => Provinsi::orderBy('name', 'asc')->get(),
            'title' => 'Edit yayasan',
            'yayasan' => $yayasan
        ]);
    }

    public function store (yayasanStoreRequest $request)
    {

        // Default data
        $data = [
            'nama'                  => $request->input('nama'),
            'alamat'                => $request->input('alamat'),
            'rt'                    => $request->input('rt'),
            'rw'                    => $request->input('rw'),
            'nama_dusun'            => $request->input('nama_dusun'),
            'desa_kelurahan'        => $request->input('desa_kelurahan'),
            'kecamatan'             => $request->input('kecamatan'),
            'kabupaten'             => $request->input('kabupaten'),
            'provinsi'              => $request->input('provinsi'),
            'kode_pos'              => $request->input('kode_pos'),
            'website'               => $request->input('website'),
            'email'                 => $request->input('email'),
            'maps'                  => $request->input('maps'),
            'lintang'               => $request->input('lintang'),
            'bujur'                 => $request->input('bujur'),
            'nama_pimpinam_yayasan' => $request->input('nama_pimpinam_yayasan'),
            'no_pendirian_yayasan'  => $request->input('no_pendirian_yayasan'),
            'tgl_pendirian_yayasan' => $request->input('tgl_pendirian_yayasan'),
            'status_yayasan_update' => $request->input('status_yayasan_update'),

        ];

        //upload logo_yayasan (cara kedua)
        if ($request->has('logo_yayasan')) {
            # upload with logo_yayasan
            $logo_yayasan = $request->file('logo_yayasan');
            $fileName = 'logo_' . time() . $logo_yayasan->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo_yayasan);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\config\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo_yayasan->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo_yayasan' => $image_data
            ]);
        }

        $yayasan = Yayasan::create($data);

        if ($yayasan) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.yayasan.index')->with(['success' => 'Data yayasanBerhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.yayasan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update (yayasanUpdateRequest $request, Yayasan $yayasan)
    {
        //cek gambar lama
        $oldLogo        = $yayasan->logo_yayasan;
        // Default data
        $data = [
            'nama'                  => $request->input('nama'),
            'alamat'                => $request->input('alamat'),
            'rt'                    => $request->input('rt'),
            'rw'                    => $request->input('rw'),
            'nama_dusun'            => $request->input('nama_dusun'),
            'desa_kelurahan'        => $request->input('desa_kelurahan'),
            'kecamatan'             => $request->input('kecamatan'),
            'kabupaten'             => $request->input('kabupaten'),
            'provinsi'              => $request->input('provinsi'),
            'kode_pos'              => $request->input('kode_pos'),
            'website'               => $request->input('website'),
            'email'                 => $request->input('email'),
            'maps'                  => $request->input('maps'),
            'lintang'               => $request->input('lintang'),
            'bujur'                 => $request->input('bujur'),
            'nama_pimpinam_yayasan' => $request->input('nama_pimpinam_yayasan'),
            'no_pendirian_yayasan'  => $request->input('no_pendirian_yayasan'),
            'tgl_pendirian_yayasan' => $request->input('tgl_pendirian_yayasan'),
            'status_yayasan_update' => $request->input('status_yayasan_update'),
        ];


        //upload logo_yayasan (cara kedua)
        if ($request->has('logo_yayasan')) {
            # upload with logo_yayasan
            $logo_yayasan = $request->file('logo_yayasan');
            $fileName = 'logo_' . time() . $logo_yayasan->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo_yayasan);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\config\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo_yayasan->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo_yayasan' => $image_data
            ]);
        }



        $yayasan>update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldLogo !== $yayasan->logo_yayasan) {
            $this->removeLogo($oldLogo);
        }

        //redirect dengan pesan sukses
        return redirect()->back()->with(['success' => 'Data yayasan Berhasil Disimpan!']);
    }

    public function updatelogo (logoYayasanUpdateRequest $request, Yayasan $yayasan)
    {
        //cek gambar lama
        $oldLogo        = $yayasan->logo_yayasan;

        // Default data
        $data = [];

        //upload logo_yayasan (cara kedua)
        if ($request->has('logo_yayasan')) {
            # upload with logo_yayasan
            $logo_yayasan = $request->file('logo_yayasan');
            $fileName = 'logo_' . time() . $logo_yayasan->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo_yayasan);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\config\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo_yayasan->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo_yayasan' => $image_data
            ]);
        }

        $yayasan->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldLogo !== $yayasan->logo_yayasan) {
            $this->removeLogo($oldLogo);
        }
        $this->cleanupTempImages();
        //redirect dengan pesan sukses
        return redirect()->back()->with(['success' => 'Logo Berhasil Disimpan!']);
    }

    // Fungsi hapus file di folder livewire-tmp setelah simpan

    protected function cleanupTempImages()
    {
        $tempImages = Storage::files('livewire-tmp');

        foreach ($tempImages as $file) {
            # code...
            Storage::delete($file);
        }
    }

    // Fungsi hapus file di folder livewire-tmp secara automatis
    protected function cleanupOldUploads()
    {
        if (FileUploadConfiguration::isUsingS3()) return;

        $storage = FileUploadConfiguration::storage();

        foreach ($storage->allFiles(FileUploadConfiguration::path()) as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subHours(2)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    // function remove image
    private function removeLogo($oldLogo)
    {
        if (!empty($oldLogo)) {
            $imagePath     = $this->uploadPath . '/' . $oldLogo;
            $ext           = substr(strrchr($oldLogo, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $oldLogo);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    public function export()
    {
        return Excel::download(new YayasanExportfromView, 'yayasan-'.Carbon::now()->timestamp.'.xlsx');
    }

    public function import( Request $request)
    {
        $validated = $request->validate([
            'importfile' => 'required|mimes:xls,xlsx,csv'
        ]);

        $file = $request->file('importfile');
        // dd($request->importfile);

        $nama_file = $file->hashName();

        $destination = $this->uploadPathexcel;

        $path = $file->store($destination);

        // import data
        $import = Excel::import(new YayasanimportCollection(), ('uploads/files/excel/'.$nama_file));

        //remove from server
        File::delete('uploads/files/excel/'.$nama_file);

        return redirect()->route('backend.yayasan.index')->with('success', 'Data berhasil diimport!');
    }
}
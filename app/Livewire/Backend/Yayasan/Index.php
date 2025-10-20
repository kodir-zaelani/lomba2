<?php

namespace App\Livewire\Backend\Yayasan;

use App\Models\Yayasan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Laravolt\Indonesia\Models\City;
use Intervention\Image\ImageManager;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

class Index extends Component
{
    use WithFileUploads;
    public $yayasanid;
    public $nama;
    public $alamat;
    public $rt;
    public $rw;
    public $no_telp;
    public $no_fax;
    public $nama_dusun;
    public $kode_pos;
    public $website;
    public $email;
    public $maps;
    public $lintang;
    public $bujur;
    public $no_pendirian_yayasan;
    public $tgl_pendirian_yayasan;
    public $status_yayasan_update;
    public $province_code;
    public $logo_yayasan;

    public $editId;
    public $namaedit;
    public $alamatedit;
    public $rtedit;
    public $rwedit;
    public $no_telpedit;
    public $no_faxedit;
    public $nama_dusunedit;
    public $kode_posedit;
    public $websiteedit;
    public $emailedit;
    public $mapsedit;
    public $lintangedit;
    public $bujuredit;
    public $no_pendirian_yayasanedit;
    public $tgl_pendirian_yayasanedit;
    public $status_yayasan_updateedit;
    public $maps_update;

    public $provinceCode;
    public $cityCode;
    public $districtCode;
    public $villageCode;

    public $selectedItem;
    public $statusUpdate  = false;

    public $uploadPath= 'uploads/images/logo';

    public function updatedProvinceCode(){
        $this->cityCode = null;
        $this->districtCode = null;
        $this->villageCode = null;
    }

    public function updatedCityCode(){
        $this->districtCode = null;
        $this->villageCode = null;
    }

    public function updatedDistrictCode(){
        $this->villageCode = null;
    }

    public function store()
    {
        $validateData = [
            'nama'    => 'required|min:2|unique:yayasan,nama',
        ];

        // Default data
        $data = [
            'nama'                  => $this->nama,
            'no_pendirian_yayasan'  => $this->no_pendirian_yayasan,
            'tgl_pendirian_yayasan' => $this->tgl_pendirian_yayasan,
            'website'               => $this->website,
            'email'                 => $this->email,
            'rt'                    => $this->rt,
            'rw'                    => $this->rw,
            'alamat'                => $this->alamat,
            'nama_dusun'            => $this->nama_dusun,
            'kode_pos'              => $this->kode_pos,
            'no_telp'               => $this->no_telp,
            'no_fax'                => $this->no_fax,
            'province_code'         => $this->provinceCode,
            'city_code'             => $this->cityCode,
            'district_code'         => $this->districtCode,
            'village_code'          => $this->villageCode,
            'maps'                  => $this->maps,
            'lintang'               => $this->lintang,
            'bujur'                 => $this->bujur,
        ];

        $this->validate($validateData);
        $yayasan = Yayasan::create($data);

        return redirect()->route('backend.yayasan.index')->with('success', 'Data Yayasan berhasil ditambahkan');
    }


    public function edit($yayasanID)
    {
        $this->statusUpdate = true;
        $this->modelId = $yayasanID;

        $model = Yayasan::find($this->modelId);

        $this->editId                  = $model->id;
        $this->namaedit                  = $model->nama;
        $this->alamatedit                = $model->alamat;
        $this->rtedit                    = $model->rt;
        $this->rwedit                    = $model->rw;
        $this->no_telpedit               = $model->no_telp;
        $this->no_faxedit                = $model->no_fax;
        $this->nama_dusunedit            = $model->nama_dusun;
        $this->kode_posedit              = $model->kode_pos;
        $this->websiteedit               = $model->website;
        $this->emailedit                 = $model->email;
        $this->mapsedit                  = $model->maps;
        $this->lintangedit               = $model->lintang;
        $this->bujuredit                 = $model->bujur;
        $this->no_pendirian_yayasanedit  = $model->no_pendirian_yayasan;
        $this->tgl_pendirian_yayasanedit = $model->tgl_pendirian_yayasan;
        $this->province_codeedit         = $model->province_code;
        $this->city_codeedit             = $model->city_code;
        $this->district_codeedit         = $model->district_code;
        $this->village_codeedit          = $model->village_code;

    }

    public function cancelEdit()
    {
        $this->statusUpdate = false;
    }

    public function ubahpeta($editId)
    {
        $yayasanId = $editId;
        $data = [
            'lintang' => $this->lintangedit,
            'bujur'   => $this->bujuredit,
        ];

        if (!empty($this->mapsedit)) {
            $data = array_merge($data, [
                'maps' => $this->mapsedit
            ]);
        }

        if(count($data)) {
            $yayasan = Yayasan::find($yayasanId);
            $yayasan->update($data);
        }

        $this->statusUpdate = false;

        return redirect()->route('backend.yayasan.index')->with('warning', 'Data Peta Yayasan berhasil diperbaharui');


    }
    public function ubahdata($editId)
    {
        $yayasanId = $editId;

        $validateData = [
            'namaedit' => 'required|min:2',
            'no_pendirian_yayasanedit'  => 'required',
            'tgl_pendirian_yayasanedit' => 'required',
            'emailedit'                 => 'required',
            'rtedit'                    => 'required',
            'rwedit'                    => 'required',
            'alamatedit'                => 'required',
            'nama_dusunedit'            => 'required',
            'kode_posedit'              => 'required',
            'no_telpedit'               => 'required',
        ];
        // Default data
        $data = [
            'nama'                  => $this->namaedit,
            'alamat'                => $this->alamatedit,
            'rt'                    => $this->rtedit,
            'rw'                    => $this->rwedit,
            'no_telp'               => $this->no_telpedit,
            'no_fax'                => $this->no_faxedit,
            'nama_dusun'            => $this->nama_dusunedit,
            'kode_pos'              => $this->kode_posedit,
            'website'               => $this->websiteedit,
            'email'                 => $this->emailedit,
            'no_pendirian_yayasan'  => $this->no_pendirian_yayasanedit,
            'tgl_pendirian_yayasan' => $this->tgl_pendirian_yayasanedit,
        ];

        if (!empty($this->provinceCode)) {
            $data = array_merge($data, [
                'province_code' => $this->provinceCode
            ]);
        }
        if (!empty($this->cityCode)) {
            $data = array_merge($data, [
                'city_code' => $this->cityCode
            ]);
        }
        if (!empty($this->districtCode)) {
            $data = array_merge($data, [
                'district_code' => $this->districtCode
            ]);
        }
        if (!empty($this->villageCode)) {
            $data = array_merge($data, [
                'village_code' => $this->villageCode
            ]);
        }

        $this->validate($validateData);

        // dump($data);
        if(count($data)) {
            $yayasan = Yayasan::find($yayasanId);
            $yayasan->update($data);
        }

        $this->cleanVars();

        $this->statusUpdate = false;

        return redirect()->route('backend.yayasan.index')->with('warning', 'Data Yayasan berhasil diperbaharui');



    }

    private function cleanVars()
    {
        // Kosongkan field input
        $this->provinceCode = null;
        $this->cityCode     = null;
        $this->districtCode = null;
        $this->villageCode  = null;
    }


    private function removeImage($oldImage)
    {
        if ( ! empty($oldImage) )
            {
            $imagePath     = $this->uploadPath . '/' . $oldImage;
            $thumbnailPath = $this->uploadPath . '/images_thumb/' . $oldImage;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
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

    public function render()
    {

        return view('livewire.backend.yayasan.index',[
            'yayasan' => Yayasan::where('status_yayasan_update', '1')->first(),
            'dataprovinsi' => Province::orderBy('code', 'asc')->get(),
            'datapcity' => City::where('province_code', $this->provinceCode)->orderBy('code', 'asc')->get(),
            'datadistrict' => District::where('city_code', $this->cityCode)->orderBy('code', 'asc')->get(),
            'datavillage' => Village::where('district_code', $this->districtCode)->orderBy('code', 'asc')->get(),
            'title' => 'Yayasan'
        ]);
    }
}

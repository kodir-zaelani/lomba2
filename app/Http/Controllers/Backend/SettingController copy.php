<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class SettingController extends Controller
{
    protected $uploadPath;
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
            'permission:settings.index|settings.create|settings.edit|settings.delete|settings.trash',
        ];
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting()
    {
        $setting = Setting::where('status_site_update', '1')->first();

        if (!empty($setting)) {
            return redirect()->route('backend.settings.edit', $setting->id);
        } else {
            return view('backend.setting.create', [
                'title' => 'Setting'
            ]);
        }
    }
    public function createsetting()
    {
        return view('backend.setting.create', [
            'title' => 'Create Setting'
        ]);
    }

    public function editsetting(Setting $setting)
    {
        return view('backend.setting.edit', [
            'title' => 'Edit Setting',
            'setting' => $setting,
        ]);
    }

    public function storesetting(SettingStoreRequest $request)
    {

        // Default data
        $data = [
            'webname'            => $request->input('webname'),
            'tagline'            => $request->input('tagline'),
            'description'        => $request->input('description'),
            'status_site_update' => $request->input('status_site_update'),
            'siteurl'            => $request->input('siteurl'),
            'homeurl'            => $request->input('homeurl'),
            'fresh_site'         => $request->input('fresh_site'),
            'phone'              => $request->input('phone'),
            'email'              => $request->input('email'),
            'address'            => $request->input('address'),
            'city'               => $request->input('city'),
            'state'              => $request->input('state'),
            'country'            => $request->input('country'),
            'postalcode'         => $request->input('postalcode'),
            'maps'               => $request->input('maps'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
            'statushero'      => $request->input('statushero'),

        ];

        //upload logo (cara kedua)
        if ($request->has('logo')) {
            # upload with logo
            $logo = $request->file('logo');
            $fileName = 'logo_' . time() . $logo->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo' => $image_data
            ]);
        }

        //upload favicon (cara kedua)
        if ($request->has('favicon')) {
            # upload with favicon
            $favicon = $request->file('favicon');
            $fileName = 'favicon_' . time() . $favicon->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($favicon)->resize(16, 16);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailfavicon.width');
                $height = config('cms.image.thumbnailfavicon.height');
                $extension = $favicon->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'favicon' => $image_data
            ]);
        }

        //upload bg_header (cara kedua)
        if ($request->has('bg_header')) {
            # upload with bg_header
            $bg_header = $request->file('bg_header');
            $fileName = 'bg_header' . time() . $bg_header->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($bg_header);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $bg_header->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'bg_header' => $image_data
            ]);
        }

        if ($request->has('bg_statistic')) {
            # upload with bg_statistic
            $bg_statistic = $request->file('bg_statistic');
            $fileName = 'bg_statistic' . time() . $bg_statistic->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($bg_statistic);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $bg_statistic->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_bg_statistic = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'bg_statistic' => $image_bg_statistic
            ]);
        }

         if ($request->has('logo_menu')) {
            # upload with logo_menu
            $logo_menu = $request->file('logo_menu');
            $fileName = 'logo_menu' . time() . $logo_menu->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo_menu);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo_menu->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_logo_menu = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo_menu' => $image_logo_menu
            ]);
        }

        $setting = Setting::create($data);

        if ($setting) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.settings')->with(['success' => 'Data Setting Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.settings')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function updatesetting(SettingUpdateRequest $request, Setting $setting)
    {
        //cek gambar lama
        $oldLogo        = $setting->logo;
        $oldFavicon     = $setting->favicon;
        $oldBgheader    = $setting->bg_header;
        $oldBgstatistic = $setting->bg_statistic;
        $oldLogomenu    = $setting->logo_menu;
        $oldimagehero    = $setting->imagehero;
        // Default data
        $data = [
            'webname'            => $request->input('webname'),
            'tagline'            => $request->input('tagline'),
            'description'     => $request->input('description'),
            'status_site_update' => $request->input('status_site_update'),
            'siteurl'            => $request->input('siteurl'),
            'homeurl'            => $request->input('homeurl'),
            'fresh_site'         => $request->input('fresh_site'),
            'phone'              => $request->input('phone'),
            'email'              => $request->input('email'),
            'address'            => $request->input('address'),
            'city'               => $request->input('city'),
            'state'              => $request->input('state'),
            'country'            => $request->input('country'),
            'postalcode'         => $request->input('postalcode'),
            'maps'               => $request->input('maps'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
            'statushero'      => $request->input('statushero'),
        ];


        //upload logo (cara kedua)
        if ($request->has('logo')) {
            # upload with logo
            $logo = $request->file('logo');
            $fileName = 'logo_' . time() . $logo->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($logo);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo' => $image_data
            ]);
        }

        if ($request->has('favicon')) {
            # upload with favicon
            $favicon = $request->file('favicon');
            $fileName = 'favicon_' . time() . $favicon->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($favicon)->resize(16, 16);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $favicon->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_favicon = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'favicon' => $image_favicon
            ]);
        }

        //upload bg_header (cara kedua)
        if ($request->has('bg_header')) {
            # upload with bg_header
            $bg_header = $request->file('bg_header');
            $fileName = 'bg_header' . time() . $bg_header->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($bg_header);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $bg_header->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'bg_header' => $image_data
            ]);
        }

        if ($request->has('bg_statistic')) {
            # upload with bg_statistic
            $bg_statistic = $request->file('bg_statistic');
            $fileName = 'bg_statistic' . time() . $bg_statistic->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = Image::read($bg_statistic);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $bg_statistic->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_bg_statistic = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'bg_statistic' => $image_bg_statistic
            ]);
        }
        if ($request->has('logo_menu')) {
            # upload with logo_menu
            $logo_menu = $request->file('logo_menu');
            $fileName = 'logo_menu' . time() . $logo_menu->getClientOriginalName();
            $destination = $this->uploadPath;

            // $manager = new ImageManager();
            // $successUploaded = $manager->read($destination . $fileName, 80);

            $successUploaded = Image::read($logo_menu);
            $successUploaded->save($destination . $fileName, 80);

            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnaillogo.width');
                $height = config('cms.image.thumbnaillogo.height');
                $extension = $logo_menu->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::read($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_logo_menu = $fileName;
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo_menu' => $image_logo_menu
            ]);
        }

        $setting->update($data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldLogo !== $setting->logo) {
            $this->removeLogo($oldLogo);
        }
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldFavicon !== $setting->favicon) {
            $this->removeFavicon($oldFavicon);
        }
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldBgheader !== $setting->bg_header) {
            $this->removeBgheader($oldBgheader);
        }
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldBgstatistic !== $setting->bg_statistic) {
            $this->removeBgstatistic($oldBgstatistic);
        }
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldLogomenu !== $setting->logo_menu) {
            $this->removeLogomenu($oldLogomenu);
        }
        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldimagehero !== $setting->imagehero) {
            $this->removeImagehero($oldimagehero);
        }
        //redirect dengan pesan sukses
        return redirect()->back()->with(['success' => 'Data Setting Berhasil Disimpan!']);
    }

    // function remove image
    private function removeLogo($logo)
    {
        if (!empty($logo)) {
            $imagePath     = $this->uploadPath . '/' . $logo;
            $ext           = substr(strrchr($logo, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $logo);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
    // function remove image
    private function removeFavicon($favicon)
    {
        if (!empty($favicon)) {
            $imagePath     = $this->uploadPath . '/' . $favicon;
            $ext           = substr(strrchr($favicon, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $favicon);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
    // function remove image
    private function removeBgheader($bg_header)
    {
        if (!empty($bg_header)) {
            $imagePath     = $this->uploadPath . '/' . $bg_header;
            $ext           = substr(strrchr($bg_header, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $bg_header);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    // function remove image
    private function removeBgstatistic($bg_statistic)
    {
        if (!empty($bg_statistic)) {
            $imagePath     = $this->uploadPath . '/' . $bg_statistic;
            $ext           = substr(strrchr($bg_statistic, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $bg_statistic);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
    // function remove image
    private function removeLogomenu($logo_menu)
    {
        if (!empty($logo_menu)) {
            $imagePath     = $this->uploadPath . '/' . $logo_menu;
            $ext           = substr(strrchr($logo_menu, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $logo_menu);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
    // function remove image
    private function removeImagehero($imagehero)
    {
        if (!empty($imagehero)) {
            $imagePath     = $this->uploadPath . '/' . $imagehero;
            $ext           = substr(strrchr($imagehero, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $imagehero);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}

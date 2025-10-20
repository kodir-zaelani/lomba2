<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Yayasan extends Model
{
    use HasFactory, HasUuids;
    use SoftDeletes;

    protected $table        = 'yayasan';
    protected $primaryKey   = 'id';
    protected $guarded      = [];

    public function getLogoyayasanUrlAttribute($value)
    {
        $logoyayasanUrl = "";

        if (!is_null($this->logo_yayasan)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->logo_yayasan;
            if (file_exists($imagePath)) $logoyayasanUrl = asset("/{$directory}" . $this->logo_yayasan);
        }

        return $logoyayasanUrl;
    }

    public function getLogoyayasanThumbUrlAttribute($value)
    {
        $logoyayasanThumbUrl = "";

        if (!is_null($this->logo_yayasan)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->logo_yayasan, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->logo_yayasan);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $logoyayasanThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $logoyayasanThumbUrl;
    }

    public function province()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\City', 'city_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\District', 'district_code', 'code');
    }

    public function village()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Village', 'village_code', 'code');
    }

    public function generateSlug($nama)
    {
        return Str::slug($nama);
    }

    // Set slug auto with nama dengan muttator
    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = $this->generateSlug($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory, HasUuids;

    protected $table        = 'sekolah';
    protected $primaryKey   = 'id';
    protected $guarded      = [];


     public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term);
        });
    }
    public function getLogosekolahUrlAttribute($value)
    {
        $logosekolahUrl = "";

        if (!is_null($this->logo_sekolah)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->logo_sekolah;
            if (file_exists($imagePath)) $logosekolahUrl = asset("/{$directory}" . $this->logo_sekolah);
        }

        return $logosekolahUrl;
    }

    public function getLogosekolahThumbUrlAttribute($value)
    {
        $logosekolahThumbUrl = "";

        if (!is_null($this->logo_sekolah)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->logo_sekolah, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->logo_sekolah);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $logosekolahThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $logosekolahThumbUrl;
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

    /**
     * Get all of the jenistagihans for the Tahunajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenistagihans(): HasMany
    {
        return $this->hasMany(Jenistagihan::class);
    }
    /**
     * Get all of the spbinaans for the Tahunajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spbinaans(): HasMany
    {
        return $this->hasMany(Spbinaan::class, 'sekolah_id');
    }
}
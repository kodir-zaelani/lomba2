<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HasUuids;

    protected $table        = 'settings';
    protected $primaryKey   = 'id';
    protected $guarded      = [];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if (!is_null($this->logo)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->logo;
            if (file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->logo);
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";

        if (!is_null($this->logo)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->logo, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->logo);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $imageThumbUrl;
    }
    public function getFaviconUrlAttribute($value)
    {
        $faviconUrl = "";

        if (!is_null($this->favicon)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->favicon;
            if (file_exists($imagePath)) $faviconUrl = asset("/{$directory}" . $this->favicon);
        }

        return $faviconUrl;
    }
    public function getBgheaderUrlAttribute($value)
    {
        $bg_headerUrl = "";

        if (!is_null($this->bg_header)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->bg_header;
            if (file_exists($imagePath)) $bg_headerUrl = asset("/{$directory}" . $this->bg_header);
        }

        return $bg_headerUrl;
    }
    public function getBgstatisticUrlAttribute($value)
    {
        $bg_statisticUrl = "";

        if (!is_null($this->bg_statistic)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->bg_statistic;
            if (file_exists($imagePath)) $bg_statisticUrl = asset("/{$directory}" . $this->bg_statistic);
        }

        return $bg_statisticUrl;
    }
    public function getLogomenuUrlAttribute($value)
    {
        $logo_menuUrl = "";

        if (!is_null($this->logo_menu)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() . "/{$directory}" . $this->logo_menu;
            if (file_exists($imagePath)) $logo_menuUrl = asset("/{$directory}" . $this->logo_menu);
        }

        return $logo_menuUrl;
    }

    public function getFaviconThumbUrlAttribute($value)
    {
        $faviconThumbUrl = "";

        if (!is_null($this->favicon)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->favicon, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->favicon);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $faviconThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $faviconThumbUrl;
    }

    public function getBgheaderThumbUrlAttribute($value)
    {
        $bg_headerThumbUrl = "";

        if (!is_null($this->bg_header)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->bg_header, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->bg_header);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $bg_headerThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $bg_headerThumbUrl;
    }

    public function getBgstatisticThumbUrlAttribute($value)
    {
        $bg_statisticThumbUrl = "";

        if (!is_null($this->bg_statistic)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->bg_statistic, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->bg_statistic);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $bg_statisticThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $bg_statisticThumbUrl;
    }
    public function getLogomenuThumbUrlAttribute($value)
    {
        $logo_menuThumbUrl = "";

        if (!is_null($this->logo_menu)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->logo_menu, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->logo_menu);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $logo_menuThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $logo_menuThumbUrl;
    }
}
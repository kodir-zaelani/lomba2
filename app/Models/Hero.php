<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hero extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey   = 'id';
    protected $guarded      = [];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('title', 'like', $term);
        });
    }

    // fungsi scope untuk manampilkan yang status publish
    public function scopePublished($query)
    {
        return $query->where("status", "=", 1);
    }

    public function getImageheroUrlAttribute($value)
    {
        $imageheroUrl = "";

        if (!is_null($this->imagehero)) {
            $directory = config('cms.image.directoryHero');
            $imagePath = public_path() . "/{$directory}" . $this->imagehero;
            if (file_exists($imagePath)) $imageheroUrl = asset("/{$directory}" . $this->imagehero);
        }

        return $imageheroUrl;
    }

    public function getImageheroThumbUrlAttribute($value)
    {
        $imageheroThumbUrl = "";

        if (!is_null($this->imagehero)) {
            $directory = config('cms.image.directoryHero');
            $ext       = substr(strrchr($this->imagehero, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->imagehero);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $imageheroThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $imageheroThumbUrl;
    }

    public function getStatusLabelAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-primary">Inactive</span>';
        }
        return '<span class="badge badge-success">Active</span>';
    }

    public function getStatusTextAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="ml-2 fw-bold">Inactive</span>';
        }
        return '<span class="fw-bold">Active</span>';
    }
}
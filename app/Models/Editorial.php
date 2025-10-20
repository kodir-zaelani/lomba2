<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Editorial extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey   = 'id';
    protected $guarded      = [];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('title', 'like', $term)
            ->orWhere('content', 'like', $term);
        });
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryEditorials');
            $imagePath = public_path() ."/{$directory}" . $this->image;
            if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryEditorials');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() ."/{$directory}" . $thumbnail;
            if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $imageThumbUrl;
    }

    public function getImageWatermarkUrlAttribute($value)
    {
        $imageWatermarkUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryEditorials');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $watermark = str_replace(".{$ext}", "_watermark.{$ext}", $this->image);
            $imagePath = public_path() ."/{$directory}" . $watermark;
            if(file_exists($imagePath)) $imageWatermarkUrl = asset("/$directory" . $watermark);
        }

        return $imageWatermarkUrl;
    }


    public function getStatusLabelAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-primary">Draft</span>';
        }
        return '<span class="badge badge-success">Published</span>';

    }
    /**
    * Get the user that owns the Greeting
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    //change default date view
    public function getCreatedAtAttribute($createdAt)
    {
        // return Carbon::parse($createdAt)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->diffForHumans();
    }
    //change default date view
    public function getUpdatedAtAttribute($updateddAt)
    {
        // return Carbon::parse($updateddAt)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
        ->diffForHumans();
    }
    //change default date view
    public function getPublhisedAtAttribute($updateddAt)
    {
        // return Carbon::parse($updateddAt)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['published_at'])
        ->diffForHumans();
    }

     // fungsi scope untuk manampilkan yang status publish
    public function scopePublish($query)
    {
        return $query->where("published_at", "<=",  date('Y-m-d'));
    }
    // fungsi scope untuk manampilkan yang status publish
    public function scopePublished($query)
    {
        return $query->where("status", "=", 1);
    }

    // fungsi scope untuk manampilkan yang status publish
    public function scopePublishedate($query)
    {
        return $query->where("published_at", "<=",  date('Y-m-d'));
    }
}

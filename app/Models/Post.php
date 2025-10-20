<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $table         = 'posts';
    protected $primaryKey    = 'id';
    protected $guarded       = [];
    protected $dateFormat    = 'Y-m-d H:i:s';
    protected $createdAt     = ['created_at'];
    protected $updatedAt     = ['updated_at'];
    protected $Datepublished = ['published_at'];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($q) use ($term) {
            $q->whereHas('author', function ($qr) use ($term) {
                $qr->where('name', 'LIKE', $term);
            });
            $q->orWhereHas('postcategory', function ($qr) use ($term) {
                $qr->where('title', 'LIKE', $term);
            });
            $q->orWhereHas('tags', function ($qr) use ($term) {
                $qr->where('title', 'LIKE', $term);
            });
            $q->orWhereRaw('LOWER(title) LIKE ?', [$term]);
            $q->orWhereRaw('LOWER(content) LIKE ?', [$term]);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function postcategory()
    {
        return $this->belongsTo(Postcategory::class, 'postcategory_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagsHtmlAttribute()
    {
        $anchors = [];
        foreach ($this->tags as $tag) {
            // $anchors[] = '<a href="#">' . $tag->title . '</a>';
            // $anchors[] = '<span ><a href="' .route('post.tag', $tag->slug) . '" > ' . $tag->title . '</a></span>';
            $anchors[] = '<small><span>' . $tag->title . '</span></small>';
        }
        return implode(", ", $anchors);
    }

    public function getTagsHtmlbackAttribute()
    {
        $anchors = [];
        foreach ($this->tags as $tag) {
            $anchors[] = '<small><span><a href="' . route('post.tag', $tag->slug) . '" > ' . $tag->title . '</a></span></small>';
        }
        return implode(", ", $anchors);
    }


    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
            $imagePath = public_path() . "/{$directory}" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() . "/{$directory}" . $thumbnail;
            if (file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }

        return $imageThumbUrl;
    }

    public function getImageWatermarkUrlAttribute($value)
    {
        $imageWatermarkUrl = "";

        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
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

    // fungsi scope untuk manampilkan yang status headline
    public function scopeHeadline($query)
    {
        return $query->where("headline", "=", 1);
    }
    // fungsi scope untuk manampilkan yang status selection
    public function scopeSelection($query)
    {
        return $query->where("selection", "=", 1);
    }
    // fungsi scope untuk manampilkan yang status selection
    public function scopeBlog($query)
    {
        return $query->where("statuspost", "=", 1);
    }
    // fungsi scope untuk manampilkan yang status selection
    public function scopeNews($query)
    {
        return $query->where("statuspost", "=", 0);
    }
    // fungsi scope untuk manampilkan yang status Comment
    public function scopeCommentstatus($query)
    {
        return $query->where("comment_status", "=", 1);
    }

    // fungsi scope untuk manampilkan yang status publish
    public function scopePublishedate($query)
    {
        return $query->where("published_at", "<=",  date('Y-m-d'));
    }

    // fungsi  untuk manampilkan yang tanggal diffForHumans publish
    public function getDatepublishedAttribute($value)
    {
        // return $this->published_at->diffForHumans(); // laravel below 9
        return is_null($this->published_at) ? '' : Carbon::parse($this->published_at)->diffForHumans(); // laravel 10 or latest
    }

    public function scopePublished($query)
    {
        return $query->where("status", "=", 1);
    }

    // fungsi scope untuk manampilkan yang status publish
    public function scopeDraft($query)
    {
        return $query->where("status", "=", 0);
    }
    // fungsi scope untuk manampilkan yang status pilihan
    public function scopeFeatured($query)
    {
        return $query->where("selection", "=", 0);
    }

    // fungsi scope untuk mengurutkan tulisan popular
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public static function archives()
    {
        if (env('DB_CONNECTION') == 'pgsql') {
            return static::selectRaw('count(id) as post_count, extract(year from published_at) as year, extract(month from published_at) as month')
                ->published()
                ->groupBy('year', 'month')
                ->orderByRaw('min(published_at) desc')
                ->get();
        } else {
            return static::selectRaw('count(id) as post_count, year(published_at) year, month(published_at) month')
                ->published()
                ->groupBy('year', 'month')
                ->orderByRaw('min(published_at) desc')
                ->get();
        }
    }
}

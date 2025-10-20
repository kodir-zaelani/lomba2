<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dukungan extends Model
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

      public function getPublhisedAtAttribute($updateddAt)
    {
        // return Carbon::parse($updateddAt)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['published_at'])
        ->diffForHumans();
    }
}

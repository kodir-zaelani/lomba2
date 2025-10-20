<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matapelajaran extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'matapelajaran';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenisuratpermohonan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'jenisuratpermohonan';
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
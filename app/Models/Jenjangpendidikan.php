<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenjangpendidikan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table      = 'jenjangpendidikan';
    protected $guarded    = [];
    protected $primaryKey = 'id';

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term);
        });
    }

    public function tingkatpendidikan()
    {
        return $this->hasMany(Tingkatpendidikan::class, 'jenjangpendidikan_id');
    }
    public function spbinaans()
    {
        return $this->hasMany(Spbinaan::class, 'jenjangpendidikan_id');
    }
}

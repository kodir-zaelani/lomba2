<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tingkatpendidikan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table      = 'tingkatpendidikan';
    protected $guarded    = [];
    protected $primaryKey = 'id';

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term);
        });
    }
    /**
     * Get the user that owns the Tingkatpendidikan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenjangpendidikan(): BelongsTo
    {
        return $this->belongsTo(Jenjangpendidikan::class, 'jenjangpendidikan_id');
    }


}

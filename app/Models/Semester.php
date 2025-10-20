<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table      = 'semester';
    protected $guarded    = [];
    protected $primaryKey = 'id';

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term);
        });
    }

    public function getPeriodeAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->periode_aktif == 1) {
        return '<span class="badge badge-success">Aktif</span>';
        }
    }
    public function getPeriodefAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->periode_aktif == 1) {
        return 'Aktif';
        }
    }

    /**
     * Get the tahunajaran that owns the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahunajaran(): BelongsTo
    {
        return $this->belongsTo(Tahunajaran::class);
    }
}

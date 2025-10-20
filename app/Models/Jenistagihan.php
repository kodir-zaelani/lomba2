<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenistagihan extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table        = 'jenistagihan';
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
     * Get the tahunajaran that owns the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahunajaran(): BelongsTo
    {
        return $this->belongsTo(Tahunajaran::class);
    }

    /**
     * Get the tahunajaran that owns the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function getPeriodikLabelAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->periodik == 0) {
            return '<span class="badge badge-primary">Tidak</span>';
        }
        return '<span class="badge badge-success">Ya</span>';
    }

    public function getJenisperiodikTextAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->jenis_periodik == 'bulan') {
            return '<span class="fw-bold">Bulan</span>';
        }
        return '<span class="fw-bold">Tahun Ajaran</span>';
    }
}

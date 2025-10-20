<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spbinaan extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey   = 'id';
    protected $guarded      = [];


      public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($q) use ($term) {
            $q->whereHas('sekolah', function ($qr) use ($term) {
                $qr->where('nama', 'LIKE', $term);
            });
            $q->orWhereHas('dukungan', function ($qr) use ($term) {
                $qr->where('title', 'LIKE', $term);
            });
            $q->orWhereHas('jenjangpendidikan', function ($qr) use ($term) {
                $qr->where('nama', 'LIKE', $term);
            });
            $q->orWhereRaw('LOWER(strategi) LIKE ?', [$term]);
            $q->orWhereRaw('LOWER(program_kerja) LIKE ?', [$term]);
            $q->orWhereRaw('LOWER(lingkup_pembahasan) LIKE ?', [$term]);
        });
    }

    /**
     * Get the sekolah that owns the Spbinaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    /**
     * Get the jenjangpendidikan that owns the Spbinaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenjangpendidikan(): BelongsTo
    {
        return $this->belongsTo(Jenjangpendidikan::class, 'jenjangpendidikan_id');
    }

    /**
     * Get the Dukungan that owns the Spbinaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dukungan(): BelongsTo
    {
        return $this->belongsTo(Dukungan::class, 'dukungan_id');
    }

    public function getStatusLabelAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-primary">Draft</span>';
        }
        return '<span class="badge badge-success">Published</span>';
    }
}
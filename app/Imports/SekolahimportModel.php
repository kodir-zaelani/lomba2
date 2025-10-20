<?php

namespace App\Imports;

use App\Models\Sekolah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SekolahimportModel implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 6;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //  $valueD1 = $rows[0][3]; // Row 1 (index 0), Column D (index 3)
        // $valueD2 = $rows[1][3];

        return new Sekolah([
            'nama' => 'SD Islamic',
            'npsn' => $row[11],
        ]);
    }
}

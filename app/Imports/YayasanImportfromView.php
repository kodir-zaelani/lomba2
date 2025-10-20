<?php

namespace App\Imports;

use App\Models\Yayasan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class YayasanImportfromView implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Yayasan([
            'nama'                   => $row[0],
            'no_pendirian_yayasan'   => $row[1],
            'tgl_pendirian_yayasan'  => $row[2],
            'nomor_pengesahan_pn_ln' => $row[3],
            'nomor_sk_bn'            => $row[4],
            'tanggal_sk_bn'          => $row[5],
            'no_telp'                => $row[6],
            'no_fax'                 => $row[7],
            'email'                  => $row[8],
            'website'                => $row[9],
            'alamat'                 => $row[10],
            'rt'                     => $row[11],
            'rw'                     => $row[12],
            'nama_dusun'             => $row[13],
            // 'province_code'          => $row[14],
            // 'city_code'              => $row[15],
            // 'district_code'          => $row[16],
            // 'village_code'           => $row[17],
            'kode_pos'               => $row[18],
            'lintang'                => $row[19],
            'bujur'                  => $row[20],
            'maps'                   => $row[21],
            'logo_yayasan'           => $row[22],
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
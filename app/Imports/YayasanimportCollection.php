<?php

namespace App\Imports;

use App\Models\Yayasan;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class YayasanimportCollection implements ToCollection, WithStartRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
    public function collection(Collection $rows)
    {
        HeadingRowFormatter::default('none');

        foreach ($rows as $row)
            {
            $province = Province::where('name', $row[14])->first();
            $city     = City::where('name', $row[15])->first();
            $district = District::where('name', $row[16])->first();
            $village  = Village::where('name', $row[17])->first();

            if ($province != null) {
                if ($city != null) {
                    if ($district != null) {
                        if ($village != null) {
                            Yayasan::create([
                                'nama'                   => $row[0],
                                'slug'                   => Str::slug($row[0]),
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
                                'province_code'          => $province['code'],
                                'city_code'              => $city['code'],
                                'district_code'          => $district['code'],
                                'village_code'           => $village['code'],
                                'kode_pos'               => $row[18],
                                'lintang'                => $row[19],
                                'bujur'                  => $row[20],
                                'maps'                   => $row[21],
                                'logo_yayasan'           => $row[22],
                            ]);
                        }
                    }
                }
            }

        }
    }


    public function startRow(): int
    {
        return 3;
    }
}
<?php

namespace App\Imports;

use App\Models\Yayasan;
use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class _YayasanimportCollection implements ToCollection, WithHeadingRow, WithStartRow
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
            $province = Province::where('name', $row['Provinsi'])->first();
            $city     = City::where('name', $row['Kab./Kota'])->first();
            $district = District::where('name', $row['Kecamatan'])->first();
            $village  = Village::where('name', $row['Desa/Kel.'])->first();

            if ($province != null) {
                if ($city != null) {
                    if ($district != null) {
                        if ($village != null) {
                            Yayasan::create([
                                'nama'                   => $row['Nama'],
                                'no_pendirian_yayasan'   => $row['No Akta Pendirian'],
                                'tgl_pendirian_yayasan'  => $row['Tanggal Pendirian'],
                                'nomor_pengesahan_pn_ln' => $row['No. Pengesahan'],
                                'nomor_sk_bn'            => $row['No. SK Bn'],
                                'tanggal_sk_bn'          => $row['Tanggal SK Bn'],
                                'no_telp'                => $row['Telepon/HP'],
                                'no_fax'                 => $row['Fax'],
                                'email'                  => $row['Email'],
                                'website'                => $row['Website'],
                                'alamat'                 => $row['Alamat'],
                                'rt'                     => $row['RT'],
                                'rw'                     => $row['RW'],
                                'nama_dusun'             => $row['Nama Dusun'],
                                'province_code'          => $province['code'],
                                'city_code'              => $city['code'],
                                'district_code'          => $district['code'],
                                'village_code'           => $village['code'],
                                'kode_pos'               => $row['Kode Pos'],
                                'lintang'                => $row['Lintang'],
                                'bujur'                  => $row['Bujur'],
                                'maps'                   => $row['Peta'],
                                'logo_yayasan'           => $row['Logo'],
                            ]);
                        }
                    }
                }
            }

        }
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function startRow(): int
    {
        return 3;
    }
}
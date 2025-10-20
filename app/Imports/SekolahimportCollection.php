<?php

namespace App\Imports;

use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class SekolahimportCollection implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }
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
                            Sekolah::create([
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

                                'nama'=> $row[0],
                                'npsn'=> $row[0],
                                'bentukpendidikan_id'=> $row[0],
                                'status_sekolah'=> $row[0],
                                'alamat'=> $row[0],
                                'rt'=> $row[0],
                                'rw'=> $row[0],
                                'kode_pos'=> $row[0],
                                'village_code'=> $row[0],
                                'district_code'=> $row[0],
                                'city_code'=> $row[0],
                                'province_code'=> $row[0],
                                'negara_id'=> $row[0],
                                'sk_pendirian_sekolah'=> $row[0],
                                'tanggal_pendirian_sekolah'=> $row[0],
                                'statuskepemilikan_id'=> $row[0],
                                'sk_izin_operasional'=> $row[0],
                                'tanggal_izin_operasional'=> $row[0],
                                'yayasan_id'=> $row[0],
                                'no_rekening'=> $row[0],
                                'type_sekolah'=> $row[0],
                                'bank_id'=> $row[0],
                                'cabang_kcp_unit'=> $row[0],
                                'npwp'=> $row[0],
                                'nama_npwp'=> $row[0],
                                'nama_dusun'=> $row[0],
                                'lintang'=> $row[0],
                                'bujur'=> $row[0],
                                'no_telp'=> $row[0],
                                'no_fax'=> $row[0],
                                'website'=> $row[0],
                                'email'=> $row[0],
                                'logo_sekolah'=> $row[0],
                                'status_sekolah_update'=> $row[0],
                            ]);
                        }
                    }
                }
            }
        }
    }
}

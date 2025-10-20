<?php

namespace Database\Seeders;

use App\Models\Jenisptk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JenisPtkSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $json = File::get('database/data_json/jenis_ptk.json');
        $data = json_decode($json);
        foreach($data as $obj){
            Jenisptk::create([
                'jenis_ptk_id'    => $obj->id,
                'jenis_ptk'       => $obj->jenis_ptk,
                'guru_kelas'      => $obj->guru_kelas,
                'guru_matpel'     => $obj->guru_matpel,
                'guru_bk'         => $obj->guru_bk,
                'guru_inklusi'    => $obj->guru_inklusi,
                'pengawas_satdik' => $obj->pengawas_satdik,
                'pengawas_plb'    => $obj->pengawas_plb,
                'pengawas_matpel' => $obj->pengawas_matpel,
                'pengawas_bidang' => $obj->pengawas_bidang,
                'tas'             => $obj->tas,
                'formal'          => $obj->formal,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}

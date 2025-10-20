<?php

namespace Database\Seeders;

use App\Models\Negara;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $json = File::get('database/data_json/negara.json');
        $data = json_decode($json);

        foreach($data as $obj){
            Negara::create([
                'negara_id'   => $obj->negara_id,
                'nama'        => $obj->nama,
                'luar_negeri' => $obj->luar_negeri,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}

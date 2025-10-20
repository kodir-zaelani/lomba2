<?php

namespace App\Exports;

use App\Models\Yayasan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YayasanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Yayasan::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'No pendirian' ,
            'Tanggal pendirian',
            'No. Pengesahan',
            'No. SK Bn',
            'Tanggal SK Bn',
            'Telepon/HP',
            'Fax',
            'Wmail',
            'Website',
            'Alamat',
            'RT',
            'RW',
            'Nama Dusun',
            'Provinsi',
            'Kab./Kota',
            'Kecamatan',
            'Desa/Kel.',
            'Kode Pos',
            'Lintang',
            'Bujur',
            'Peta',
            'Logo',
            'Status Update',
            'Dibuat',
            'Update',
            'Delete',
        ];
    }
}
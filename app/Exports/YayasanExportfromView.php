<?php

namespace App\Exports;

use App\Models\Yayasan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class YayasanExportfromView implements FromView, ShouldAutoSize, WithStyles, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('backend.yayasan.export',[
            'yayasan' => Yayasan::where('status_yayasan_update', '1')->first(),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A2:W2')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'rotation' => 0,
            'color' => ['rgb' => 'E3DDE1'] //Latar belakang Abu-abu
        ]);

        $sheet->mergeCells('A1:W1');

        // cara 1 memberi border
        // $sheet->getStyle('A2:W3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],

            // Center text in a range of cells (e.g., C2 to C100)
            'A1:W1' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            // Cara 2 memberi border Style untuk seluruh range A2:W3
            'A2:W3' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ],
        ];
    }

    // Nama Sheet
    public function title(): string
    {
        return 'Yayasan';
    }

}
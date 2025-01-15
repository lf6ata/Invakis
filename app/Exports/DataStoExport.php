<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataStoExport implements FromView, WithStyles, WithEvents, ShouldAutoSize
{
    protected $sto_export;

    public function __construct($sto_export)
    {
        $this->sto_export = $sto_export;
    }

    public function view(): View
    {
        return view('exports.sto', [
            'sto_export' => $this->sto_export
        ]);
    }

    // Menambahkan styling ke worksheet
    public function styles(Worksheet $sheet)
    {
        // Set font untuk judul (header) di baris pertama
        return [
            1   => ['font' => ['bold' => true, 'size' => 16]], // Header style
            'A'  => ['font' => ['bold' => true]],                // Seluruh kolom A di-bold
        ];
    }


    // Tambahkan event untuk styling lebih lanjut
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ambil range terakhir berdasarkan data
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $range = 'A1:' . $highestColumn . $highestRow;

                // Set manual width untuk kolom A dan B
                // $sheet->getColumnDimension('A')->setWidth(50); // Set lebar kolom A menjadi 20
                // $sheet->getColumnDimension('1')->setWidth(50); // Set lebar kolom A menjadi 20

                // Mengatur tinggi baris
                $sheet->getRowDimension(1)->setRowHeight(30); // Baris 1 (header) tinggi 30
                // $sheet->getRowDimension(2)->setRowHeight(25); // Baris 2 tinggi 25

                // Mengatur alignment di seluruh tabel
                $sheet->getStyle('A1', 'A3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Teks rata tengah
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,   // Teks rata tengah vertikal
                    ],
                ]);

                // // Mengatur alignment pada kolom A
                // $sheet->getStyle('A1:A10')->applyFromArray([
                //     'alignment' => [
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Teks rata kiri
                //     ],
                // ]);

                // Terapkan border ke seluruh data
                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Warna border hitam
                        ],
                    ],
                ]);

                // Terapkan styling di header 
                $sheet->getStyle('A1:' . $highestColumn . '2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4e73df'], // Color Background 
                    ],
                ]);
            },
        ];
    }
}

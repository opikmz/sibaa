<?php

namespace App\Exports;

use App\Models\TransaksiM;
use App\Models\ProgramM;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenghimpunanProgramExport implements FromCollection, WithHeadings, WithCustomStartCell, WithEvents
{
    protected $programId;
    protected $program;

    public function __construct($programId)
    {
        $this->programId = $programId;
        $this->program = ProgramM::findOrFail($programId);
    }

    public function collection()
    {
        return TransaksiM::with('muzaki')
            ->where('program_id', $this->programId)
            ->get()
            ->map(function ($item) {
                return [
                    'Tanggal' => $item->created_at
                        ? $item->created_at->format('d/m/Y')
                        : '-',

                    'Nama Muzaki' => $item->muzaki->nama ?? '-',
                    'Nomor Transaksi' => $item->nomor_transaksi,
                    'Nominal' => $item->nominal,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Muzaki',
            'Nomor Transaksi',
            'Nominal',
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Judul laporan
                $sheet->setCellValue(
                    'A1',
                    'PENGHIMPUNAN ' . strtoupper($this->program->program)
                );

                // Gabungkan sel judul
                $sheet->mergeCells('A1:D1');

                // Format judul
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(30);

                // Format header tabel pada baris 3
                $sheet->getStyle('A3:D3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF',
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '4E73DF',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Lebar kolom
                $sheet->getColumnDimension('A')->setWidth(15);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(20);

                // Format nominal menjadi angka dengan pemisah ribuan
                $lastRow = $sheet->getHighestRow();

                if ($lastRow >= 4) {
                    $sheet->getStyle("D4:D{$lastRow}")
                        ->getNumberFormat()
                        ->setFormatCode('#,##0.00');
                }
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\TransaksiM;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenghimpunanBulananExport implements
    FromCollection,
    WithHeadings,
    WithCustomStartCell,
    WithEvents
{
    protected $bulan;
    protected $tahun;
    protected $namaBulan;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = (int) $bulan;
        $this->tahun = (int) $tahun;

        $this->namaBulan = Carbon::create(
            $this->tahun,
            $this->bulan,
            1
        )->locale('id')->translatedFormat('F');
    }

    public function collection()
    {
        $awalBulan = Carbon::create(
            $this->tahun,
            $this->bulan,
            1
        )->startOfMonth();

        $akhirBulan = $awalBulan->copy()->endOfMonth();

        return TransaksiM::with('muzaki')
            ->whereBetween('created_at', [
                $awalBulan,
                $akhirBulan
            ])
            ->orderBy('created_at')
            ->get()
            ->map(function ($item) {
                return [
                    $item->created_at->format('d/m/Y'),
                    $item->muzaki->nama ?? '-',
                    $item->nomor_transaksi,
                    $item->nominal,
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

                $sheet->setCellValue(
                    'A1',
                    'PENGHIMPUNAN BULANAN ' .
                    strtoupper($this->namaBulan) . ' ' .
                    $this->tahun
                );

                $sheet->mergeCells('A1:D1');

                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A3:D3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' =>
                            \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '198754'],
                    ],
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->getColumnDimension('A')->setWidth(18);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(20);

                $lastRow = $sheet->getHighestRow();

                if ($lastRow >= 4) {
                    $sheet->getStyle("D4:D{$lastRow}")
                        ->getNumberFormat()
                        ->setFormatCode('#,##0.00');
                }

                $sheet->getRowDimension(1)->setRowHeight(30);
            },
        ];
    }
}

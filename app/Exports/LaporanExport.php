<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnFormatting,
    ShouldAutoSize,
    WithCustomStartCell
{
    protected $laporan;
    protected $periode;

    public function __construct($laporan, $periode)
    {
        $this->laporan = $laporan;
        $this->periode = $periode;
    }

    /**
     * Mulai tabel dari baris ke-4
     */
    public function startCell(): string
    {
        return 'A4';
    }

    /**
     * DATA EXCEL
     */
    public function collection()
    {
        return $this->laporan->map(function ($row) {

            if ($this->periode === 'bulanan') {
                $periode = date('F', mktime(0, 0, 0, $row->bulan, 1)) . ' ' . $row->tahun;
            } elseif ($this->periode === 'tahunan') {
                $periode = $row->periode;
            } else {
                $periode = $row->periode;
            }

            return [
                $periode,
                $row->jumlah_check_in,
                $row->total_transaksi,
            ];
        });
    }

    /**
     * HEADER TABEL
     */
    public function headings(): array
    {
        return [
            'Periode',
            'Jumlah Check In',
            'Total Transaksi (Rp)',
        ];
    }

    /**
     * STYLE EXCEL
     */
    public function styles(Worksheet $sheet)
    {
        /* =======================
           JUDUL LAPORAN
        ======================== */
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'LAPORAN PENDAPATAN HOTELIER');

        $sheet->mergeCells('A2:C2');
        $sheet->setCellValue(
            'A2',
            'Periode : ' . ucfirst($this->periode)
        );

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        /* =======================
           HEADER TABEL (BARIS 4)
        ======================== */
        $sheet->getStyle('A4:C4')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => 'E9ECEF',
                ],
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);

        /* =======================
           ALIGN KOLOM
        ======================== */
        return [
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'center']],
            'C' => ['alignment' => ['horizontal' => 'right']],
        ];
    }

    /**
     * FORMAT RUPIAH
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}

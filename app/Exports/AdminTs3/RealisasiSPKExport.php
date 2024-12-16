<?php

namespace App\Exports\AdminTs3;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RealisasiSPKExport implements FromCollection, ShouldAutoSize, WithStyles, WithEvents
{
    protected $data;
    protected $from_date;
    protected $to_date;
    protected $spkno;
    protected $regional;

    public function __construct($data, $from_date = null, $to_date = null, $spkno = null, $regional = null)
    {
        $this->data = $data;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->spkno = $spkno;
        $this->regional = $regional;
    }

    public function collection()
    {
        $realisasi_spk = $this->data['realisasi_spk'];

        return $realisasi_spk->map(function ($item, $index) {
            return [
                'no' => $index + 1, // Nomor urut
                'nopol' => $item->nopol,
                'norangka' => $item->norangka,
                'nomesin' => $item->nomesin,
                'regional' => $item->regional,
                'area' => $item->area,
                'cabang' => $item->cabang,
                'spk_no' => $item->spk_no,
                'service_no' => $item->service_no,
                'tanggal_service' => $item->tanggal_service,
                'keterangan' => $item->keterangan,
            ];
        });
    }

    public function styles(Worksheet $sheet)
    {
        return [
            3 => ['font' => ['bold' => true]], // Style untuk header di baris ke-3
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                // Menulis judul di baris ke-1
                $sheet->setCellValue('A1', 'REALISASI SPK');
                $sheet->mergeCells('A1:K1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ]
                ]);
                $sheet->getRowDimension(1)->setRowHeight(30);

                // Informasi tanggal dan regional di baris ke-2
                $headerText = '';
                if ($this->from_date && $this->to_date) {
                    $headerText .= "PERIOD {$this->from_date} SAMPAI {$this->to_date}\n";
                }
                if ($this->spkno) {
                    $headerText .= "SPK No: {$this->spkno}\n";
                }
                if ($this->regional) {
                    $headerText .= "Regional: {$this->regional}\n";
                }

                $sheet->setCellValue('A2', trim($headerText));
                $sheet->mergeCells('A2:K2');
                $sheet->getStyle('A2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true
                    ]
                ]);
                $sheet->getRowDimension(2)->setRowHeight(60);

                // Menulis header di baris ke-3
                $sheet->setCellValue('A3', 'No');
                $sheet->setCellValue('B3', 'No Polisi');
                $sheet->setCellValue('C3', 'No Rangka');
                $sheet->setCellValue('D3', 'No Mesin');
                $sheet->setCellValue('E3', 'Regional');
                $sheet->setCellValue('F3', 'Area');
                $sheet->setCellValue('G3', 'Cabang');
                $sheet->setCellValue('H3', 'SPK No');
                $sheet->setCellValue('I3', 'Service No');
                $sheet->setCellValue('J3', 'Tanggal Service');
                $sheet->setCellValue('K3', 'Keterangan');

                // Style untuk header
                $sheet->getStyle('A3:K3')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '16A085']
                    ],
                    'font' => ['color' => ['rgb' => 'FFFFFF']],
                    'alignment' => ['horizontal' => 'center']
                ]);

                // Menulis data di baris ke-4
                $row = 4;
                foreach ($this->data['realisasi_spk'] as $index => $item) {
                    $sheet->setCellValue('A' . $row, $index + 1);
                    $sheet->setCellValue('B' . $row, $item->nopol);
                    $sheet->setCellValue('C' . $row, $item->norangka);
                    $sheet->setCellValue('D' . $row, $item->nomesin);
                    $sheet->setCellValue('E' . $row, $item->regional);
                    $sheet->setCellValue('F' . $row, $item->area);
                    $sheet->setCellValue('G' . $row, $item->cabang);
                    $sheet->setCellValue('H' . $row, $item->spk_no);
                    $sheet->setCellValue('I' . $row, $item->service_no);
                    $sheet->setCellValue('J' . $row, $item->tanggal_service);
                    $sheet->setCellValue('K' . $row, $item->keterangan);
                    $row++;
                }

                // Style untuk data
                $lastRow = $row - 1;
                $sheet->getStyle('A4:K' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ]
                    ]
                ]);
            }
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\ScoreTAI;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ScoreExports implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        return ScoreTAI::with(['elderly', 'group', 'user'])->get()->map(function ($score) {
            return [
                'ID' => $score->id,
                'Elderly Name' => $score->elderly ? $score->elderly->FirstName . ' ' . $score->elderly->LastName : 'N/A',
                'Mobility' => $score->mobility,
                'Confuse' => $score->confuse,
                'Feed' => $score->feed,
                'Toilet' => $score->toilet,
                'Group' => $score->group ? $score->group->name : 'N/A',
                'QR Code' => '', // ไม่แสดงเส้นทาง QR Code ใน collection
                'User' => $score->user ? $score->user->FirstName . ' ' . $score->user->LastName : 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ลำดับ',
            'ผู้สูงอายุ',
            'Mobility',
            'Confuse',
            'Feed',
            'Toilet',
            'Group',
            'QR Code',
            'ผู้ใช้งาน',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $row = 2; // เริ่มจากแถวที่ 2 (แถวที่ 1 เป็นหัวตาราง)
                foreach ($this->collection() as $score) {
                    $qrPath = public_path('qr-codes/score_tai_' . $score['ID'] . '.png'); // ปรับเส้นทางตามที่คุณใช้

                    if (file_exists($qrPath)) { // ตรวจสอบว่าไฟล์มีอยู่จริง
                        $drawing = new Drawing();
                        $drawing->setName('QR Code');
                        $drawing->setDescription('QR Code');
                        $drawing->setPath($qrPath); // เส้นทางของ QR Code
                        $drawing->setHeight(50); // ปรับขนาดให้พอดี
                        $drawing->setWidth(50); // กำหนดความกว้าง
                        $drawing->setWorksheet($event->sheet->getDelegate()); // เพิ่มภาพไปยัง Worksheet
                        $drawing->setCoordinates('H' . $row); // กำหนดตำแหน่งในการวางภาพ
                    } else {
                        // หากไม่พบภาพ ให้แสดง "N/A" ในเซลล์
                        $event->sheet->setCellValue('H' . $row, 'N/A');
                    }

                    $row++;
                }
            },
        ];
    }
}

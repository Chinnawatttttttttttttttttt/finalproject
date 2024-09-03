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
            // Determine the group description based on the group name
            $groupName = $score->group ? $score->group->name : 'N/A';
            if (in_array($groupName, ['B5', 'B4', 'B3'])) {
                $groupDescription = 'กลุ่มปกติ';
            } elseif (in_array($groupName, ['C4', 'C3', 'C2'])) {
                $groupDescription = 'กลุ่มติดบ้าน';
            } elseif (in_array($groupName, ['I3', 'I2', 'I1'])) {
                $groupDescription = 'กลุ่มติดเตียง';
            } else {
                $groupDescription = 'ยังไม่ได้ประเมิน';
            }

            return [
                'ID' => $score->id,
                'ชื่อผู้สูงอายุ' => $score->elderly ? $score->elderly->Title . ' ' . $score->elderly->FirstName . ' ' . $score->elderly->LastName : 'N/A',
                'การเคลื่อนไหว' => $score->mobility,
                'สับสน' => $score->confuse,
                'การให้อาหาร' => $score->feed,
                'การใช้ห้องน้ำ' => $score->toilet,
                'กลุ่ม TAI' => $score->group ? $score->group->name : 'ยังไม่ได้ประเมิน',
                'กลุ่ม' => $groupDescription,
                'QR Code' => '', // ไม่แสดงเส้นทาง QR Code ใน collection
                'ผู้บันทึกข้อมูล' => $score->user ? $score->user->FirstName . ' ' . $score->user->LastName : 'N/A',
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ลำดับ',
            'ผู้สูงอายุ',
            'การเคลื่อนไหว',
            'สับสน',
            'การกินอาหาร',
            'การเข้าห้องน้ำ',
            'กลุ่ม TAI',
            'กลุ่ม',
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
                        $drawing->setCoordinates('I' . $row); // กำหนดตำแหน่งในการวางภาพ
                    } else {
                        // หากไม่พบภาพ ให้แสดง "N/A" ในเซลล์
                        $event->sheet->setCellValue('I' . $row, 'N/A');
                    }

                    $row++;
                }
            },
        ];
    }
}

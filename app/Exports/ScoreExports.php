<?php

namespace App\Exports;

use App\Models\ScoreTAI;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

//WithEvents การเพิ่มภาพ


class ScoreExports implements FromCollection, WithHeadings
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
            'ผู้ใช้งาน',
        ];
    }
    
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $row = 2; // เริ่มจากแถวที่ 2 (แถวที่ 1 เป็นหัวตาราง)
    //             foreach ($this->collection() as $score) {
    //                 $qrPath = public_path('qr-codes/score_tai_' . $score['ID'] . '.svg'); // ปรับเส้นทางตามที่คุณใช้

    //                 if (file_exists($qrPath)) { // ตรวจสอบว่าไฟล์มีอยู่จริง
    //                     $drawing = new Drawing();
    //                     $drawing->setName('QR Code');
    //                     $drawing->setDescription('QR Code');
    //                     $drawing->setPath($qrPath); // เส้นทางของ QR Code

    //                     // ปรับขนาดภาพให้มีขนาดประมาณ 1.5 ซม. x 1.5 ซม.
    //                     $drawing->setHeight(57); // 1.5 cm ความสูง
    //                     $drawing->setWidth(57); // 1.5 cm ความกว้าง

    //                     // กำหนดตำแหน่งของภาพ
    //                     $drawing->setCoordinates('I' . $row); 
    //                     $drawing->setOffsetX(5); // เสริม: เพิ่มระยะห่างทางซ้ายเล็กน้อย
    //                     $drawing->setOffsetY(5); // เสริม: เพิ่มระยะห่างด้านบนเล็กน้อย

    //                     // ตั้งค่าให้ภาพปรับขนาดตามสัดส่วนภายในเซลล์
    //                     $drawing->setResizeProportional(true);
                        
    //                     // ปรับความสูงของแถวและความกว้างของคอลัมน์ให้เหมาะสมกับภาพ
    //                     $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(43); // ปรับความสูงของแถวเป็น 43 พิกเซล (ประมาณ 1.5 cm)
    //                     $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(15); // ปรับความกว้างของคอลัมน์เป็น 15 (ประมาณ 1.5 cm)

    //                     // เพิ่มภาพไปยัง Worksheet
    //                     $drawing->setWorksheet($event->sheet->getDelegate());
    //                 } else {
    //                     // หากไม่พบภาพ ให้แสดง "N/A" ในเซลล์
    //                     $event->sheet->setCellValue('I' . $row, 'N/A');
    //                 }

    //                 $row++;
    //             }
    //         },
    //     ];
    // }

}

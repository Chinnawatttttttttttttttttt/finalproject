@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">รายชื่อผู้สูงอายุและคะแนนการประเมิน</h1>
        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <label for="user_name">ชื่อ-ผู้ประเมิน:</label>
                <span id="user_name">{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                {{--  <a href="{{ route('print.pdf-qr') }}" class="btn btn-primary" style= "float: right;">PDF</a>  --}}
                {{--  <button id="print-btn" class="btn btn-primary">Print</button>  --}}
            </div>
            <div class="text-right">
                <a href="{{ route('print.pdf-qr') }}" class="btn btn-primary float-right">PDF</a>
            </div>

        </div>

        @if ($scores->isEmpty())
            <div class="alert alert-info">
                <p>ยังไม่มีข้อมูลของคะแนน</p>
                <a href="{{ route('score.create', ['id' => $elderly->id]) }}" class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>
            </div>
        @else
            <div class="table">
                <table id="table" class="table-hover table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-ผู้สูงอายุ</th>
                            <th>แบบทดสอบ</th>
                            <th>QR-Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scores as $score)
                            @if (is_null($score->mobility) && is_null($score->confuse) && is_null($score->feed) && is_null($score->toilet))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $score->elderly->Title . $score->elderly->FirstName }}
                                        {{ $score->elderly->LastName }}</td>
                                    <td>
                                        <a href="{{ route('score.create', ['id' => $score->id]) }}"
                                            class="btn btn-primary">ไปที่หน้าแบบประเมิน</a>
                                    </td>
                                    <td>
                                        <!-- ปุ่มเพื่อเปิด Modal -->
                                        @if ($score->qr_path)
                                            <button type="button" class="btn btn-success show-qr" data-toggle="modal"
                                                data-target="#qrModal" data-qr-url="{{ url($score->qr_path) }}">
                                                แสดงข้อมูลประจำตัวผู้สูงอายุ
                                            </button>
                                        @else
                                            ไม่มี QR Code
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">ข้อมูลบัตรประจำตัวผู้สูงอายุ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ข้อมูลบัตร -->
                    <div class="id-card-full">
                        <div class="id-card-header">
                            <h4>บัตรประจำตัวผู้สูงอายุ</h4>
                        </div>
                        <div class="id-card-content">
                            <div class="id-card-info">
                                <p><span class="label">เลขประจำตัวผู้สูงอายุ:</span> {{ $elderly->id }}</p>
                                <p><span class="label">ชื่อ-สกุล:</span> {{ $elderly->Title }} {{ $elderly->FirstName }}
                                    {{ $elderly->LastName }}</p>
                                <p><span class="label">วันเดือนปีเกิด:</span> {{ $elderly->Birthday }}</p>
                                <p><span class="label">อายุ:</span> {{ $age }} ปี</p>
                                <p class="address">
                                    <span class="label">ที่อยู่:</span>บ้านเลขที่ <span
                                        class="data">{{ $houseNumber }}</span>
                                    หมู่ <span class="data">{{ $village }}</span><br>
                                    ตำบล <span class="data">{{ $subdistrict }}</span>
                                    อำเภอ <span class="data">{{ $district }}</span><br>
                                    จังหวัด <span class="data">{{ $province }}</span>
                                    รหัสไปรษณีย์ <span class="data">{{ $postalCode }}</span>
                                </p>
                            </div>
                            <div>
                                <img id="qrImage" src="" alt="QR Code">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                        id="downloadAllBtn">ดาวน์โหลดบัตรประจำตัวผู้สูงอายุ</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .id-card-full {
            width: 100%;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .id-card-header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .id-card-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-top: 1px solid #000;
            padding-top: 20px;
            background-color: #ccc
        }

        .id-card-info {
            font-family: Arial, sans-serif;
            /* ใช้ฟอนต์ที่อ่านง่าย */
            font-size: 14px;
            /* ขนาดตัวอักษร */
            line-height: 1.6;
            /* ระยะห่างระหว่างบรรทัด */
            color: #000;
            /* สีตัวอักษร */
            margin: 0;
            padding: 10px;
        }

        .id-card-info p {
            margin: 5px 0;
            /* ระยะห่างระหว่างพารากราฟ */
        }

        .id-card-info .label {
            font-weight: bold;
            /* เน้นข้อความหัวข้อ */
        }

        .id-card-info .address {
            margin-top: 10px;
            /* ระยะห่างจากพารากราฟก่อนหน้า */
        }

        .id-card-info .data {
            font-weight: normal;
            /* น้ำหนักตัวอักษรปกติ */
        }

        .address {
            font-size: 16px;
            /* ขนาดตัวอักษร */
            line-height: 1.5;
            /* ระยะห่างระหว่างบรรทัด */
            margin: 0;
            /* ไม่มีระยะห่างรอบๆ */
            padding: 0;
            /* ไม่มีการเติมภายใน */
        }

        .address .label {
            font-weight: bold;
            /* เน้นข้อความ "ที่อยู่:" */
        }

        .address .data {
            font-weight: normal;
            /* ปรับน้ำหนักตัวอักษรของข้อมูล */
        }

        /* เพิ่ม CSS ต่อไปนี้ในไฟล์หรือภายใน <style> ของคุณ */
        .modal-body {
            text-align: center;
            /* จัดกึ่งกลางเนื้อหาใน modal */
        }

        #qrImage {
            max-width: 50%;
            /* ให้ภาพมีความกว้างสูงสุดที่ 100% ของ container */
            height: auto;
            /* ให้ความสูงของภาพปรับตามสัดส่วน */
            display: block;
            /* ทำให้ภาพเป็นบล็อค */
            margin: 0 auto;
            /* จัดภาพให้ตรงกลาง */
        }

        .img-center {
            margin: 0 auto;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-qr').forEach(function(button) {
                button.addEventListener('click', function() {
                    var qrUrl = this.getAttribute('data-qr-url');
                    document.getElementById('qrImage').src = qrUrl;
                    document.getElementById('downloadAllBtn').setAttribute('data-qr-url', qrUrl);
                });
            });

            document.getElementById('downloadAllBtn').addEventListener('click', function() {
                var idCardElement = document.querySelector('.id-card-full');
                html2canvas(idCardElement, {
                    useCORS: true,
                    scale: 2
                }).then(function(canvas) {
                    var link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'id-card-{{ $elderly->id }}.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

@endsection

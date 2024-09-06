@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Form</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 900px;
                margin: 50px auto;
                padding: 20px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .container h1 {
                margin-bottom: 20px;
                font-size: 24px;
                text-align: center;
                color: #333;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-weight: bold;
                margin-bottom: 5px;
                display: block;
                color: #555;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                box-sizing: border-box;
                background-color: #f8f8f8;
                color: #555;
            }

            .form-group input:focus,
            .form-group select:focus {
                border-color: #ccc;
                outline: none;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
            }

            .row .col-md-2,
            .row .col-md-3,
            .row .col-md-4 {
                flex: 1;
                min-width: calc(25% - 15px);
            }

            .row .col-md-12 {
                width: 100%;
            }

            #map {
                height: 400px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-top: 10px;
                pointer-events: none;
                /* ทำให้แผนที่ไม่สามารถแก้ไขได้ */
            }

            body {
                font-family: Arial, sans-serif;
                background: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 900px;
                margin: 50px auto;
                padding: 20px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .actions {
                display: flex;
                /* ทำให้เป็นคอนเทนเนอร์แบบ Flexbox */
                flex-direction: row;
                /* เรียงไอเท็มในแนวนอน */
                align-items: center;
                /* จัดไอเท็มให้อยู่ตรงกลางในแนวตั้ง */
                gap: 10px;
                /* ช่องว่างระหว่างไอเท็มแต่ละตัว */
            }

            .btn {
                display: inline-flex;
                align-items: center;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                transition: background 0.3s ease, color 0.3s ease;
            }

            .btn-info {
                background-color: #17a2b8;
            }

            .btn-warning {
                background-color: #ffc107;
            }

            .btn-info:hover {
                background-color: #138496;
            }

            .btn-warning:hover {
                background-color: #e0a800;
            }

            .btn i {
                margin-right: 8px;
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
    </head>

    <body>
        <div class="container">
            <h1><i class="fas fa-user"></i> โปรไฟล์ผู้สูงอายุ</h1>

            <div class="container center">
                <div class="actions">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $elderly->Latitude }},{{ $elderly->Longitude }}"
                        target="_blank" class="btn btn-info">
                        <i class="fas fa-map-marker-alt"></i> แผนที่
                    </a>

                    <a href="{{ route('elderlys.edit', $elderly->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> แก้ไข
                    </a>

                    <a href="{{ route('score.create', ['id' => $score->id]) }}"
                        class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>

                    @if ($score->qr_path)
                        <button type="button" class="btn btn-success show-qr" data-toggle="modal" data-target="#qrModal"
                            data-qr-url="{{ asset($score->qr_path) }}">
                            แสดงข้อมูลประจำตัวผู้สูงอายุ
                        </button>
                    @else
                        ไม่มี QR Code
                    @endif

                    <a href="{{ route('all-elderly') }}" class="btn btn-danger">ย้อนกลับ</a>

                </div>
            </div>

            <div class="row">
                <!-- Title -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Title">คำนำหน้า:</label>
                        <input type="text" class="form-control" id="Title" name="Title"
                            value="{{ old('Title', $elderly->Title) }}" readonly>
                    </div>
                </div>

                <!-- First Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="FirstName">ชื่อ:</label>
                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                            value="{{ old('FirstName', $elderly->FirstName) }}" readonly>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LastName">นามสกุล:</label>
                        <input type="text" class="form-control" id="LastName" name="LastName"
                            value="{{ old('LastName', $elderly->LastName) }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Nick Name -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="NickName">ชื่อเล่น:</label>
                        <input type="text" class="form-control" id="NickName" name="NickName"
                            value="{{ old('NickName', $elderly->NickName) }}" readonly>
                    </div>
                </div>

                <!-- Birthday -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Birthday">วันเกิด:</label>
                        <input type="date" class="form-control" id="Birthday" name="Birthday"
                            value="{{ old('Birthday', $elderly->Birthday) }}" readonly>
                    </div>
                </div>

                <!-- Age -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Age">อายุ:</label>
                        <input type="number" class="form-control" id="Age" name="Age"
                            value="{{ old('Age', $age) }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- House Number -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="houseNumber">บ้านเลขที่:</label>
                        <input type="text" class="form-control" id="houseNumber" name="houseNumber"
                            value="{{ old('houseNumber', $houseNumber) }}" readonly>
                    </div>
                </div>

                <!-- Village -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="village">หมู่:</label>
                        <input type="text" class="form-control" id="village" name="village"
                            value="{{ old('village', $village) }}" readonly>
                    </div>
                </div>

                <!-- Subdistrict -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="subdistrict">ตำบล:</label>
                        <input type="text" class="form-control" id="subdistrict" name="subdistrict"
                            value="{{ old('subdistrict', $subdistrict) }}" readonly>
                    </div>
                </div>

                <!-- District -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="district">อำเภอ:</label>
                        <input type="text" class="form-control" id="district" name="district"
                            value="{{ old('district', $district) }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Province -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province">จังหวัด:</label>
                        <input type="text" class="form-control" id="province" name="province"
                            value="{{ old('province', $province) }}" readonly>
                    </div>
                </div>

                <!-- Postal Code -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="postalCode">รหัสไปรษณีย์:</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode"
                            value="{{ old('postalCode', $postalCode) }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Phone -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Phone">เบอร์โทร:</label>
                        <input type="text" class="form-control" id="Phone" name="Phone"
                            value="{{ old('Phone', $elderly->Phone) }}" readonly>
                    </div>
                </div>

                <!-- Latitude -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Latitude">ละติจูด:</label>
                        <input type="number" class="form-control" id="Latitude" name="Latitude"
                            value="{{ old('Latitude', $elderly->Latitude) }}" step="0.0000001" readonly>
                    </div>
                </div>

                <!-- Longitude -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Longitude">ลองจิจูด:</label>
                        <input type="number" class="form-control" id="Longitude" name="Longitude"
                            value="{{ old('Longitude', $elderly->Longitude) }}" step="0.0000001" readonly>
                    </div>
                </div>
            </div>

            <!-- Score || Group -->
            <div class="row">

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="mobility">การเคลื่อนไหว</label>
                        @if ($score)
                            <input type="text" class="form-control" id="mobility" name="mobility"
                                value="{{ old('mobility', $score->mobility) }}" readonly>
                            <label for="confuse">สับสน</label>
                            <input type="text" class="form-control" id="confuse" name="confuse"
                                value="{{ old('confuse', $score->confuse) }}" readonly>
                        @else
                            <p>ยังไม่ได้ประเมิน</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="feed">การกินอาหาร</label>
                        @if ($score)
                            <input type="text" class="form-control" id="feed" name="feed"
                                value="{{ old('feed', $score->feed) }}" readonly>
                            <label for="toilet">การใช้ห้องน้ำ</label>
                            <input type="text" class="form-control" id="toilet" name="toilet"
                                value="{{ old('toilet', $score->toilet) }}" readonly>
                        @else
                            <p>ยังไม่ได้ประเมิน</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="group">กลุ่ม</label>
                        @if ($group)
                            <input type="text" class="form-control" id="group" name="group"
                                value="{{ old('name', $group->name) }}" readonly>
                        @else
                            <p>ยังไม่ได้ประเมิน</p>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Map">แผนที่:</label>
                        <div id="map"></div>
                    </div>
                </div>
            </div>

        </div>

        {{--  <!-- Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">บัตรประจำตัวผู้สูงอายุ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- ข้อมูลผู้สูงอายุที่เพิ่มเข้าไป -->
                        <p>เลขประจำตัวผู้สูงอายุ: {{ $elderly->id }}</p>
                        <p>ชื่อ-สกุล: {{ $elderly->Title . $elderly->FirstName }} {{ $elderly->LastName }}</p>
                        <p>วันเดือนปีเกิด: {{ $elderly->Birthday }}</p>
                        <p>อายุ: {{ $age }} ปี</p>
                        <p>ที่อยู่: บ้านเลขที่: {{ $houseNumber }} หมู่: {{ $village }} ตำบล:
                            {{ $subdistrict }} อำเภอ: {{ $district }} จังหวัด: {{ $province }}
                            รหัสไปรษณีย์: {{ $postalCode }}</p>
                        <img id="qrImage" src="" alt="QR Code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success"
                            id="downloadAllBtn">ดาวน์โหลดข้อมูลทั้งหมด</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>  --}}

        <!-- Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">ข้อมูลบัตรประจำตัวประชาชน</h5>
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
                                    <p><span class="label">ชื่อ-สกุล:</span> {{ $elderly->Title }} {{ $elderly->FirstName }} {{ $elderly->LastName }}</p>
                                    <p><span class="label">วันเดือนปีเกิด:</span> {{ $elderly->Birthday }}</p>
                                    <p><span class="label">อายุ:</span> {{ $age }} ปี</p>
                                    <p class="address">
                                        <span class="label">ที่อยู่:</span>บ้านเลขที่ <span class="data">{{ $houseNumber }}</span>
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
                            id="downloadAllBtn">ดาวน์โหลดข้อมูลทั้งหมด</button>
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
                        link.download = 'id-card.png';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                });
            });
        </script>




        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var initialPosition = [{{ old('Latitude', $elderly->Latitude) }},
                    {{ old('Longitude', $elderly->Longitude) }}
                ];

                var map = L.map('map').setView(initialPosition, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker(initialPosition).addTo(map);
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>



    </body>
@endsection

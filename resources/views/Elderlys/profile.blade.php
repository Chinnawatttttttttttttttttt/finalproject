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
                        <input type="text" class="form-control" id="mobility" name="mobility" value="{{ old('mobility', $score->mobility) }}" readonly>
                        <label for="confuse">สับสน</label>
                        <input type="text" class="form-control" id="confuse" name="confuse" value="{{ old('confuse', $score->confuse) }}" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="feed">การกินอาหาร</label>
                        <input type="text" class="form-control" id="feed" name="feed" value="{{ old('feed', $score->feed) }}" readonly>
                        <label for="toilet">การใช้ห้องน้ำ</label>
                        <input type="text" class="form-control" id="toilet" name="toilet" value="{{ old('toilet', $score->toilet) }}" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="group">กลุ่ม</label>
                        <input type="text" class="form-control" id="group" name="group" value="{{ old('name', $group->name) }}" readonly>
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
    </body>
@endsection

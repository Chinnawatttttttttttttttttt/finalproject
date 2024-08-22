@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">แก้ไขข้อมูลผู้สูงอายุ</h1>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif

            <form action="{{ route('elderlys.update', $elderly->id) }}" method="POST" onsubmit="combineNameAndAddress()">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Title -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Title">คำนำหน้า:</label>
                            <select class="form-control" id="Title" name="Title" required>
                                <option value="">เลือกคำนำหน้า</option>
                                <option value="นาย" {{ old('Title', $elderly->Title) == 'นาย' ? 'selected' : '' }}>นาย</option>
                                <option value="นาง" {{ old('Title', $elderly->Title) == 'นาง' ? 'selected' : '' }}>นาง</option>
                                <option value="นางสาว" {{ old('Title', $elderly->Title) == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                            </select>
                            @error('Title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- First Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FirstName">ชื่อ:</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName', $elderly->FirstName) }}" required>
                            @error('FirstName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="LastName">นามสกุล:</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName', $elderly->LastName) }}" required>
                            @error('LastName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Nick Name -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="NickName">ชื่อเล่น:</label>
                            <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName', $elderly->NickName) }}">
                            @error('NickName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Birthday -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Birthday">วันเกิด:</label>
                            <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday', $elderly->Birthday) }}" required>
                            @error('Birthday')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Age -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Age">อายุ:</label>
                            <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age', $age) }}" readonly>
                            @error('Age')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- House Number -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="houseNumber">บ้านเลขที่:</label>
                            <input type="text" class="form-control" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $houseNumber) }}">
                        </div>
                    </div>

                    <!-- Village -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="village">หมู่:</label>
                            <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $village) }}">
                        </div>
                    </div>

                    <!-- Subdistrict -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subdistrict">ตำบล:</label>
                            <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $subdistrict) }}">
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district">อำเภอ:</label>
                            <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $district) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Province -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="province">จังหวัด:</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $province) }}">
                        </div>
                    </div>

                    <!-- Postal Code -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="postalCode">รหัสไปรษณีย์:</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ old('postalCode', $postalCode) }}">
                        </div>
                    </div>
                </div>

                <!-- Hidden field to store combined address -->
                <input type="hidden" id="Address" name="Address">

                <div class="row">
                    <!-- Phone -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Phone">เบอร์โทร:</label>
                            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone', $elderly->Phone) }}">
                            @error('Phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Latitude -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Latitude">ละติจูด:</label>
                            <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude', $elderly->Latitude) }}" step="0.0000001" readonly>
                            @error('Latitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Longitude -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Longitude">ลองจิจูด:</label>
                            <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude', $elderly->Longitude) }}" step="0.0000001" readonly>
                            @error('Longitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Map">แผนที่:</label>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </form>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var initialPosition = [{{ old('Latitude', $elderly->Latitude) }}, {{ old('Longitude', $elderly->Longitude) }}];

        var map = L.map('map').setView(initialPosition, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker(initialPosition).addTo(map);

        map.on('click', function(e) {
            var latlng = e.latlng;
            L.marker(latlng).addTo(map);
            document.getElementById('Latitude').value = latlng.lat;
            document.getElementById('Longitude').value = latlng.lng;
        });
    });

    function combineNameAndAddress() {
        var title = document.getElementById('Title').value;
        var firstName = document.getElementById('FirstName').value;
        var lastName = document.getElementById('LastName').value;

        var address = [
            document.getElementById('houseNumber').value,
            document.getElementById('village').value,
            document.getElementById('subdistrict').value,
            document.getElementById('district').value,
            document.getElementById('province').value,
            document.getElementById('postalCode').value
        ].join(' ');

        document.getElementById('Address').value = address;

        return true;
    }
</script>
@endsection

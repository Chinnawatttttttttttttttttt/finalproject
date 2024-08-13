@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">แก้ไขข้อมูลผู้สูงอายุ</h1>

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

        <!-- Title -->
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

        <!-- First Name -->
        <div class="form-group">
            <label for="FirstName">ชื่อ:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName', $elderly->FirstName) }}" required>
            @error('FirstName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="LastName">นามสกุล:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName', $elderly->LastName) }}" required>
            @error('LastName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nick Name -->
        <div class="form-group">
            <label for="NickName">ชื่อเล่น:</label>
            <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName', $elderly->NickName) }}">
            @error('NickName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Birthday -->
        <div class="form-group">
            <label for="Birthday">วันเกิด:</label>
            <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday', $elderly->Birthday) }}" required>
            @error('Birthday')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Age -->
        <div class="form-group">
            <label for="Age">อายุ:</label>
            <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age', $age) }}" readonly>
            @error('Age')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="houseNumber">บ้านเลขที่:</label>
            <input type="text" class="form-control" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $houseNumber) }}">
        </div>

        <div class="form-group">
            <label for="village">หมู่:</label>
            <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $village) }}">
        </div>

        <div class="form-group">
            <label for="subdistrict">ตำบล:</label>
            <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $subdistrict) }}">
        </div>

        <div class="form-group">
            <label for="district">อำเภอ:</label>
            <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $district) }}">
        </div>

        <div class="form-group">
            <label for="province">จังหวัด:</label>
            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $province) }}">
        </div>

        <div class="form-group">
            <label for="postalCode">รหัสไปรษณีย์:</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ old('postalCode', $postalCode) }}">
        </div>

        <!-- Hidden field to store combined address -->
        <input type="hidden" id="Address" name="Address">

        <!-- Phone -->
        <div class="form-group">
            <label for="Phone">เบอร์โทร:</label>
            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone', $elderly->Phone) }}">
            @error('Phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Latitude -->
        <div class="form-group">
            <label for="Latitude">ละติจูด:</label>
            <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude', $elderly->Latitude) }}" step="0.0000001" readonly>
            @error('Latitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Longitude -->
        <div class="form-group">
            <label for="Longitude">ลองจิจูด:</label>
            <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude', $elderly->Longitude) }}" step="0.0000001" readonly>
            @error('Longitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Map -->
        <div class="form-group">
            <label for="Map">แผนที่:</label>
            <div id="map" style="height: 400px;"></div>
        </div>

        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
    </form>
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

        var marker = L.marker(initialPosition, { draggable: true }).addTo(map);

        map.on('click', function (e) {
            var clickedLocation = e.latlng;
            marker.setLatLng(clickedLocation);
            document.getElementById('Latitude').value = clickedLocation.lat.toFixed(6);
            document.getElementById('Longitude').value = clickedLocation.lng.toFixed(6);
        });

        marker.on('dragend', function (e) {
            var draggedLocation = e.target.getLatLng();
            document.getElementById('Latitude').value = draggedLocation.lat.toFixed(6);
            document.getElementById('Longitude').value = draggedLocation.lng.toFixed(6);
        });

        // Update age based on birthday input
        document.getElementById('Birthday').addEventListener('change', function() {
            var birthday = new Date(this.value);
            var age = calculateAge(birthday);
            document.getElementById('Age').value = age;
        });

        function calculateAge(birthday) {
            var today = new Date();
            var age = today.getFullYear() - birthday.getFullYear();
            var monthDiff = today.getMonth() - birthday.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
                age--;
            }
            return age;
        }
    });


    function combineNameAndAddress() {
        const houseNumber = document.getElementById('houseNumber').value;
        const village = document.getElementById('village').value;
        const subdistrict = document.getElementById('subdistrict').value;
        const district = document.getElementById('district').value;
        const province = document.getElementById('province').value;
        const postalCode = document.getElementById('postalCode').value;

        // Combine address
        {{--  const address = `บ้านเลขที่ ${houseNumber} หมู่บ้าน ${village} ตำบล ${subdistrict} อำเภอ ${district} จังหวัด ${province} รหัสไปรษณีย์ ${postalCode}`;  --}}
        const address = 'บ้านเลขที่ ' + houseNumber + ' หมู่บ้าน ' + village + ' ตำบล ' + subdistrict + ' อำเภอ ' + district + ' จังหวัด ' + province + ' รหัสไปรษณีย์ ' + postalCode;
        document.getElementById('Address').value = address;

        // Update the age input field
        document.getElementById('Age').value = age;

        console.log('Combined Address:', address); // For debugging
    }

</script>
@endsection

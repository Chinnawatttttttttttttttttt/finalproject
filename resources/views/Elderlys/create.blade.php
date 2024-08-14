@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">เพิ่มข้อมูลผู้สูงอายุ</h1>

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

    <form action="{{ route('elderlys.store') }}" method="POST" >
        @csrf

        <!-- Title -->
        <div class="form-group">
            <label for="Title">คำนำหน้า:</label>
            <select class="form-control" id="Title" name="Title" required>
                <option value="">เลือกคำนำหน้า</option>
                <option value="นาย" {{ old('Title') == 'นาย' ? 'selected' : '' }}>นาย</option>
                <option value="นาง" {{ old('Title') == 'นาง' ? 'selected' : '' }}>นาง</option>
                <option value="นางสาว" {{ old('Title') == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
            </select>
            @error('Title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- First Name -->
        <div class="form-group">
            <label for="FirstName">ชื่อ:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName') }}" required>
            @error('FirstName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="LastName">นามสกุล:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName') }}" required>
            @error('LastName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nick Name -->
        <div class="form-group">
            <label for="NickName">ชื่อเล่น:</label>
            <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName') }}">
            @error('NickName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Birthday -->
        <div class="form-group">
            <label for="Birthday">วันเกิด:</label>
            <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday') }}" required>
            @error('Birthday')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Age -->
        <div class="form-group">
            <label for="Age">อายุ:</label>
            <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age') }}" readonly>
            @error('Age')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="houseNumber">บ้านเลขที่:</label>
            <input type="text" class="form-control" id="houseNumber" name="houseNumber">
        </div>

        <div class="form-group">
            <label for="village">หมู่:</label>
            <input type="text" class="form-control" id="village" name="village">
        </div>

        <div class="form-group">
            <label for="subdistrict">ตำบล:</label>
            <input type="text" class="form-control" id="subdistrict" name="subdistrict">
        </div>

        <div class="form-group">
            <label for="district">อำเภอ:</label>
            <input type="text" class="form-control" id="district" name="district">
        </div>

        <div class="form-group">
            <label for="province">จังหวัด:</label>
            <input type="text" class="form-control" id="province" name="province">
        </div>

        <div class="form-group">
            <label for="postalCode">รหัสไปรษณีย์:</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode">
        </div>

        <!-- Hidden field to store combined address -->
        <input type="hidden" id="Address" name="Address">

        <!-- Phone -->
        <div class="form-group">
            <label for="Phone">เบอร์โทร:</label>
            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone') }}">
            @error('Phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Latitude -->
        <div class="form-group">
            <label for="Latitude">ละติจูด:</label>
            <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude') }}" step="0.0000001" readonly>
            @error('Latitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Longitude -->
        <div class="form-group">
            <label for="Longitude">ลองจิจูด:</label>
            <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude') }}" step="0.0000001" readonly>
            @error('Longitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Map -->
        <div class="form-group">
            <label for="Map">แผนที่:</label>
            <div id="map" style="height: 400px;"></div>
        </div>
        <button type="submit" class="btn btn-primary" onclick="combineNameAndAddress()">บันทึก</button>
    </form>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var initialPosition = [14.9930, 103.1029]; // Initial map position set to Buriram, Thailand

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

     // Function to combine title, first name, and address
     function combineNameAndAddress() {

        // Get values from individual address fields
        var houseNumber = document.getElementById('houseNumber').value;
        console.log('1',houseNumber);
        var village = document.getElementById('village').value;
        console.log('2',village);
        var subdistrict = document.getElementById('subdistrict').value;
        console.log('3',subdistrict);
        var district = document.getElementById('district').value;
        console.log('4',district);
        var province = document.getElementById('province').value;
        console.log('5',province);
        var postalCode = document.getElementById('postalCode').value;
        console.log('6',postalCode);

        // Combine values into full address only if all fields are filled
        if (houseNumber || village || subdistrict || district || province || postalCode) {
            console.log('test')
            var fullAddress = 'บ้านเลขที่ ' + houseNumber + ' หมู่ ' + village + ' ตำบล ' + subdistrict + ' อำเภอ ' + district + ' จังหวัด ' + province + ' รหัสไปรษณีย์ ' + postalCode;
            document.getElementById('Address').value = fullAddress;
        } else {
            document.getElementById('Address').value = null; // Clear FullAddress if any field is empty
        }
    }

    document.forms[0].onsubmit = function() {
        combineNameAndAddress();
    }
</script>
@endsection

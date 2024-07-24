@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Elderly</h1>

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

    <form action="{{ route('elderlys.store') }}" method="POST">
        @csrf

        <!-- First Name -->
        <div class="form-group">
            <label for="FirstName">First Name:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName') }}" required>
            @error('FirstName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="LastName">Last Name:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName') }}" required>
            @error('LastName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nick Name -->
        <div class="form-group">
            <label for="NickName">Nick Name:</label>
            <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName') }}">
            @error('NickName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Birthday -->
        <div class="form-group">
            <label for="Birthday">Birthday:</label>
            <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday') }}" required>
            @error('Birthday')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Age -->
        <div class="form-group">
            <label for="Age">Age:</label>
            <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age') }}" readonly>
            @error('Age')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="Address">Address:</label>
            <input type="text" class="form-control" id="Address" name="Address" value="{{ old('Address') }}">
            @error('Address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Latitude -->
        <div class="form-group">
            <label for="Latitude">Latitude:</label>
            <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude') }}" step="0.0000001" readonly>
            @error('Latitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Longitude -->
        <div class="form-group">
            <label for="Longitude">Longitude:</label>
            <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude') }}" step="0.0000001" readonly>
            @error('Longitude')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="Phone">Phone:</label>
            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone') }}">
            @error('Phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Map -->
        <div class="form-group">
            <label for="Map">Map:</label>
            <div id="map" style="height: 400px;"></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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
</script>
@endsection

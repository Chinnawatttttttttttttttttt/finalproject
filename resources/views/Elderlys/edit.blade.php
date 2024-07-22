@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-user-edit"></i> Edit Elderly</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form action="{{ route('elderlys.update', $elderly->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Method spoofing for PUT request -->

                        <!-- First Name -->
                        <div class="form-group">
                            <label for="FirstName">First Name:</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName', $elderly->FirstName) }}">
                            @error('FirstName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="LastName">Last Name:</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName', $elderly->LastName) }}">
                            @error('LastName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nick Name -->
                        <div class="form-group">
                            <label for="NickName">Nick Name:</label>
                            <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName', $elderly->NickName) }}">
                            @error('NickName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Birthday -->
                        <div class="form-group">
                            <label for="Birthday">Birthday:</label>
                            <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday', $elderly->Birthday) }}">
                            @error('Birthday')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Age -->
                        <div class="form-group">
                            <label for="Age">Age:</label>
                            <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age', $elderly->Age) }}">
                            @error('Age')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="Address">Address:</label>
                            <input type="text" class="form-control" id="Address" name="Address" value="{{ old('Address', $elderly->Address) }}">
                            @error('Address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Latitude -->
                        <div class="form-group">
                            <label for="Latitude">Latitude:</label>
                            <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude', $elderly->Latitude) }}" step="0.0000001" readonly>
                            @error('Latitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Longitude -->
                        <div class="form-group">
                            <label for="Longitude">Longitude:</label>
                            <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude', $elderly->Longitude) }}" step="0.0000001" readonly>
                            @error('Longitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="Phone">Phone:</label>
                            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone', $elderly->Phone) }}">
                            @error('Phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Map -->
                        <div class="form-group">
                            <label for="Map">Map:</label>
                            <div id="map" style="height: 400px;"></div>
                        </div>

                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="{{ $elderly->id }}">

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var initialPosition = [{{ $elderly->Latitude }}, {{ $elderly->Longitude }}]; // Use existing data if available

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
    });
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div id="map" style="height: 600px;"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([14.9930, 103.1029], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // ข้อมูลผู้สูงอายุ
        var elderlies = @json($elderlies);

        elderlies.forEach(function(elderly) {
            L.marker([elderly.Latitude, elderly.Longitude])
                .bindPopup('<b>' + elderly.FirstName + ' ' + elderly.LastName + '</b><br>' + elderly.Address)
                .addTo(map);
        });
    });
</script>
@endsection

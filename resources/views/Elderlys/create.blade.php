@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>เพิ่มข้อมูลผู้สูงอายุ</h2>
            </div>
            <div class="card-body">

                <form action="{{ route('elderlys.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Title -->
                        <div class="col-md-2">
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
                        </div>

                        <!-- First Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FirstName">ชื่อ:</label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName"
                                    value="{{ old('FirstName') }}" required>
                                @error('FirstName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="LastName">นามสกุล:</label>
                                <input type="text" class="form-control" id="LastName" name="LastName"
                                    value="{{ old('LastName') }}" required>
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
                                <input type="text" class="form-control" id="NickName" name="NickName"
                                    value="{{ old('NickName') }}">
                                @error('NickName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Birthday -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Birthday">วันเกิด:</label>
                                <input type="date" class="form-control" id="Birthday" name="Birthday"
                                    value="{{ old('Birthday') }}" required>
                                @error('Birthday')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Age">อายุ:</label>
                                <input type="number" class="form-control" id="Age" name="Age"
                                    value="{{ old('Age') }}" readonly>
                                @error('Age')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Province -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="province">จังหวัด:</label>
                                <select class="form-control" id="Province" name="province" required>
                                    <option value="">เลือกจังหวัด</option>
                                </select>
                                @error('province')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="district">อำเภอ:</label>
                                <select class="form-control" id="District" name="district" required>
                                    <option value="">เลือกอำเภอ</option>
                                </select>
                                @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Subdistrict -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subdistrict">ตำบล:</label>
                                <select class="form-control" id="Subdistrict" name="subdistrict" required>
                                    <option value="">เลือกตำบล</option>
                                </select>
                                @error('subdistrict')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- Postal Code -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postalCode">รหัสไปรษณีย์:</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode" readonly>
                            </div>
                        </div>

                        <!-- Village -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="village">หมู่:</label>
                                <input type="text" class="form-control" id="village" name="village"
                                    value="{{ old('village') }}">
                            </div>
                        </div>

                        <!-- House Number -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="houseNumber">บ้านเลขที่:</label>
                                <input type="text" class="form-control" id="houseNumber" name="houseNumber"
                                    value="{{ old('houseNumber') }}">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Phone">เบอร์โทร:</label>
                                <input type="text" class="form-control" id="Phone" name="Phone"
                                    value="{{ old('Phone') }}">
                                @error('Phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Hidden field to store combined address -->
                    <input type="hidden" id="Address" name="Address">
                    <!-- Hidden fields to store names -->
                    <input type="hidden" id="ProvinceName" name="provinceName">
                    <input type="hidden" id="DistrictName" name="districtName">
                    <input type="hidden" id="SubdistrictName" name="subdistrictName">

                    <div class="row">
                        <!-- Latitude -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Latitude">ละติจูด:</label>
                                <input type="number" class="form-control" id="Latitude" name="Latitude"
                                    step="0.0000001">
                                @error('Latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Longitude -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Longitude">ลองจิจูด:</label>
                                <input type="number" class="form-control" id="Longitude" name="Longitude"
                                    step="0.0000001">
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

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"
                            onclick="combineNameAndAddress()">บันทึกข้อมูล</button>
                        <a href="{{ route('all-elderly') }}" class="btn btn-danger">ย้อนกลับ</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Include Leaflet and jQuery scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialPosition = [14.9930, 103.1029]; // Initial map position set to Buriram, Thailand

            var map = L.map('map').setView(initialPosition, 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker(initialPosition).addTo(map);
            
            map.on('click', function(e) {
                var lat = e.latlng.lat.toFixed(7);
                var lng = e.latlng.lng.toFixed(7);
                marker.setLatLng(e.latlng);
                document.getElementById('Latitude').value = lat;
                document.getElementById('Longitude').value = lng;
            });

            // Calculate age based on the birthday
            function calculateAge(birthday) {
                var today = new Date();
                var birthDate = new Date(birthday);
                var age = today.getFullYear() - birthDate.getFullYear();
                var monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            // Event listener to calculate age when the birthday field changes
            document.getElementById('Birthday').addEventListener('change', function() {
                var birthday = this.value;
                var age = calculateAge(birthday);
                document.getElementById('Age').value = age;
            });
        });

        $(document).ready(function() {
            var provincesData = [];
            var provinceNames = {};
            var districtNames = {};
            var subdistrictNames = {};

            // Load provinces data from the asset path
            $.getJSON("{{ url('API/api_province_with_amphure_tambon.json') }}", function(data) {
                provincesData = data;
                let provinceSelect = $('#Province');

                // Populate province dropdown
                provincesData.forEach(function(province) {
                    provinceSelect.append(
                        `<option value="${province.id}" data-name="${province.name_th}">${province.name_th}</option>`
                    );
                    provinceNames[province.id] = province.name_th;
                });
            });

            // Handle province selection
            $('#Province').change(function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find('option:selected').data('name');
                $('#ProvinceName').val(provinceName); // Update hidden input with province name

                let districtSelect = $('#District');
                let subdistrictSelect = $('#Subdistrict');
                districtSelect.empty().append('<option value="">เลือกอำเภอ</option>');
                subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

                let selectedProvince = provincesData.find(prov => prov.id == provinceId);
                if (selectedProvince) {
                    selectedProvince.amphure.forEach(function(district) {
                        districtSelect.append(
                            `<option value="${district.id}" data-name="${district.name_th}">${district.name_th}</option>`
                        );
                        districtNames[district.id] = district.name_th;
                    });
                }
            });

            // Handle district selection
            $('#District').change(function() {
                let districtId = $(this).val();
                let districtName = $(this).find('option:selected').data('name');
                $('#DistrictName').val(districtName); // Update hidden input with district name

                let subdistrictSelect = $('#Subdistrict');
                subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

                let selectedProvince = provincesData.find(prov => prov.id == $('#Province').val());
                let selectedDistrict = selectedProvince.amphure.find(dist => dist.id == districtId);
                if (selectedDistrict) {
                    selectedDistrict.tambon.forEach(function(subdistrict) {
                        subdistrictSelect.append(
                            `<option value="${subdistrict.id}" data-zip="${subdistrict.zip_code}" data-name="${subdistrict.name_th}">${subdistrict.name_th}</option>`
                        );
                        subdistrictNames[subdistrict.id] = subdistrict.name_th;
                    });
                }
            });

            // Handle subdistrict selection
            $('#Subdistrict').change(function() {
                let subdistrictName = $(this).find('option:selected').data('name');
                let zipCode = $(this).find('option:selected').data('zip');
                $('#SubdistrictName').val(subdistrictName); // Update hidden input with subdistrict name
                $('#postalCode').val(zipCode); // Set the postal code based on the selected subdistrict
            });
        });

        function combineNameAndAddress() {
            var houseNumber = document.getElementById('houseNumber').value;
            var village = document.getElementById('village').value;
            var subdistrict = document.getElementById('SubdistrictName').value;
            var district = document.getElementById('DistrictName').value;
            var province = document.getElementById('ProvinceName').value;
            var postalCode = document.getElementById('postalCode').value;

            var address =
                `บ้านเลขที่ ${houseNumber} หมู่ ${village} ตำบล ${subdistrict} อำเภอ ${district} จังหวัด ${province} รหัสไปรษณีย์ ${postalCode}`;
            document.getElementById('Address').value = address;
        }
    </script>
    </script>
@endsection

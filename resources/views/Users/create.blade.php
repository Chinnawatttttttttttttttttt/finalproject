@extends('layouts.app')

@section('content')
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>เพิ่มข้อมูลผู้ใช้งาน</h1>
            </div>
            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title and Name -->
                    <div class="form-row">
                        <div class="form-group col-md-2">
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

                        <div class="form-group col-md-4">
                            <label for="FirstName">ชื่อ:</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                            @error('FirstName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="LastName">นามสกุล:</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" required>
                            @error('LastName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nick Name -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="NickName">ชื่อเล่น:</label>
                            <input type="text" class="form-control" id="NickName" name="NickName" required>
                            @error('NickName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Username and Password -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="Username">ชื่อผู้ใช้:</label>
                            <input type="text" class="form-control" id="Username" name="Username" pattern="\d{13}"
                                title="Username must be 13 digits" placeholder="กรุณากรอกชื่อผู้ใช้ 13 หลัก" required>
                            @error('Username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label for="Password">รหัสผ่าน:</label>
                            <input type="password" class="form-control" id="Password" name="Password" pattern="\d{6}"
                                placeholder="กรุณากรอกรหัสผ่าน 6 หลัก" required>
                            @error('Password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="from-group col-md-6">
                            <label for="Email">อีเมล:</label>
                            <input type="email" class="form-control" id="Email" name="Email" required>
                            @error('Email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="from-group col-md-3">
                            <label for="Phone">เบอร์โทร:</label>
                            <input type="phone" class="form-control" id="Phone" name="Phone" required>
                            @error('Phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <!-- Province -->
                        <div class="form-group col-md-3">
                            <label for="province">จังหวัด:</label>
                            <select class="form-control" id="Province" name="province" required>
                                <option value="">เลือกจังหวัด</option>
                            </select>
                            @error('province')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- District -->

                        <div class="form-group col-md-3">
                            <label for="district">อำเภอ:</label>
                            <select class="form-control" id="District" name="district" required>
                                <option value="">เลือกอำเภอ</option>
                            </select>
                            @error('district')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Subdistrict -->

                        <div class="form-group col-md-3">
                            <label for="subdistrict">ตำบล:</label>
                            <select class="form-control" id="Subdistrict" name="subdistrict" required>
                                <option value="">เลือกตำบล</option>
                            </select>
                            @error('subdistrict')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <!-- Address -->
                    <div class="form-row">
                        <!-- Postal Code -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postalCode">รหัสไปรษณีย์:</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="village">หมู่:</label>
                            <input type="text" class="form-control" id="village" name="village" required>
                            @error('village')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="houseNumber">บ้านเลขที่:</label>
                            <input type="text" class="form-control" id="houseNumber" name="houseNumber" required>
                            @error('houseNumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden field to store combined address -->
                    <input type="hidden" id="Address" name="Address">
                    <!-- Hidden fields to store names -->
                    <input type="hidden" id="ProvinceName" name="provinceName">
                    <input type="hidden" id="DistrictName" name="districtName">
                    <input type="hidden" id="SubdistrictName" name="subdistrictName">

                    <!-- Phone, Department, Position, and Profile Image -->
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="department">แผนก:</label>
                            <select class="form-control" name="department_id" id="department" required>
                                @foreach ($dpt as $id => $name)
                                    <option value="{{ $id }}" {{ $id == $selectedID ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="position">ตำแหน่ง:</label>
                            <select class="form-control" name="position_id" id="position" required>
                                @foreach ($position as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="image_Profile">รูปโปรไฟล์:</label>
                            <input type="file" class="form-control-file" id="image_Profile" name="image_Profile"
                                onchange="previewImage()" required>
                            <div id="image-preview" class="mt-3"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"
                            onclick="combineNameAndAddress()">บันทึกข้อมูล</button>
                        <a href="{{ route('all-user') }}" class="btn btn-danger">ย้อนกลับ</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to combine title, first name, and address
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

        function previewImage() {
            const fileInput = document.getElementById('image_Profile');
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear any previous previews

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('profile-image'); // Add the profile-image class
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
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
    </script>
@endsection

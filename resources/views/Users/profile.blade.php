@extends('layouts.app')

@section('content')
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .card-user .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-user .author {
            margin-bottom: 20px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">แก้ไข โปรไฟล์</h4>
                            <h5 class="card-title">สามารถแก้ไขข้อมูลโปรไฟล์ได้</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Title">คำนำหน้า:</label>
                                            <select class="form-control" id="Title" name="Title" required>
                                                <option value="">เลือกคำนำหน้า</option>
                                                <option value="นาย"
                                                    {{ old('Title', $user->Title) == 'นาย' ? 'selected' : '' }}>นาย</option>
                                                <option value="นาง"
                                                    {{ old('Title', $user->Title) == 'นาง' ? 'selected' : '' }}>นาง</option>
                                                <option value="นางสาว"
                                                    {{ old('Title', $user->Title) == 'นางสาว' ? 'selected' : '' }}>นางสาว
                                                </option>
                                            </select>
                                            @error('Title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control" name="FirstName"
                                                value="{{ old('FirstName', $user->FirstName) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" name="LastName"
                                                value="{{ old('LastName', $user->LastName) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>อีเมลล์</label>
                                            <input type="email" class="form-control" name="Email"
                                                value="{{ old('Email', $user->Email) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Province -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="province">จังหวัด:</label>
                                            <select class="form-control" id="Province" name="province" required>
                                                <option value="{{ old('province', $province) }}">เลือกจังหวัด</option>
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
                                                <option value="{{ old('district', $district) }}">เลือกอำเภอ</option>
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
                                                <option value="{{ old('subdistrict', $subdistrict) }}">เลือกตำบล</option>
                                            </select>
                                            @error('subdistrict')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Postal Code -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="postalCode">รหัสไปรษณีย์:</label>
                                            <input type="text" class="form-control" id="postalCode" name="postalCode"
                                                value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="village">หมู่:</label>
                                            <input type="text" class="form-control" id="village" name="village"
                                                value="{{ old('village', $village) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="houseNumber">บ้านเลขที่:</label>
                                            <input type="text" class="form-control" id="houseNumber" name="houseNumber"
                                                value="{{ old('houseNumber', $houseNumber) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <!-- Hidden field to store combined address -->
                                        <input type="hidden" id="Address" name="Address"
                                            value="{{ old('Address', $user->Address) }}">
                                        <!-- Hidden fields to store names -->
                                        <input type="hidden" id="ProvinceName" name="provinceName">
                                        <input type="hidden" id="DistrictName" name="districtName">
                                        <input type="hidden" id="SubdistrictName" name="subdistrictName">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" name="Phone"
                                                value="{{ old('Phone', $user->Phone) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>รูปภาพ</label>
                                            <input type="file" class="form-control-file" id="image_Profile"
                                                name="profile_image" onchange="previewImage1()">
                                            <div id="image-preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right"
                                    onclick="combineNameAndAddress()">อัพโหลด</button>
                                <button type="button" id="change-password-btn"
                                    class="btn btn-warning btn-fill pull-right">เปลี่ยนรหัสผ่าน</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-header">
                            <h4 class="card-title">โปรไฟล์</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="author">
                                @if ($user->image_Profile)
                                    <img src="{{ url('images/' . $user->image_Profile) }}" alt="Profile Image"
                                        class="profile-image">
                                @else
                                    <h5 class="title">{{ $user->FirstName }} {{ $user->LastName }}</h5>
                                @endif
                                <p class="description">
                                    Username: {{ $user->Username }} <br>
                                    ชื่อ-นามกุล :{{ $user->Title }}{{ $user->FirstName }} {{ $user->LastName }} <br>
                                    ชื่อเล่น : {{ $user->NickName }} <br>
                                    Email: {{ $user->Email }} <br>
                                    เบอร์โทรศัพท์ : {{ $user->Phone }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('change-password') }}" method="POST">
                @csrf
                @method('PATCH')
                <h4>เปลี่ยนรหัสผ่าน</h4>
                <div class="form-group">
                    <label>รหัสผ่านปัจจุบัน</label>
                    <input type="password" class="form-control" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>รหัสผ่านใหม่</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>
                <div class="form-group">
                    <label>ยืนยันรหัสผ่านใหม่</label>
                    <input type="password" class="form-control" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success btn-fill">เปลี่ยนรหัสผ่าน</button>
                <button type="button" id="close-modal-btn" class="btn btn-danger btn-fill">ปิด</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("passwordModal");

        // Get the button that opens the modal
        var btn = document.getElementById("change-password-btn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the button that closes the modal
        var closeModalBtn = document.getElementById("close-modal-btn");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks on the close modal button, close the modal
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        $(document).ready(function() {
            var provincesData = [];
            var provinceNames = {};
            var districtNames = {};
            var subdistrictNames = {};

            // โหลดข้อมูลจังหวัดจาก JSON
            $.getJSON("{{ url('API/api_province_with_amphure_tambon.json') }}", function(data) {
                provincesData = data;
                let provinceSelect = $('#Province');

                // เติมข้อมูลจังหวัดใน dropdown และ mapping object
                provincesData.forEach(function(province) {
                    provinceSelect.append(
                        `<option value="${province.id}">${province.name_th}</option>`
                    );
                    provinceNames[province.id] = province.name_th;

                    province.amphure.forEach(function(district) {
                        districtNames[district.id] = district.name_th;

                        district.tambon.forEach(function(subdistrict) {
                            subdistrictNames[subdistrict.id] = subdistrict.name_th;
                        });
                    });
                });

                // ตั้งค่าจังหวัดที่เลือกตาม name_th
                var selectedProvinceName = "{{ old('province', $province) }}";
                if (selectedProvinceName) {
                    let selectedProvince = provincesData.find(prov => prov.name_th == selectedProvinceName);
                    if (selectedProvince) {
                        $('#Province').val(selectedProvince.id).trigger('change');
                    }
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Failed to load JSON:", textStatus, errorThrown);
            });

            // การจัดการการเปลี่ยนจังหวัด
            $('#Province').change(function() {
                let provinceId = $(this).val();
                let districtSelect = $('#District');
                let subdistrictSelect = $('#Subdistrict');
                districtSelect.empty().append('<option value="">เลือกอำเภอ</option>');
                subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

                let selectedProvince = provincesData.find(prov => prov.id == provinceId);
                if (selectedProvince) {
                    selectedProvince.amphure.forEach(function(district) {
                        districtSelect.append(
                            `<option value="${district.id}">${district.name_th}</option>`
                        );
                    });

                    $('#ProvinceName').val(provinceNames[provinceId]);

                    var selectedDistrictName = "{{ old('district', $district) }}";
                    if (selectedDistrictName) {
                        $('#District').val(selectedProvince.amphure.find(dist => dist.name_th ==
                            selectedDistrictName)?.id).trigger('change');
                    }
                }
            });

            // การจัดการการเปลี่ยนอำเภอ
            $('#District').change(function() {
                let districtId = $(this).val();
                let subdistrictSelect = $('#Subdistrict');
                subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

                let selectedProvince = provincesData.find(prov => prov.id == $('#Province').val());
                let selectedDistrict = selectedProvince.amphure.find(dist => dist.id == districtId);
                if (selectedDistrict) {
                    selectedDistrict.tambon.forEach(function(subdistrict) {
                        subdistrictSelect.append(
                            `<option value="${subdistrict.id}" data-zip="${subdistrict.zip_code}">${subdistrict.name_th}</option>`
                        );
                    });

                    $('#DistrictName').val(districtNames[districtId]);

                    var selectedSubdistrictName = "{{ old('subdistrict', $subdistrict) }}";
                    if (selectedSubdistrictName) {
                        $('#Subdistrict').val(selectedDistrict.tambon.find(tam => tam.name_th ==
                            selectedSubdistrictName)?.id);
                        $('#postalCode').val(selectedDistrict.tambon.find(tam => tam.name_th ==
                            selectedSubdistrictName)?.zip_code);
                        $('#SubdistrictName').val(subdistrictNames[$('#Subdistrict').val()] || "");
                    }
                }
            });

            // การจัดการการเปลี่ยนตำบล
            $('#Subdistrict').change(function() {
                let subdistrictId = $(this).val();
                $('#SubdistrictName').val(subdistrictNames[subdistrictId] || "");
                let zipCode = $(this).find(':selected').data('zip');
                $('#postalCode').val(zipCode);
            });

            // ตั้งค่า `#SubdistrictName` ตอนที่โหลดหน้าเว็บ
            (function setInitialSubdistrictName() {
                let subdistrictId = $('#Subdistrict').val();
                $('#SubdistrictName').val(subdistrictNames[subdistrictId] || "");
            })();
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

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Province Name:', document.getElementById('ProvinceName').value);
            console.log('District Name:', document.getElementById('DistrictName').value);
            console.log('Subdistrict Name:', document.getElementById('SubdistrictName').value);
        });

        function previewImage1() {
            const fileInput = document.getElementById('image_Profile');
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear any previous previews

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('profile-image');
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

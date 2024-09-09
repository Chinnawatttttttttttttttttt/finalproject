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
            <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row mb-3">
                    <!-- Title -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Title">คำนำหน้า:</label>
                            <select class="form-control" id="Title" name="Title" required>
                                <option value="">เลือกคำนำหน้า</option>
                                <option value="นาย" {{ old('Title', $user->Title) == 'นาย' ? 'selected' : '' }}>นาย</option>
                                <option value="นาง" {{ old('Title', $user->Title) == 'นาง' ? 'selected' : '' }}>นาง</option>
                                <option value="นางสาว" {{ old('Title', $user->Title) == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                            </select>
                            @error('Title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- First Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FirstName">ชื่อ</label>
                            <input type="text" name="FirstName" class="form-control" value="{{ old('FirstName', $user->FirstName) }}">
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="LastName">นามสกุล</label>
                            <input type="text" name="LastName" class="form-control" value="{{ old('LastName', $user->LastName) }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Nick Name -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="NickName">ชื่อเล่น</label>
                            <input type="text" name="NickName" class="form-control" value="{{ old('NickName', $user->NickName) }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Username -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Username">ชื่อผู้ใช้งาน</label>
                            <input type="text" name="Username" class="form-control" value="{{ old('Username', $user->Username) }}">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Password">รหัสผ่าน</label>
                            <input type="password" name="Password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email">อีเมล</label>
                            <input type="email" name="Email" class="form-control" value="{{ old('Email', $user->Email) }}">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Phone">เบอร์โทร</label>
                            <input type="text" name="Phone" class="form-control" value="{{ old('Phone', $user->Phone) }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="houseNumber">บ้านเลขที่:</label>
                                    <input type="text" class="form-control" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $houseNumber) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="village">หมู่:</label>
                                    <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $village) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="subdistrict">ตำบล:</label>
                                    <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $subdistrict) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="district">อำเภอ:</label>
                                    <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $district) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province">จังหวัด:</label>
                                    <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $province) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postalCode">รหัสไปรษณีย์:</label>
                                    <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ old('postalCode', $postalCode) }}">
                                </div>
                            </div>
                        </div>
                        <!-- Hidden field to store combined address -->
                        <input type="hidden" id="Address" name="Address">
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Position -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="position_id">ตำแหน่ง</label>
                            <select name="position_id" class="form-control">
                                @foreach ($position as $id => $positionName)
                                    <option value="{{ $id }}" {{ old('position_id', $user->position_id) == $id ? 'selected' : '' }}>
                                        {{ $positionName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="department_id">แผนก</label>
                            <select name="department_id" class="form-control">
                                @foreach ($dpt as $id => $department)
                                    <option value="{{ $id }}" {{ old('department_id', $user->department_id) == $id ? 'selected' : '' }}>
                                        {{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Image Profile -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_Profile">รูปภาพ</label>
                            <input type="file" id="image_Profile" name="image_Profile" class="form-control" onchange="previewImage()">
                            <div id="image-preview" class="mt-2">
                                @if ($user->image_Profile)
                                    <img src="{{ asset('images/' . $user->image_Profile) }}" alt="Profile Image" class="profile-image mt-2">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary" onclick="combineNameAndAddress()">บันทึก</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger">ย้อนกลับ</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function combineNameAndAddress() {
        const houseNumber = document.getElementById('houseNumber').value;
        const village = document.getElementById('village').value;
        const subdistrict = document.getElementById('subdistrict').value;
        const district = document.getElementById('district').value;
        const province = document.getElementById('province').value;
        const postalCode = document.getElementById('postalCode').value;

        // Combine address
        const address = 'บ้านเลขที่ ' + houseNumber + ' หมู่บ้าน ' + village + ' ตำบล ' + subdistrict + ' อำเภอ ' +
            district + ' จังหวัด ' + province + ' รหัสไปรษณีย์ ' + postalCode;
        document.getElementById('Address').value = address;

        console.log('Combined Address:', address); // For debugging
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
</script>


@endsection

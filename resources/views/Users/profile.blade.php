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
                        <h5  class="card-title">สามารถแก้ไขข้อมูลโปรไฟล์ได้</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อ</label>
                                        <input type="text" class="form-control" name="FirstName" value="{{ old('FirstName', $user->FirstName) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>นามสกุล</label>
                                        <input type="text" class="form-control" name="LastName" value="{{ old('LastName', $user->LastName) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>อีเมลล์</label>
                                        <input type="email" class="form-control" name="Email" value="{{ old('Email', $user->Email) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Address Fields -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="houseNumber">บ้านเลขที่:</label>
                                        <input type="text" class="form-control" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $houseNumber) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="village">หมู่:</label>
                                        <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $village) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subdistrict">ตำบล:</label>
                                        <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $subdistrict) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="district">อำเภอ:</label>
                                        <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $district) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="province">จังหวัด:</label>
                                        <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $province) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="postalCode">รหัสไปรษณีย์:</label>
                                        <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ old('postalCode', $postalCode) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!-- Hidden field to store combined address -->
                                    <input type="hidden" id="Address" name="Address" value="{{ old('Address', $user->Address) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" name="Phone" value="{{ old('Phone', $user->Phone) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>รูปภาพ</label>
                                        <input type="file" class="form-control-file" name="profile_image">
                                        <div id="image-preview" class="mt-3"></div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right" onclick="combineNameAndAddress()">อัพโหลด</button>
                                        <button type="button" id="change-password-btn" class="btn btn-warning btn-fill pull-right">เปลี่ยนรหัสผ่าน</button>
                                    </div>
                                </div>
                            </div>
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
                                <img src="{{ asset('images/'.$user->image_Profile) }}" alt="Profile Image" class="profile-image">
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
                        {{--  <hr>
                        <div class="button-container mr-auto ml-auto">
                            <button href="#" class="btn btn-simple btn-link btn-icon">
                                <i class="fa fa-facebook-square"></i>
                            </button>
                            <button href="#" class="btn btn-simple btn-link btn-icon">
                                <i class="fa fa-twitter"></i>
                            </button>
                            <button href="#" class="btn btn-simple btn-link btn-icon">
                                <i class="fa fa-google-plus-square"></i>
                            </button>
                        </div>  --}}
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

    // When the user clicks on <span> (x) or the close button, close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

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

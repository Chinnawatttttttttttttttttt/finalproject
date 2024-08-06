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

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
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
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="Email" value="{{ old('Email', $user->Email) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ที่อยู่</label>
                                        <input type="text" class="form-control" name="Address" value="{{ old('Address', $user->Address) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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
                                        <button type="submit" class="btn btn-info btn-fill pull-right">อัพโหลด</button>
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
                        <h4 class="card-title">Profile</h4>
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
                                ชื่อ-นามกุล : {{ $user->FirstName }} {{ $user->LastName }} <br>
                                ชื่อเล่น : {{ $user->NickName }} <br>
                                Email: {{ $user->Email }} <br>
                                เบอร์โทรศัพท์ : {{ $user->Phone }}
                            </p>
                        </div>
                        <hr>
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
</script>

@endsection

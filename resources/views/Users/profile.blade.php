@extends('layouts.app')

@section('content')

<style>
    .profile-image {
        width: 150px; /* กำหนดความกว้างของรูปภาพ */
        height: 150px; /* กำหนดความสูงของรูปภาพ */
        object-fit: cover; /* ปรับขนาดรูปให้พอดีกับตำแหน่งที่กำหนด */
        border-radius: 50%; /* ทำให้มีรูปร่างวงกลม */
    }

    .card-user .card-body {
        padding: 20px;
        text-align: center; /* จัดให้ข้อความและรูปภาพอยู่ตรงกลาง */
    }

    .card-user .author {
        margin-bottom: 20px; /* ปรับระยะห่างของข้อมูลผู้ใช้ */
    }
</style>



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
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="FirstName" value="{{ old('FirstName', $user->FirstName) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
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
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="Address" value="{{ old('Address', $user->Address) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="Phone" value="{{ old('Phone', $user->Phone) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="form-control-file" name="profile_image">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
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
                                First Name: {{ $user->FirstName }} <br>
                                Last Name: {{ $user->LastName }} <br>
                                Nickname: {{ $user->NickName }} <br>
                                Email: {{ $user->Email }} <br>
                                Phone: {{ $user->Phone }}
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
@endsection

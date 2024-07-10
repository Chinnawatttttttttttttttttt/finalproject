@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="FirstName">ชื่อ</label>
            <input type="text" name="FirstName" class="form-control" value="{{ $user->FirstName }}">
        </div>
        <div class="form-group">
            <label for="LastName">นามสกุล</label>
            <input type="text" name="LastName" class="form-control" value="{{ $user->LastName }}">
        </div>
        <div class="form-group">
            <label for="NickName">ชื่อเล่น</label>
            <input type="text" name="NickName" class="form-control" value="{{ $user->NickName }}">
        </div>
        <div class="form-group">
            <label for="Username">ชื่อผู้ใช้งาน</label>
            <input type="text" name="Username" class="form-control" value="{{ $user->Username }}">
        </div>
        <div class="form-group">
            <label for="Password">รหัสผ่าน</label>
            <input type="password" name="Password" class="form-control">
        </div>
        <div class="form-group">
            <label for="Email">อีเมล</label>
            <input type="email" name="Email" class="form-control" value="{{ $user->Email }}">
        </div>
        <div class="form-group">
            <label for="Address">ที่อยู่</label>
            <input type="text" name="Address" class="form-control" value="{{ $user->Address }}">
        </div>
        <div class="form-group">
            <label for="Phone">เบอร์โทร</label>
            <input type="text" name="Phone" class="form-control" value="{{ $user->Phone }}">
        </div>
        <div class="form-group">
            <label for="department_id">แผนก</label>
            <select name="department_id" class="form-control">
                @foreach($dpt as $id => $department)
                    <option value="{{ $id }}" {{ $user->department_id == $id ? 'selected' : '' }}>{{ $department }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position_id">ตำแหน่ง</label>
            <select name="position_id" class="form-control">
                @foreach($position as $id => $positionName)
                    <option value="{{ $id }}" {{ $user->position_id == $id ? 'selected' : '' }}>{{ $positionName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image_Profile">รูปภาพ</label>
            <input type="file" name="image_Profile" class="form-control">
            @if($user->image_Profile)
                <img src="{{ asset('storage/' . $user->image_Profile) }}" alt="Profile Image" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>
@endsection

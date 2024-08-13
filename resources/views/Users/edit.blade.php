@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Title -->
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

        <!-- Address -->
        <div class="form-group">
            <label for="houseNumber">บ้านเลขที่:</label>
            <input type="text" class="form-control" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $houseNumber) }}">
        </div>

        <div class="form-group">
            <label for="village">หมู่:</label>
            <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $village) }}">
        </div>

        <div class="form-group">
            <label for="subdistrict">ตำบล:</label>
            <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $subdistrict) }}">
        </div>

        <div class="form-group">
            <label for="district">อำเภอ:</label>
            <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $district) }}">
        </div>

        <div class="form-group">
            <label for="province">จังหวัด:</label>
            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $province) }}">
        </div>

        <div class="form-group">
            <label for="postalCode">รหัสไปรษณีย์:</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ old('postalCode', $postalCode) }}">
        </div>

        <!-- Hidden field to store combined address -->
        <input type="hidden" id="Address" name="Address">

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
        <button type="submit" class="btn btn-primary" onclick="combineNameAndAddress()">บันทึก</button>
    </form>
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
        {{--  const address = `บ้านเลขที่ ${houseNumber} หมู่บ้าน ${village} ตำบล ${subdistrict} อำเภอ ${district} จังหวัด ${province} รหัสไปรษณีย์ ${postalCode}`;  --}}
        const address = 'บ้านเลขที่ ' + houseNumber + ' หมู่บ้าน ' + village + ' ตำบล ' + subdistrict + ' อำเภอ ' + district + ' จังหวัด ' + province + ' รหัสไปรษณีย์ ' + postalCode;
        document.getElementById('Address').value = address;
        
        console.log('Combined Address:', address); // For debugging
    }
</script>

@endsection

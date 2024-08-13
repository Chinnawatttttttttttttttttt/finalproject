@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">เพิ่มข้อมูลผู้ใช่งาน</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
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

        <div class="form-group">
            <label for="FirstName">First Name:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" required>
        </div>
        <div class="form-group">
            <label for="LastName">Last Name:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" required>
        </div>
        <div class="form-group">
            <label for="NickName">Nick Name:</label>
            <input type="text" class="form-control" id="NickName" name="NickName">
        </div>
        <div class="form-group">
            <label for="Username">Username:</label>
            <input type="text" class="form-control" id="Username" name="Username" pattern="\d{13}" title="Username must be 13 digits" required>
        </div>
        <div class="form-group">
            <label for="Password">Password:</label>
            <input type="password" class="form-control" id="Password" name="Password" required>
        </div>
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" class="form-control" id="Email" name="Email" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="houseNumber">บ้านเลขที่:</label>
            <input type="text" class="form-control" id="houseNumber" name="houseNumber">
        </div>

        <div class="form-group">
            <label for="village">หมู่:</label>
            <input type="text" class="form-control" id="village" name="village">
        </div>

        <div class="form-group">
            <label for="subdistrict">ตำบล:</label>
            <input type="text" class="form-control" id="subdistrict" name="subdistrict">
        </div>

        <div class="form-group">
            <label for="district">อำเภอ:</label>
            <input type="text" class="form-control" id="district" name="district">
        </div>

        <div class="form-group">
            <label for="province">จังหวัด:</label>
            <input type="text" class="form-control" id="province" name="province">
        </div>

        <div class="form-group">
            <label for="postalCode">รหัสไปรษณีย์:</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode">
        </div>

        <!-- Hidden field to store combined address -->
        <input type="hidden" id="Address" name="Address">

        <div class="form-group">
            <label for="Phone">Phone:</label>
            <input type="text" class="form-control" id="Phone" name="Phone" required>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <select class="form-control" name="department_id" id="department" required>
                @foreach($dpt as $id => $name)
                    <option value="{{ $id }}" {{ $id == $selectedID ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <select class="form-control" name="position_id" id="position" required>
                @foreach($position as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image_Profile">Profile Image:</label>
            <input type="file" class="form-control-file" id="image_Profile" name="image_Profile">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" onclick="combineNameAndAddress()">บันทึก</button>
        </div>
    </form>
</div>

<script>
    // Function to combine title, first name, and address
    function combineNameAndAddress() {

        // Get values from individual address fields
        var houseNumber = document.getElementById('houseNumber').value;
        console.log('1',houseNumber);
        var village = document.getElementById('village').value;
        console.log('2',village);
        var subdistrict = document.getElementById('subdistrict').value;
        console.log('3',subdistrict);
        var district = document.getElementById('district').value;
        console.log('4',district);
        var province = document.getElementById('province').value;
        console.log('5',province);
        var postalCode = document.getElementById('postalCode').value;
        console.log('6',postalCode);

        // Combine values into full address only if all fields are filled
        if (houseNumber || village || subdistrict || district || province || postalCode) {
            console.log('test')
            var fullAddress = 'บ้านเลขที่ ' + houseNumber + ' หมู่ ' + village + ' ตำบล ' + subdistrict + ' อำเภอ ' + district + ' จังหวัด ' + province + ' รหัสไปรษณีย์ ' + postalCode;
            document.getElementById('Address').value = fullAddress;
        } else {
            document.getElementById('Address').value = null; // Clear FullAddress if any field is empty
        }
    }

    document.forms[0].onsubmit = function() {
        combineNameAndAddress();
    }
</script>
@endsection

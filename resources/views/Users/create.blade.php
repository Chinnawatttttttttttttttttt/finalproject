@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>เพิ่มข้อมูลผู้ใช้งาน</h1>
        </div>
        <div class="card-body">
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
                    </div>
                    <div class="form-group col-md-4">
                        <label for="LastName">นามสกุล:</label>
                        <input type="text" class="form-control" id="LastName" name="LastName" required>
                    </div>
                </div>

                <!-- Nick Name and Username -->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="NickName">ชื่อเล่น:</label>
                        <input type="text" class="form-control" id="NickName" name="NickName">
                    </div>
                </div>

                <!-- Password and Email -->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="Username">ชื่อผู้ใช้:</label>
                        <input type="text" class="form-control" id="Username" name="Username" pattern="\d{13}" title="Username must be 13 digits" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Password">รหัสผ่าน:</label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Email">อีเมล:</label>
                        <input type="email" class="form-control" id="Email" name="Email" required>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="houseNumber">บ้านเลขที่:</label>
                        <input type="text" class="form-control" id="houseNumber" name="houseNumber">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="village">หมู่:</label>
                        <input type="text" class="form-control" id="village" name="village">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="subdistrict">ตำบล:</label>
                        <input type="text" class="form-control" id="subdistrict" name="subdistrict">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="district">อำเภอ:</label>
                        <input type="text" class="form-control" id="district" name="district">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="province">จังหวัด:</label>
                        <input type="text" class="form-control" id="province" name="province">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="postalCode">รหัสไปรษณีย์:</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode">
                    </div>
                </div>

                <!-- Hidden field to store combined address -->
                <input type="hidden" id="Address" name="Address">

                <!-- Phone, Department, Position, and Profile Image -->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="department">แผนก:</label>
                        <select class="form-control" name="department_id" id="department" required>
                            @foreach($dpt as $id => $name)
                                <option value="{{ $id }}" {{ $id == $selectedID ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="position">ตำแหน่ง:</label>
                        <select class="form-control" name="position_id" id="position" required>
                            @foreach($position as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="image_Profile">รูปโปรไฟล์:</label>
                        <input type="file" class="form-control-file" id="image_Profile" name="image_Profile">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary" onclick="combineNameAndAddress()">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to combine title, first name, and address
    function combineNameAndAddress() {
        // Get values from individual address fields
        var houseNumber = document.getElementById('houseNumber').value;
        var village = document.getElementById('village').value;
        var subdistrict = document.getElementById('subdistrict').value;
        var district = document.getElementById('district').value;
        var province = document.getElementById('province').value;
        var postalCode = document.getElementById('postalCode').value;

        // Combine values into full address only if all fields are filled
        if (houseNumber || village || subdistrict || district || province || postalCode) {
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

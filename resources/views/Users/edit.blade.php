<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">แก้ไขข้อมูลผู้ใช้งาน</h1>
        <form action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data" method="POST">
            @csrf

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

            <div class="form-group">
                <label for="FirstName">First Name:</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" required value="{{ $user->FirstName }}">
                @error('FirstName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="LastName">Last Name:</label>
                <input type="text" class="form-control" id="LastName" name="LastName" required value="{{ $user->LastName }}">
                @error('LastName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="NickName">Nick Name:</label>
                <input type="text" class="form-control" id="NickName" name="NickName" value="{{ $user->NickName }}">
                @error('NickName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Username">Username:</label>
                <input type="text" class="form-control" id="Username" name="Username" pattern="\d{13}" title="Username must be 13 digits" required value="{{ $user->Username }}">
                @error('Username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" id="Password" name="Password">
                @error('Password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" id="Email" name="Email" required value="{{ $user->Email }}">
                @error('Email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" name="Address" required value="{{ $user->Address }}">
                @error('Address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" required value="{{ $user->Phone }}">
                @error('Phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control" name="department_id" id="department" required>
                    @foreach($dpt as $id => $name)
                        <option value="{{ $id }}" {{ $id == $user->department_id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <select class="form-control" name="position_id" id="position" required>
                    @foreach($position as $id => $name)
                        <option value="{{ $id }}" {{ $id == $user->position_id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('position_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image_Profile">Profile Image:</label>
                <img id="previewImg" src="{{ asset('images') }}/{{ $user->profileimage }}" alt="image" style="max-width: 50px; max-height: 50px; margin-top: 20px;">
                   @error('image_Profile')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
</body>
</html>

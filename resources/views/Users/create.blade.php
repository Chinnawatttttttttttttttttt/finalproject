<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ผู้ใช่งาน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
            <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" name="Address" required>
            </div>
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
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

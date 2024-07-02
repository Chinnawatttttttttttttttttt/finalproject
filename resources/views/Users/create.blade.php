<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ผู้ใช่งาน</title>
</head>
<body>
    <h1>เพิ่มข้อมูลผู้ใช่งาน</h1>

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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="FirstName">First Name:</label>
            <input type="text" id="FirstName" name="FirstName" required>
        </div>
        <div>
            <label for="LastName">Last Name:</label>
            <input type="text" id="LastName" name="LastName" required>
        </div>
        <div>
            <label for="NickName">Nick Name:</label>
            <input type="text" id="NickName" name="NickName">
        </div>
        <div>
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username" required>
        </div>
        <div>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" required>
        </div>
        <div>
            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" required>
        </div>
        <div>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" required>
        </div>
        <div>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" required>
        </div>
        <div>
            <label for="DPT_id">Department ID:</label>
            <input type="number" id="DPT_id" name="DPT_id" required>
        </div>
        <div>
            <label for="department_name">Department Name:</label>
            <input type="text" id="department_name" name="department_name" required>
        </div>
        <div>
            <label for="PT_id">Position ID:</label>
            <input type="number" id="PT_id" name="PT_id" required>
        </div>
        <div>
            <label for="position_name">Position Name:</label>
            <input type="text" id="position_name" name="position_name" required>
        </div>
        <div>
            <label for="image_Profile">Profile Image:</label>
            <input type="file" id="image_Profile" name="image_Profile">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
    </form>

</body>
</html>

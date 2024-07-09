<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            @if(session('fail'))
                {{ session('fail') }}
            @else
                ข้อผิดพลาดไม่ทราบสาเหตุ
            @endif
        </div>
        <!-- ปุ่มกลับไปยังหน้าที่ผู้ใช้มาก่อนหน้านี้ -->
        <button onclick="history.back()" class="btn btn-primary">Go Back</button>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Position</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Create Position</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('fail'))
            <div class="alert alert-danger">{{ session('fail') }}</div>
        @endif

        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            {{--  <div class="form-group">
                <label for="ID_Position">รหัสตำแหน่ง:</label>
                <input type="text" class="form-control" id="ID_Position" name="ID_Position" pattern="\d{3}" title="รหัสต้องเป็นตัวเลข 000-999 เท่านั้น" required>
            </div>  --}}
            <div class="form-group">
                <label for="position_name">ชื่อตำแหน่ง:</label>
                <input type="text" class="form-control" id="position_name" name="position_name" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{ url('all-position') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> กลับ </a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

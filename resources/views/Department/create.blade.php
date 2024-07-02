<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-5e2ESR8Ycmos6g3gAKr1Jvwye8sW4U1u/cAKulfVJnkakCcMqhOudbtPnvJ+nbv7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Create Department</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('fail'))
            <div class="alert alert-danger">{{ session('fail') }}</div>
        @endif

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="department_name">ชื่อตำแหน่ง:</label>
                <input type="text" class="form-control" id="department_name" name="department_name" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{ url('all-department') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> กลับ </a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

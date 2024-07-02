<!-- resources/views/users/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ใช้งาน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>รายชื่อผู้ใช้งาน</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->FirstName }}</td>
                    <td>{{ $user->LastName }}</td>
                    <td>{{ $user->Email }}</td>
                    <td>
                        @foreach ($dpt as $department)
                            @if ($department->id === $user->department_id)
                                {{ $department->department_name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($position as $positions)
                            @if ($positions->id === $user->position_id)
                                {{ $positions->position_name }}
                            @endif
                        @endforeach
                    </td>
                    {{--  <td>
                        <!-- สร้างลิงก์ไปยังหน้าแก้ไขและลบ -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">แก้ไข</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการลบผู้ใช้งานนี้ใช่หรือไม่?')">ลบ</button>
                        </form>
                    </td>  --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!-- resources/views/users/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ใช้งาน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
@include('layout.nav');
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
                    <th>แก้ไข้ข้อมูล</th>
                    <th>ลบข้อมูล</th>
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
                    <td><a href="/edit-user/{{ $user->id}}" class="btn btn-warning"><i class="fas fa-edit"></i> แก้ไข </a></td>
                    <td>
                      <form action="{{ route('users.delete',$user->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i> ลบ </button>
                      </form>
                    </td>
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

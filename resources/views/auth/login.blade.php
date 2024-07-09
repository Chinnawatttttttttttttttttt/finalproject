<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5">Login</h2>
                @if(Session::has('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <form action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="login">ชื่อผู้ใช้หรืออีเมล</label>
                        <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" required>
                        @error('login')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

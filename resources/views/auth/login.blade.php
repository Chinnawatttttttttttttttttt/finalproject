<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการประเมินสภาวะของผู้สูงอายุ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Unicons CSS -->
    <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }

        .header {
            background-color: #6f42c1;
            color: white;
            padding: 15px;
            text-align: start;
            position: relative;
        }

        .header img {
            width: 80px;
            position: absolute;
            left: 50px;
            top: 10px;
        }

        .nav-links {
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .nav-links a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        .nav-links span {
            color: white;
            font-weight: bold;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .card-3d-wrap {
            position: relative;
            width: 440px;
            max-width: 100%;
            height: 400px;
            perspective: 800px;
            margin-top: 60px;
        }

        .card-3d-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            transition: all 600ms ease-out;
        }

        .card-front {
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .center-wrap {
            position: absolute;
            width: 100%;
            padding: 0 35px;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 20;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-style {
            padding: 13px 20px;
            height: 48px;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            color: #333;
        }

        .form-style:focus {
            border-color: #6f42c1;
            outline: none;
        }

        .input-icon {
            position: absolute;
            /* Keeps the icon in a fixed position relative to the input */
            top: 0;
            right: 18px;
            /* Positions the icon close to the right side of the input box */
            height: 48px;
            font-size: 24px;
            line-height: 48px;
            color: #000000;
        }

        .btn {
            background-color: #6f42c1;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #02be12;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('assets/img/ตรากระทรวงสาธารณสุขใหม่.png') }}" alt="Logo">
        <h4 style="padding-left: 125px">สำนักงานสาธารณสุขจังหวัดบุรีรัมย์</h4>
        <h6 style="padding-left: 125px">BURIRAM PROVINCIAL HEALTH OFFICE</h6>
        <div class="nav-links">
            <a href="{{ route('home') }}">หน้าแรก</a>
            {{--  <a href="#">ติดต่อ</a>  --}}
            {{--  <span>จำนวนผู้ใช้งานทั้งหมด: <strong>1234</strong></span>  --}}
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">

                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3">เข้าสู่ระบบ</h4>
                                        <form action="{{ route('login.submit') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @if (Session::has('success'))
                                                <div class="alert-success">{{ Session::get('success') }}</div>
                                            @endif
                                            @if (Session::has('fail'))
                                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                            @endif
                                            @csrf
                                            <div class="form-group">
                                                <div style="position: relative;">
                                                    <!-- Changed type to 'text' and updated placeholder -->
                                                    <input type="text" name="login" class="form-style"
                                                        placeholder="อีเมลล์ หรือ ชื่อผู้ใช้งาน">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <span class="text-danger">
                                                    @error('login')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group mt-2">
                                                <!-- Password Input Field with ID -->
                                                <input type="password" id="password-input" name="password" class="form-style" placeholder="รหัสผ่าน">

                                                <!-- Icon to Toggle Password Visibility with onClick event -->
                                                <i id="toggle-password" class="input-icon uil uil-eye-slash" onclick="togglePasswordVisibility()"></i>

                                                <!-- Error Message Display -->
                                                <span class="text-danger">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <button class="btn mt-4">เข้าสู่ระบบ</button><br>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>2024 Screening System and Typology of Aged with Illustration Assessment of the Elderly via the QR code</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password-input');
            const toggleIcon = document.getElementById('toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('uil-eye-slash');
                toggleIcon.classList.add('uil-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('uil-eye');
                toggleIcon.classList.add('uil-eye-slash');
            }
        }
    </script>


</body>

</html>

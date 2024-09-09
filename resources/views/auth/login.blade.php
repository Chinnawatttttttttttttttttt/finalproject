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

        .modal-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .modal-body p {
            text-align: justify;
            margin-bottom: 20px;
        }

        /* แก้ไขค่า z-index ให้สูงขึ้น */
        .modal {
            z-index: 1050;
            /* ค่า z-index ของ Modal ควรสูงกว่าค่า z-index ของ backdrop */
        }

        /* ค่า z-index ของ modal-backdrop ใน Bootstrap 5.x */
        .modal-backdrop {
            z-index: 1040;
            /* ค่า z-index ของ Backdrop */
        }

        /* สไตล์สำหรับ Modal */
        .modal {
            display: none;
            /* ซ่อน Modal โดยค่าเริ่มต้น */
            position: fixed;
            /* ตำแหน่งของ Modal */
            z-index: 1050;
            /* เพิ่มค่า z-index ของ Modal ให้สูงขึ้น */
            left: 0;
            top: 0;
            width: 100%;
            /* ความกว้างของ Modal */
            height: 100%;
            /* ความสูงของ Modal */
            overflow: auto;
            /* เลื่อนหน้าจอเมื่อเนื้อหาเยอะ */
            background-color: rgba(0, 0, 0, 0.5);
            /* พื้นหลังสีดำที่โปร่งแสง */
        }

        /* สไตล์สำหรับเนื้อหา Modal */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* ระยะห่างจากด้านบนและกลางจอ */
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            /* ความกว้างของ Modal */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 10px;
        }

        /* ปุ่มปิด Modal */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
            <a href="#" data-bs-toggle="modal" data-bs-target="#contactModal">ติดต่อ</a>
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
                                                <input type="password" id="password-input" name="password"
                                                    class="form-style" placeholder="รหัสผ่าน">

                                                <!-- Icon to Toggle Password Visibility with onClick event -->
                                                <i id="toggle-password" class="input-icon uil uil-eye-slash"
                                                    onclick="togglePasswordVisibility()"></i>

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

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #fff;">
                <div class="modal-header" style="background-color: #6f42c1; color: white;">
                    <img src="{{ asset('assets/img/ตรากระทรวงสาธารณสุขใหม่.png') }}" alt="Logo"
                        style="width: 50px; height: auto;">
                    <div class="modal-title-container" style="flex: 1; padding-left: 20px;">
                        <h4>สำนักงานสาธารณสุขจังหวัดบุรีรัมย์</h4>
                        <h4>BURIRAM PROVINCIAL HEALTH OFFICE</h4>
                        <h4 class="modal-title" id="contactModalLabel">ติดต่อเรา</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>สำนักงานสาธารณสุขจังหวัดบุรีรัมย์</p>
                    <p>ที่อยู่:261 ถนนจิระ อำเภอเมือง จังหวัดบุรีรัมย์ 31000</p>
                    <p>โทร. 044-611562 : โทรสาร 044-611562(112)</p>
                    <iframe width="100%" height="400" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d506.5464345482627!2d103.11023402006114!3d14.99359609634598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311995b9454790d3%3A0x5f98e10d638cff6!2z4LiI4LmA4LiX4LiU4Lij4LiB4Lir4Li14Liy4LiU4Lii4LiB!5e0!3m2!1sth!2sth!4v1694474836505!5m2!1sth!2sth"
                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    {{--  <a href="https://www.google.com/maps/place/%E0%B8%AA%E0%B8%AB%E0%B8%81%E0%B8%A3%E0%B8%93%E0%B9%8C%E0%B8%AD%E0%B8%AD%E0%B8%A1%E0%B8%97%E0%B8%A3%E0%B8%B1%E0%B8%9E%E0%B8%A2%E0%B9%8C%E0%B8%AA%E0%B8%B2%E0%B8%98%E0%B8%B2%E0%B8%A3%E0%B8%93%E0%B8%AA%E0%B8%B8%E0%B8%82%E0%B8%88%E0%B8%B1%E0%B8%87%E0%B8%AB%E0%B8%A7%E0%B8%B1%E0%B8%94%E0%B8%9A%E0%B8%B8%E0%B8%A3%E0%B8%B5%E0%B8%A3%E0%B8%B1%E0%B8%A1%E0%B8%A2%E0%B9%8C/@14.993714,103.11012,421m/data=!3m1!1e3!4m6!3m5!1s0x311995b9454790d3:0x5f98e10d638cff6!8m2!3d14.9935961!4d103.110234!16s%2Fg%2F1hm5zg2lt?hl=th&entry=ttu&g_ep=EgoyMDI0MDkwNC4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank" class="btn btn-primary">
                        ดูแผนที่ใน Google Maps
                    </a>  --}}
                </div>
                {{--  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>  --}}
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

        // ฟังก์ชันเปิด Modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // ฟังก์ชันปิด Modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

    </script>


</body>

</html>

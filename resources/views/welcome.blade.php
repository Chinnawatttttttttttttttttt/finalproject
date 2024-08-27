<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการประเมินสภาวะของผู้สูงอายุ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('./assets/img/blackgroupjpg.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        header {
            position: absolute;
            top: 20px;
            text-align: center;
        }
        header h1 {
            font-size: 50px;
            color: #000000;
        }
        .login-container {
            position: absolute;
            top: 20px;
            right: 20px; /* เปลี่ยนเป็น right */
        }
        .login-container button {
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        footer {
            position: absolute;
            bottom: 20px;
            text-align: center;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <header>
        <h1>ระบบการประเมินสภาวะของผู้สูงอายุ</h1>
    </header>

    <div class="login-container">
        <button onclick="location.href='login'">ล็อคอิน</button>
    </div>
    
    //จำนวนผู้เข้าชม
    //ข่าวสาร
    <footer>
        <p>&copy; ระบบการประเมินสภาวะของผู้สูงอายุ (Typology of Aged with Illustration :TAI) ผ่าน QR-Code ในพื้นที่จังหวัดบุรีรัมย์.</p>
    </footer>
</body>
</html>

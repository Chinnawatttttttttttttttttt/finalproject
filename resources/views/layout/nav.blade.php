<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 70px; /* Adjust this value based on the height of your navbar */
        }

        .navbar {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s ease;
        }

        .navbar .nav-links a:hover {
            color: #f0ad4e;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            position: relative;
        }

        .navbar .user-info a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .navbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            cursor: pointer;
        }

        .navbar .user-info .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            border-radius: 8px;
        }

        .navbar .user-info .dropdown a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #f4f4f4;
            transition: background-color 0.3s ease;
        }

        .navbar .user-info .dropdown a:last-child {
            border-bottom: none;
        }

        .navbar .user-info .dropdown a:hover {
            background-color: #f4f4f4;
        }

        .fa-cog {
            cursor: pointer;
            margin-right: 10px;
            font-size: 1.5em;
            transition: transform 0.3s ease;
        }

        .fa-cog:hover {
            transform: rotate(90deg);
            color: #f0ad4e;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="path/to/logo.png" alt="Logo">
            <span>การพัฒนาระบบประเมินความสามารถในการดำเนินกิจวัตรประจำวันของผู้สูงอายุที่มีภาวะพึ่งพิง</span>
        </div>
        <div class="nav-links">
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp


            @if ($user->Type_Personnel === 'Admin')
                    <a href="{{ url('admin-dashboard') }}">หน้าหลัก</a>
                @elseif ($user->Type_Personnel === 'Doctor')
                    <a href="{{ url('doctor-dashboard') }}">หน้าหลัก</a>
                @elseif ($user->Type_Personnel === 'Staff')
                    <a href="{{ url('staff-dashboard') }}">หน้าหลัก</a>
                @endif
            <a href="/about">เกี่ยวกับ</a>
            <a href="/contact">ติดต่อเรา</a>
            @endif
        </div>
        @if (Auth::check())
            <div class="user-info">
                <a href="{{ url('profile-user') }}">
                    <img src="{{ asset($user->Image_User) }}" alt="Profile Image">
                    <span>{{ $user->Name_User }}</span>
                </a>
                <i class="fas fa-cog" onclick="toggleDropdown()"></i>
                <div class="dropdown" id="userDropdown">
                    <a href="{{ url('profile-user') }}">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            style="all: unset; cursor: pointer; color: #333; text-decoration: none; padding: 10px 20px; display: block;">Logout</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("userDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user-info img') && !event.target.matches('.user-info span') && !event.target.matches('.fa-cog')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>

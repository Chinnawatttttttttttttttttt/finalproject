<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการประเมินสภาวะของผู้สูงอายุ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- ฟอนต์และไอคอน -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=SUSE:wght@100..800&display=swap"rel="stylesheet">


    <style>
        body {
            font-family: "Noto Sans Thai", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            /* เลือกค่าแฮงค์ที่ต้องการ เช่น 100, 400, 700 */
            font-style: normal;

            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .header {
            background-color: #6f42c1;
            color: white;
            padding: 20px; /*เพิ่มขนาดหัว*/
            text-align: start;
            position: relative;
        }

        .header img {
            width: 80px;
            position: absolute;
            left: 50px;
            top: 10px;
        }

        .logo {
            width: 60px;
            /* ขนาดรูป logo */
            height: auto;
        }

        .text-container {
            margin-left: 125px; /* ตำแหน่งตัวหัวเรื่อง */
        }

        h4, h6 {
            margin: 0;
        }

        .nav-links {
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .nav-link {
            color: white !important; /* อักษรสีขาว */
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            margin-top: 10px;
        }

        .main-content {
            padding: 20px;
        }

        .news-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: box-shadow 0.3s ease-in-out;
        }

        .news-container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .news-item img {
            width: 100%;
            height: 200px;
            /* Set fixed height */
            object-fit: cover;
            /* Cover the area and crop excess */
        }

        .news-title {
            padding: 15px;
            text-align: center;
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

        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* ระยะห่างระหว่างภาพ */
            justify-content: center;
        }

        .image-gallery img {
            max-width: 100%;
            /* ให้รูปภาพไม่เกินขนาดของ container */
            height: auto;
            /* รักษาสัดส่วน */
            width: 100%;
            /* ขนาดของภาพใน modal */
            object-fit: cover;
            /* ให้ภาพถูกครอบตามสัดส่วน */
            border-radius: 8px;
            /* มุมกลมสำหรับภาพ */
        }

        .footer {
            margin-top: auto;
            /* Push footer to the bottom */
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            font-size: 14px;
            color: #6c757d;
        }

        .slider {
            position: relative;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slide img {
            width: 100%;
            height: auto;
            display: block;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
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
    <div class="header d-flex align-items-center">
        <img src="{{ url('assets/img/ตรากระทรวงสาธารณสุขใหม่.png') }}" alt="Logo" class="logo">
        <div class="text-container">
            <h4>สำนักงานสาธารณสุขจังหวัดบุรีรัมย์</h4>
            <h6>BURIRAM PROVINCIAL HEALTH OFFICE</h6>
        </div>
        <nav class="navbar navbar-expand-lg ms-auto">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#contactModal">ติดต่อ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Slider -->
    <section class="slider">
        <div class="slides">
            <!-- แทรกรูปภาพของคุณที่นี่ -->

            <div class="slide">
                <img src="{{ url('/assets/img/healthID-ssj.png') }}" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="{{ url('/assets/img/p01-67.png') }}" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="{{ url('/assets/img/p02-67.png') }}" alt="Slide 3">
            </div>

        </div>
        <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
        <button class="next" onclick="plusSlides(1)">&#10095;</button>
    </section>

    <div class="main-content">
        <div class="container">
            <section class="news mb-4">
                <h3 class="text-center">ข่าวสารประชาสัมพันธ์</h3>
            </section>
            <div class="row">
                @foreach ($latestNews as $newsItem)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <!-- ใช้การ์ดของ Bootstrap -->
                        <div class="card news-container h-100">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#newsModal-{{ $newsItem->id }}">
                                @php
                                    $image = !empty($newsItem->images[0])
                                        ? url('image/' . $newsItem->images[0])
                                        : url('path/to/default/image.jpg');
                                @endphp
                                <img src="{{ $image }}" class="card-img-top" alt="ไม่มีรูปภาพ">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#newsModal-{{ $newsItem->id }}"
                                        class="text-dark text-decoration-none">{{ $newsItem->title }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="newsModal-{{ $newsItem->id }}" tabindex="-1"
                        aria-labelledby="newsModalLabel-{{ $newsItem->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newsModalLabel-{{ $newsItem->id }}">
                                        {{ $newsItem->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $newsItem->content }}</p>
                                    <div class="image-gallery">
                                        @foreach ($newsItem->images as $image)
                                            @php
                                                $imageUrl = url('image/' . $image);
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="ไม่มีรูปภาพ" class="img-fluid mb-3">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="text-center my-4">
        <a href="{{ route('login') }}" class="btn btn-success sm">เข้าสู่ระบบ</a>
    </div>

    <div class="footer">
        <p>2024 Screening System and Typology of Aged with Illustration Assessment of the Elderly via the QR code</p>
    </div>

    <script>
        let slideIndex = 0; // Current slide index
        const slides = document.querySelectorAll('.slide'); // Get all slides

        function showSlides(index) {
            if (index >= slides.length) {
                slideIndex = 0; // Loop back to the first slide
            } else if (index < 0) {
                slideIndex = slides.length - 1; // Loop back to the last slide
            } else {
                slideIndex = index; // Set the current slide index
            }

            const offset = -slideIndex * 100; // Calculate the offset for the transform property
            document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
        }

        function plusSlides(n) {
            showSlides(slideIndex + n); // Move to the next or previous slide
        }

        // Initialize the first slide
        showSlides(slideIndex);

        setInterval(() => {
            plusSlides(1); // เลื่อนไปที่สไลด์ถัดไป
        }, 3000);

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

<!-- Bootstrap Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #fff;">
            <div class="modal-header" style="background-color: #6f42c1; color: white;">
                <img src="{{ url('assets/img/ตรากระทรวงสาธารณสุขใหม่.png') }}" alt="Logo"
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


</html>

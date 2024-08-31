<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการประเมินสภาวะของผู้สูงอายุ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1; /* Expand the content */
        }

        .news-slider {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            text-align: center;
            margin: auto;
        }

        .news-img {
            width: 100%;
            height: 150px; /* Set same height */
            object-fit: cover; /* Cover the area and crop excess */
            border-radius: 5px; /* Rounded corners */
        }

        .footer {
            margin-top: auto; /* Push footer to the bottom */
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
            {{--  <span>จำนวนผู้ใช้งานทั้งหมด: <strong></strong></span>  --}}
        </div>
    </div>

    <div class="main-content">
        <div class="news-slider">
            <h4>ข่าวสารล่าสุด</h4>
            <!-- Column for Latest News with Carousel -->
            <div id="newsCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Sample Loop for News Carousel -->
                    @forelse($latestNews as $index => $news)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="card bg-light mb-3">
                                <div class="card-body news">
                                    <div class="news-content">
                                        <h5>หัวข้อ : {{ $news->title }}</h5><br>
                                        <p>เนื้อหา : {{ $news->content }}</p>
                                    </div>
                                    <div class="news-images">
                                        <div class="row">
                                            @if ($news->images)
                                                @foreach (array_slice($news->images, 0, 4) as $image)
                                                    <div class="col-6 col-md-3 mb-2">
                                                        <img src="{{ asset('image/' . $image) }}" alt="Image" class="img-fluid news-img">
                                                    </div>
                                                @endforeach
                                                @if (count($news->images) > 4)
                                                    <div class="col-12">
                                                        <span class="view-more btn btn-link" onclick="showMoreImages('{{ json_encode($news->images) }}')">ดูเพิ่มเติม</span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <p>ไม่มีข่าวสารล่าสุด.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="text-center my-4">
        <a href="{{ route('login') }}" class="btn btn-success sm">เข้าสู่ระบบ</a>
    </div>

    <div class="footer">
        <p>2024 Screening System and Typology of Aged with Illustration Assessment of the Elderly via the QR code</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showMoreImages(images) {
            const imageArray = JSON.parse(images);
            let modalContent = '<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="imageModalLabel">ดูภาพเพิ่มเติม</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><div class="row">';

            imageArray.forEach(image => {
                modalContent += `<div class="col-4 mb-3"><img src="{{ asset('image/') }}/${image}" class="img-fluid rounded"></div>`;
            });

            modalContent += '</div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button></div></div></div></div>';

            document.body.insertAdjacentHTML('beforeend', modalContent);
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการประเมินสภาวะของผู้สูงอายุ</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        header {
            margin-bottom: 20px;
        }
        header h1 {
            font-size: 50px;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }
        .login-btn {
            margin-top: 20px;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            color: #ffffff;
        }
        .card {
            margin: 10px 0;
        }
        .carousel-item img {
            width: 100%;
            max-height: 400px; /* กำหนดความสูงสูงสุดของภาพใน Carousel */
            object-fit: cover; /* ทำให้ภาพครอบคลุมพื้นที่ที่กำหนด */
        }
        .news {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .news .card-header {
            margin-bottom: 15px;
        }
        .news-content {
            text-align: left;
            margin-bottom: 20px;
        }
        .news-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .news-images img {
            width: 150px; /* กำหนดความกว้างของภาพ */
            height: 150px; /* กำหนดความสูงของภาพ */
            object-fit: cover; /* ทำให้ภาพครอบคลุมพื้นที่ที่กำหนด */
            border-radius: 5px;
        }
        .view-more {
            cursor: pointer;
            color: #007BFF;
            font-size: 14px;
            text-decoration: underline;
            display: block;
            margin-top: 10px;
        }
        .view-more:hover {
            color: #0056b3;
        }
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .lightbox-content {
            max-width: 80%;
            max-height: 80%;
        }
        .lightbox-content img {
            width: 100%;
            height: auto;
        }
        .close-lightbox, .prev-lightbox, .next-lightbox {
            background: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .close-lightbox {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
        }
        .prev-lightbox, .next-lightbox {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
        }
        .prev-lightbox {
            left: 10px;
        }
        .next-lightbox {
            right: 10px;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <header>
        <h1>ระบบการประเมินสภาวะของผู้สูงอายุ</h1>
        <a href="/login" class="btn btn-primary login-btn">เข้าสู่ระบบ</a>
    </header>

    <div class="container d-flex justify-content-center">
        <div class="row w-100">
            <!-- Column for Visits -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">จำนวนผู้เข้าสู่ระบบทั้งหมด</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalVisits }}</h5>
                    </div>
                </div>
            </div>

            <!-- Column for Latest News with Carousel -->
            <div class="col-md-8">
                <div id="newsCarousel" class="carousel slide mb-3" data-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($latestNews as $index => $news)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="card bg-light mb-3">
                                    <div class="card-header">ข่าวสารล่าสุด</div>
                                    <div class="card-body news">
                                        <div class="news-content">
                                            <h5>หัวข้อ : {{ $news->title }}</h5><br>
                                            <p>เนื้อหา : {{ $news->content }}</p>
                                        </div>
                                        <div class="news-images">
                                            @if($news->images)
                                                @foreach(array_slice($news->images, 0, 4) as $image)
                                                    <img src="{{ asset('image/' . $image) }}" alt="Image">
                                                @endforeach
                                                @if(count($news->images) > 4)
                                                    <span class="view-more" onclick="showMoreImages('{{ json_encode($news->images) }}')">ดูเพิ่มเติม</span>
                                                @endif
                                            @endif
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
                    <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 ระบบการประเมินสภาวะของผู้สูงอายุ</p>
    </footer>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <button class="close-lightbox" onclick="closeLightbox()">&times;</button>
        <button class="prev-lightbox" onclick="changeImage(-1)">&lsaquo;</button>
        <button class="next-lightbox" onclick="changeImage(1)">&rsaquo;</button>
        <div class="lightbox-content">
            <img id="lightbox-img" src="" alt="Lightbox Image">
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function showMoreImages(imagesJson) {
            var images = JSON.parse(imagesJson);
            var lightbox = document.getElementById('lightbox');
            var lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = images[0];
            lightbox.style.display = 'flex';

            // Save images and index globally
            window.lightboxImages = images;
            window.currentImageIndex = 0;
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        function changeImage(direction) {
            var newIndex = window.currentImageIndex + direction;
            if (newIndex >= 0 && newIndex < window.lightboxImages.length) {
                window.currentImageIndex = newIndex;
                document.getElementById('lightbox-img').src = window.lightboxImages[newIndex];
            }
        }
    </script>
</body>
</html>

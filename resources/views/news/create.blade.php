@extends('layouts.app')

@section('content')
    <style>
        .title-input {
            max-width: 400px;
            /* ขนาดช่องหัวข้อ */
        }

        .content-textarea {
            min-height: 500px;
            /* ขนาดช่องเนื้อหา */
        }

        .image-preview img {
            max-width: 100%;
            /* ทำให้รูปภาพไม่เกินขนาดของ container */
            margin-bottom: 10px;
            /* เพิ่มระยะห่างด้านล่าง */
        }
    </style>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">ข่าวสาร ประชาสัมพันธ์</h1>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="news-form">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">หัวข้อ</label>
                        <input type="text" class="form-control title-input" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">เนื้อหา</label>
                        <textarea class="form-control content-textarea" id="content" name="content" rows="10" required></textarea>
                    </div><br>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="images" name="images[]" multiple
                            onchange="previewImages()">
                        <div id="image-preview" class="image-preview mt-3" required></div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="{{ route('news.index') }}" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function previewImages() {
            const preview = document.getElementById('image-preview');
            const files = document.getElementById('images').files;
            preview.innerHTML = ''; // ล้างการพรีวิวก่อนหน้า

            // แสดงพรีวิวสำหรับไฟล์แต่ละไฟล์
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px'; // ปรับขนาดตามต้องการ
                    img.style.marginRight = '10px'; // เพิ่มพื้นที่ระหว่างภาพ
                    img.style.borderRadius = '8px'; // เพิ่มมุมโค้ง
                    img.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)'; // เพิ่มเงา
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection

@extends('layouts.app')

@section('content')
<style>
    .title-input {
        max-width: 400px; /* ขนาดช่องหัวข้อ */
    }
    .content-textarea {
        min-height: 300px; /* ขนาดช่องเนื้อหา */
    }
    .image-preview img {
        max-width: 100%; /* ทำให้รูปภาพไม่เกินขนาดของ container */
        margin-bottom: 10px; /* เพิ่มระยะห่างด้านล่าง */
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>แก้ไขข่าวสาร</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="form-label">หัวข้อ</label>
                    <input type="text" class="form-control title-input" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="form-label">เนื้อหา</label>
                    <textarea class="form-control content-textarea" id="content" name="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="images" class="form-label">รูปภาพ (เลือกหลายรูปได้)</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple onchange="previewImages()">
                    <div id="image-preview" class="image-preview mt-3">
                        @if($news->images)
                            @php
                                $imageArray = is_string($news->images) ? explode(',', $news->images) : $news->images;
                            @endphp
                            @foreach($imageArray as $image)
                                <img src="{{ asset('image/' . $image) }}" alt="Image" class="img-thumbnail me-2" style="max-height: 150px;">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">อัปเดต</button>
                    <a href="{{ route('news.show', $news->id) }}" class="btn btn-danger">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImages() {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Clear previous previews
        const files = document.getElementById('images').files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail me-2'; // Add a class for styling and margin-right
                    img.style.maxHeight = '150px'; // Adjust size as needed
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
@endsection

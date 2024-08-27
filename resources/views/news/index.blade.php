@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>รายการข่าวสาร</h1>

    <!-- ปุ่มไปยังหน้า Create News -->
    <div class="mb-4">
        <a href="{{ route('news.create') }}" class="btn btn-success">เพิ่มข่าวสาร</a>
    </div>

    @foreach($newsItems as $news)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">หัวข้อ : {{ $news->title }}</h5>
                <p class="card-text">{{ $news->content }}</p>
                @if($news->images)
                    @foreach($news->images as $image)
                        <img src="{{ asset('image/' . $image) }}" alt="Image" class="img-fluid mb-2" style="max-height: 150px;">
                    @endforeach
                @endif
                <a href="{{ route('news.show', $news->id) }}" class="btn btn-primary">ดูรายละเอียด</a>
            </div>
        </div>
    @endforeach
</div>
@endsection

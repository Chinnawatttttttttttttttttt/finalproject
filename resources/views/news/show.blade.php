@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>หัวข้อข่าวสาร : {{ $news->title }}</h1>
            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning">แก้ไขข่าวสาร</a>
            <a href="{{ route('news.index') }}" class="btn btn-danger">ยกเลิก</a>
        </div>
        <div class="card-body">
            <p>เนื้อหา : {{ $news->content }}</p>
            @if($news->images)
                @foreach($news->images as $image)
                    <img src="{{ asset('image/' . $image) }}" alt="Image" class="img-fluid mb-3" style="max-height: 400px;">
                @endforeach
            @endif
        </div><br>
    </div>
</div>
@endsection

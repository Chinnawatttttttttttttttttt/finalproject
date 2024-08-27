@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>{{ $news->title }}</h1>
        </div>
        <div class="card-body">
            <p>{{ $news->content }}</p>
            @if($news->images)
                @foreach($news->images as $image)
                    <img src="{{ asset('image/' . $image) }}" alt="Image" class="img-fluid mb-3" style="max-height: 400px;">
                @endforeach
            @endif
        </div><br>
        <div class="text-end mt-3">
            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning">แก้ไขข่าวสาร</a>
        </div>
    </div>
</div>
@endsection

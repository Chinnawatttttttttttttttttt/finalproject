@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <h1 class="mb-4">รายชื่อผู้สูงอายุและคะแนนการประเมิน</h1>

    <div class="form-group">
        <label for="user_name">ชื่อ-ผู้ประเมิน:</label><br>
        <p id="user_name">{{ $user->FirstName . ' ' . $user->LastName }}</p>
    </div>

    @if ($scores->isEmpty())
        <div class="alert alert-info">
            <p>ยังไม่มีข้อมูลของคะแนน</p>
            <a href="{{ route('score.create', ['id' => $elderly->id]) }}" class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>
        </div>
    @else
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ-ผู้สูงอายุ</th>
                    <th>แบบทดสอบ</th>
                    <th>QR-Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $score)
                    @if (is_null($score->mobility) && is_null($score->confuse) && is_null($score->feed) && is_null($score->toilet))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $score->elderly->FirstName }} {{ $score->elderly->LastName }}</td>
                            <td>
                                <a href="{{ route('score.create', ['id' => $score->id]) }}" class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>
                            </td>
                            <td>
                                @if($score->qr_path)
                                    <img src="{{ asset($score->qr_path) }}" alt="QR Code" style="width: 100px; height: 100px;">
                                @else
                                    ไม่มี QR Code
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

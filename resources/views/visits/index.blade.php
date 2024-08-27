@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>ข้อมูลการเข้าชมทั้งหมด</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>IP Address</th>
                <th>วันที่เข้าชม</th>
                <th>เข้าสู่ระบบ</th>
                <th>ผู้ใช้</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->ip_address }}</td>
                <td>{{ $visit->visited_at }}</td>
                <td>{{ $visit->is_login ? 'ใช่' : 'ไม่ใช่' }}</td>
                <td>{{ $visit->user->Title.$visit->user->FirstName}} {{ $visit->user->LastName}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

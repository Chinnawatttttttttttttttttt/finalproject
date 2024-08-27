@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>ข้อมูลการเข้าสู่ระบบ</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>IP Address</th>
                <th>วันที่เข้าชม</th>
                <th>ผู้ใช้</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logins as $login)
            <tr>
                <td>{{ $login->ip_address }}</td>
                <td>{{ $login->visited_at }}</td>
                <td>{{ $login->user->Title.$login->user->FirstName}} {{ $login->user->LastName}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

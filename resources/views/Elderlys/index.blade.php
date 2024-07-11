@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>รายชื่อผู้สูงอายุ</h3>
        <a href="{{ route('add-elderly') }}" class="btn btn-primary">
            <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลผู้สูงอายุ
        </a>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Nick Name</th>
                <th>Birthday</th>
                <th>Age</th>
                <th>Address</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Phone</th>
                <th>แก้ไขข้อมูล</th>
                <th>ลบข้อมูล</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($elderly as $elderlys)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $elderlys->FirstName }}</td>
                <td>{{ $elderlys->LastName }}</td>
                <td>{{ $elderlys->NickName }}</td>
                <td>{{ $elderlys->Birthday }}</td>
                <td>{{ $elderlys->Age }}</td>
                <td>{{ $elderlys->Address }}</td>
                <td>{{ $elderlys->Latitude }}</td>
                <td>{{ $elderlys->Longitude }}</td>
                <td>{{ $elderlys->Phone }}</td>
                <td><a href="/edit-elderly/{{ $elderlys->id}}" class="btn btn-warning font-icon-detaill"><i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข </a></td>
                <td>
                    <form action="{{ route('elderlys.delete', $elderlys->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i> ลบข้อมูล </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

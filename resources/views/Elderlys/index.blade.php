@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>รายชื่อผู้สูงอายุ</h3>
                <a href="{{ route('add-elderly') }}" class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลผู้สูงอายุ
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>ชื่อเล่น</th>
                            <th style="width: 150px">วันเกิด</th>
                            <th>อายุ</th>
                            <th>ที่อยู่</th>
                            <th>ละติจูด</th>
                            <th>ลองจิจูด</th>
                            <th>โทรศัพท์</th>
                            <th>แก้ไขข้อมูล</th>
                            <th>ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elderly as $elderly)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $elderly->FirstName }}</td>
                            <td>{{ $elderly->LastName }}</td>
                            <td>{{ $elderly->NickName }}</td>
                            <td>{{ $elderly->Birthday }}</td>
                            <td>{{ $elderly->Age }} ปี</td>
                            <td>{{ $elderly->Address }}</td>
                            <td>{{ $elderly->Latitude }}</td>
                            <td>{{ $elderly->Longitude }}</td>
                            <td>{{ $elderly->Phone }}</td>
                            <td>
                                <a href="{{ route('elderlys.edit', $elderly->id) }}" class="btn btn-warning">
                                    <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('elderlys.delete', $elderly->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i> ลบข้อมูล
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

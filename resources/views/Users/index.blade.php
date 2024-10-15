@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>ข้อมูลผู้ใช้</h3>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-center">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลผู้ใช้
                </a>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('visits.index')}}" class="btn btn-success btn center">
                 จำนวนการเข้าสู่ระบบ
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table">
                <table id="table" class="table-hover table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>อีเมล</th>
                            <th>แผนก</th>
                            <th>ตำแหน่ง</th>
                            <th>คำสั่ง</th>
                            <th>ลบข้อมูล</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->Title }}{{ $user->FirstName }} {{ $user->LastName }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->department->department_name }}</td>
                            <td>{{ $user->position->position_name }}</td>
                            <td>
                                @if (session('position_id') == 1)
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                </a>
                                @endif
                            </td>
                            <td>
                                @if (session('position_id') == 1)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a type="submit" class="btn btn-danger btn-sm show_confirm" data-name="{{ $user->FirstName }} {{ $user->LastName }}" data-toggle="tooltip" title="Delete">
                                        <i class="nc-icon nc-simple-remove"></i> ลบข้อมูล
                                    </a>
                                </form>
                                @endif
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            var name = $(this).data("name");

            swal({
                title: 'คุณต้องการลบ ' + name + ' ใช่หรือไม่?',
                text: "หากคุณลบสิ่งนี้ มันจะหายไปตลอดกาล.",
                icon: 'warning',
                buttons: ['ยกเลิก', 'ลบ'],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

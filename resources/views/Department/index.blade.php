@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>รายชื่อแผนก</h3>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('add-department') }}" class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลแผนก
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table">
                <table id="table" class="table-hover table-striped">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 25%">ลำดับ</th>
                            <th style="width: 25%">ชื่อแผนก</th>
                            <th style="width: 25%">แก้ไข</th>
                            <th style="width: 100%">ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpt as $department)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $department->department_name }}</td>
                            <td>
                                <a href="{{ route('edit-department', $department->id) }}" class="btn btn-warning btn-sm">
                                    <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('departments.delete', $department->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-name="{{ $department->department_name }}" title="ลบ">
                                        <i class="nc-icon nc-simple-remove"></i> ลบ
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            var name = $(this).data("name");

            swal({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณต้องการลบ ' + name + ' ใช่หรือไม่?',
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

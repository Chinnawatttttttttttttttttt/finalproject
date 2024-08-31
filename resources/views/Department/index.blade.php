@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>รายชื่อแผนก</h3>
            <div class="d-flex justify-content-center mt-3">
                <!-- ปุ่มเปิด Modal สำหรับเพิ่มข้อมูลแผนก -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDepartmentModal">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลแผนก
                </button>
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
                                <!-- ปุ่มเปิด Modal สำหรับแก้ไขข้อมูลแผนก -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDepartmentModal{{ $department->id }}">
                                    <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                </button>
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

                        <!-- Modal สำหรับแก้ไขข้อมูลแผนก -->
                        <div class="modal fade" id="editDepartmentModal{{ $department->id }}" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDepartmentModalLabel">แก้ไขแผนก</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('departments.update', $department->id) }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="department_name" class="form-label">ชื่อ</label>
                                                <input type="text" name="department_name" class="form-control" placeholder="ชื่อแผนก" value="{{ $department->department_name }}" required>
                                                @error('department_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success"> บันทึก </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal สำหรับเพิ่มแผนก -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Create Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="department_name">ชื่อตำแหน่ง:</label>
                        <input type="text" class="form-control" id="department_name" name="department_name" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
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

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>ข้อมูลตำแหน่ง</h3>
            <div class="d-flex justify-content-center mt-3">
                <!-- Button trigger for Create Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPositionModal">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลตำแหน่ง
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table">
                <table id="table" class="table-hover table-striped table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 25%">ลำดับ</th>
                            <th style="width: 25%">ชื่อตำแหน่ง</th>
                            <th style="width: 25%">แก้ไขข้อมูล</th>
                            <th style="width: 100%">ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($position as $pos)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pos->position_name }}</td>
                            <td>
                                <!-- Button trigger for Edit Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPositionModal{{ $pos->id }}">
                                    <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('positions.delete', $pos->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-name="{{ $pos->position_name }}" title="ลบ">
                                        <i class="nc-icon nc-simple-remove"></i> ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editPositionModal{{ $pos->id }}" tabindex="-1" aria-labelledby="editPositionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPositionModalLabel">แก้ไขตำแหน่ง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('positions.update', $pos->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="position_name" class="form-label">ชื่อ</label>
                                                <input type="text" name="position_name" class="form-control" placeholder="ชื่อตำแหน่ง" value="{{ $pos->position_name }}">
                                                @error('position_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success"> บันทึก </button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
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

<!-- Create Modal -->
<div class="modal fade" id="createPositionModal" tabindex="-1" aria-labelledby="createPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPositionModalLabel">เพิ่มข้อมูลตำแหน่ง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="position_name" class="form-label">ชื่อตำแหน่ง</label>
                        <input type="text" name="position_name" class="form-control" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
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

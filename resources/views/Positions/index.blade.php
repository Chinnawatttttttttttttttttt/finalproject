@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>ข้อมูลตำแหน่ง</h3>
                <a href="{{ url('add-position') }}" class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลตำแหน่ง
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อตำแหน่ง</th>
                            <th>แก้ไขข้อมูล</th>
                            <th>ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($position as $position)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $position->position_name }}</td>
                            <td>
                                <a href="{{ route('edit-position', $position->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('positions.delete', $position->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title="Delete" data-name="{{ $position->position_name }}">
                                        <i class="fas fa-trash"></i> ลบ
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            var name = $(this).data("name");

            swal({
                title: 'Are you sure?',
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
@endsection

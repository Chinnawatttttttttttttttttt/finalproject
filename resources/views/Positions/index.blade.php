@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>ข้อมูลตำแหน่ง</h3>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ url('add-position') }}" class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลตำแหน่ง
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>ลำดับ</th>
                            <th>ชื่อตำแหน่ง</th>
                            <th>แก้ไขข้อมูล</th>
                            <th>ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($position as $pos)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pos->position_name }}</td>
                            <td>
                                <a href="{{ route('edit-position', $pos->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('positions.delete', $pos->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-name="{{ $pos->position_name }}" title="ลบ">
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

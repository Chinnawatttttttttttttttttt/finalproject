@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">รายชื่อแผนก</h3>
                        <a href="{{ url('add-department') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> เพิ่มแผนก</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อแผนก</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dpt as $dpts)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dpts->department_name }}</td>
                                    <td>
                                        <a href="{{ url('edit-department/'.$dpts->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('departments.delete', $dpts->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-name="{{ $dpts->department_name }}"><i class="fas fa-trash"></i> ลบ</button>
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
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    if (!form.hasClass('logout-form')) { // Check if it's not the logout form
                        form.submit();
                    }
                }
            });
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Admin</h3>
          </div>
          <div class="card-body">
            <a href="{{ url('add-position') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Add Admin</a>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($position as $positions )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $positions->position_name }}</td>
                    <td><a href="/edit-position/{{ $positions->id}}" class="btn btn-warning"><i class="fas fa-edit"></i> แก้ไข </a></td>
                    <td>
                        <form action="{{ route('positions.delete', $positions->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-name="{{ $positions->position_name }}"><i class="fas fa-trash"></i> ลบ </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        console.log("Document is ready");
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            console.log("Delete button clicked");
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
                    console.log("Form will be submitted");
                    form.submit();
                } else {
                    console.log("Delete cancelled");
                }
            });
        });
    });
</script>
@endsection

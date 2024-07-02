<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Admin</title>
</head>
<body>
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
                  </tr>
                </thead>
                <tbody>
                  @foreach ($position as $positions )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $positions->position_name }}</td>
                    <td><a href="/edit-position/{{ $positions->id}}" class="btn btn-warning"><i class="fas fa-edit"></i> แก้ไข </a></td>
                    <td>
                      <form action="{{ route('positions.delete',$positions->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i> ลบ </button>
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
</body>
{{--  <script type="text/javascript">
  $('.show_confirm').click(function (event){
      event.preventDefault();
      var form = $(this).closest("form");
      var name = $(this).data("name");

      swal({
          title: 'Are you sure you want to delete this record?',
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              form.submit();
          }
      });
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  --}}
</html>

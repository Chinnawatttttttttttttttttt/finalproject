<!-- resources/views/Elderlys/index.blade.php -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Elderly Records</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Elderly Records</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Nick Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Phone</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($elderly as $elderlys)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $elderlys->FirstName }}</td>
                    <td>{{ $elderlys->LastName }}</td>
                    <td>{{ $elderlys->NickName }}</td>
                    <td>{{ $elderlys->Birthday }}</td>
                    <td>{{ $elderlys->Age }}</td>
                    <td>{{ $elderlys->Address }}</td>
                    <td>{{ $elderlys->Latitude }}</td>
                    <td>{{ $elderlys->Longitude }}</td>
                    <td>{{ $elderlys->Phone }}</td>
                    <td><a href="/edit-elderly/{{ $elderlys->id}}" class="btn btn-warning"><i class="fas fa-edit"></i> แก้ไข </a></td>
                    <td>
                      <form action="{{ route('elderlys.delete', $elderlys->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i> ลบข้อมูล </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if(session('success'))
              <div class="alert alert-success mt-3">
                {{ session('success') }}
              </div>
            @endif
            @if(session('fail'))
              <div class="alert alert-danger mt-3">
                {{ session('fail') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2P5Jc2+f3K3+gLTOmv5jG1q7j2jzYZm4e9tq2k1o6BZ9z7k6y6eBCFktnE2" crossorigin="anonymous"></script>
  <script>
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        if(confirm("Are you sure you want to delete this record?")) {
            form.submit();
        }
    });
  </script>
</body>
</html>

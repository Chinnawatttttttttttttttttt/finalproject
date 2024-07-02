<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-5e2ESR8Ycmos6g3gAKr1Jvwye8sW4U1u/cAKulfVJnkakCcMqhOudbtPnvJ+nbv7" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="mb-0"><i class="fas fa-user-edit"></i> แก้ไขตำแหน่ง </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('positions.update') }}" enctype="multipart/form-data" method="POST">
                            @if (Session::has('success'))
                                <div class="alert alert-success mt-3">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger mt-3">{{ Session::get('fail') }}</div>
                            @endif
                            @csrf
                            <input type="hidden" name="id" value="{{ $position->id }}">
                            <div class="mb-3">
                                <label for="position_name" class="form-label"> ชื่อ </label>
                                <input type="text" name="position_name" class="form-control" placeholder="ชื่อตำแหน่ง" value="{{ $position->position_name }}">
                                @error('position_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึก </button>
                            <a href="{{ url('all-position') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> กลับ </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

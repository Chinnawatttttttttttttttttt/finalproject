<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Elderly</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><i class="fas fa-user-edit"></i> Edit Elderly</h3>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        <form action="{{ route('elderlys.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="FirstName">First Name:</label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ $elderly->FirstName }}">
                                @error('FirstName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="LastName">Last Name:</label>
                                <input type="text" class="form-control" id="LastName" name="LastName" value="{{ $elderly->LastName }}">
                                @error('LastName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="NickName">Nick Name:</label>
                                <input type="text" class="form-control" id="NickName" name="NickName" value="{{ $elderly->NickName }}">
                                @error('NickName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Birthday">Birthday:</label>
                                <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ $elderly->Birthday }}">
                                @error('Birthday')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Age">Age:</label>
                                <input type="number" class="form-control" id="Age" name="Age" value="{{ $elderly->Age }}">
                                @error('Age')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Address">Address:</label>
                                <input type="text" class="form-control" id="Address" name="Address" value="{{ $elderly->Address }}">
                                @error('Address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Latitude">Latitude:</label>
                                <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ $elderly->Latitude }}" step="0.0000001">
                                @error('Latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Longitude">Longitude:</label>
                                <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ $elderly->Longitude }}" step="0.0000001">
                                @error('Longitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Phone">Phone:</label>
                                <input type="text" class="form-control" id="Phone" name="Phone" value="{{ $elderly->Phone }}">
                                @error('Phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="id" value="{{ $elderly->id }}">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

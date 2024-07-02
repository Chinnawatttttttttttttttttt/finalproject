<!-- resources/views/Elderlys/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Elderly</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add New Elderly</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif

        <form action="{{ route('elderlys.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="FirstName">First Name:</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{ old('FirstName') }}">
                @error('FirstName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="LastName">Last Name:</label>
                <input type="text" class="form-control" id="LastName" name="LastName" value="{{ old('LastName') }}">
                @error('LastName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="NickName">Nick Name:</label>
                <input type="text" class="form-control" id="NickName" name="NickName" value="{{ old('NickName') }}">
                @error('NickName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Birthday">Birthday:</label>
                <input type="date" class="form-control" id="Birthday" name="Birthday" value="{{ old('Birthday') }}">
                @error('Birthday')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Age">Age:</label>
                <input type="number" class="form-control" id="Age" name="Age" value="{{ old('Age') }}">
                @error('Age')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" name="Address" value="{{ old('Address') }}">
                @error('Address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Latitude">Latitude:</label>
                <input type="number" class="form-control" id="Latitude" name="Latitude" value="{{ old('Latitude') }}" step="0.0000001">
                @error('Latitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Longitude">Longitude:</label>
                <input type="number" class="form-control" id="Longitude" name="Longitude" value="{{ old('Longitude') }}" step="0.0000001">
                @error('Longitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Phone">Phone:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone') }}">
                @error('Phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

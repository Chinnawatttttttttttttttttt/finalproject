@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-user-edit"></i> แก้ไขแผนก </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('departments.update', $dpt->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')
                        @if (Session::has('success'))
                            <div class="alert alert-success mt-3">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger mt-3">{{ Session::get('fail') }}</div>
                        @endif

                        <div class="mb-3">
                            <label for="department_name" class="form-label">ชื่อ</label>
                            <input type="text" name="department_name" class="form-control" placeholder="ชื่อแผนก" value="{{ $dpt->department_name }}">
                            @error('department_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึก </button>
                            <a href="{{ url('all-department') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> กลับ </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endsection

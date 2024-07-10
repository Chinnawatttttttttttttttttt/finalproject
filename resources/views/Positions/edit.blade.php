@extends('layouts.app')

@section('content')
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
@endsection

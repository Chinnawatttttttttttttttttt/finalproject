@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5">Create Position</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('fail'))
        <div class="alert alert-danger">{{ session('fail') }}</div>
    @endif

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="position_name">ชื่อตำแหน่ง:</label>
            <input type="text" class="form-control" id="position_name" name="position_name" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <a href="{{ url('all-position') }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> กลับ </a>
    </form>
</div>
@endsection

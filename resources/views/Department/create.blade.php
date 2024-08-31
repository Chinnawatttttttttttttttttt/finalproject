@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5">Create Department</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('fail'))
        <div class="alert alert-danger">{{ session('fail') }}</div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="department_name">ชื่อตำแหน่ง:</label>
            <input type="text" class="form-control" id="department_name" name="department_name" pattern="[\p{Thai}a-zA-Z]+" title="ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษและต้องมีอย่างน้อย 1 ตัวอักษรไทย" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <a href="{{ url('all-department') }}" class="btn btn-success btn-sm" style="height: 40px; wight: 100%;"> กลับ </a>
    </form>
</div>
@endsection

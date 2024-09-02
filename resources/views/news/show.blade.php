@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-light text-black">
            <h1 class="mb-0">หัวข้อข่าวสาร: {{ $news->title }}</h1>
            <div>
                <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning btn-sm me-2">แก้ไขข่าวสาร</a>

                <form action="{{ route('news.delete', $news->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-name="{{ $news->title }}" data-toggle="tooltip" title="Delete">
                        <i class="nc-icon nc-simple-remove"></i> ลบข้อมูล
                    </button>
                </form>

                <a href="{{ route('news.index') }}" class="btn btn-secondary btn-sm ms-2">ยกเลิก</a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h5 class="card-title">เนื้อหา:</h5>
                <p class="card-text lead">{{ $news->content }}</p>
            </div>

            @if($news->images)
                <div class="row">
                    @foreach($news->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('image/' . $image) }}" alt="News Image" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover; width: 100%;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.show_confirm').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var name = $(this).data("name");

                swal({
                    title: 'คุณต้องการลบ ' + name + ' ใช่หรือไม่?',
                    text: "หากคุณลบสิ่งนี้ มันจะหายไปตลอดกาล.",
                    icon: 'warning',
                    buttons: ['ยกเลิก', 'ลบ'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

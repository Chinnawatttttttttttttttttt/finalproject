@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">รายการข่าวสาร</h1>

        <!-- ปุ่มไปยังหน้า Create News -->
        <div class="mb-4">
            <a href="{{ route('news.create') }}" class="btn btn-success">เพิ่มข่าวสาร</a>
        </div>

        @foreach ($newsItems as $news)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">หัวข้อ: {{ $news->title }}</h5>
                    <p class="card-text lead">{{ $news->content }}</p>

                    @if ($news->images)
                        @php
                            // ตรวจสอบว่า images เป็นอาเรย์หรือไม่
                            if (is_array($news->images)) {
                                // หากเป็นอาเรย์ ให้รวมข้อมูลเป็นสตริงโดยใช้คอมม่าเป็นตัวคั่น
                                $images = implode(',', $news->images);
                            } else {
                                // ถ้าไม่ใช่อาเรย์ ใช้ข้อมูลเดิม
                                $images = $news->images;
                            }

                            // แปลงสตริงเป็นอาเรย์โดยใช้ explode
                            $images = is_string($images) ? explode(',', $images) : [];
                        @endphp

                        <div class="row">
                            @foreach ($images as $image)
                                <div class="col-md-3 mb-2">
                                    <img src="{{ url('image/' . $image) }}" alt="Image"
                                        class="img-fluid rounded shadow-sm" style="max-height: 150px; object-fit: auto;">
                                </div>
                            @endforeach
                        </div>
                    @endif


                    <!-- ปุ่มสำหรับดูรายละเอียดและลบ -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('news.show', $news->id) }}" class="btn btn-primary">ดูรายละเอียด</a>

                        <form action="{{ route('news.delete', $news->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                data-name="{{ $news->title }}" data-toggle="tooltip" title="Delete">
                                <i class="nc-icon nc-simple-remove"></i> ลบข้อมูล
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="container mt-5">
            <div class="text-center">
                <h3>รายชื่อผู้สูงอายุ</h3>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('add-elderly') }}" class="btn btn-primary btn-center">
                        <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูลผู้สูงอายุ
                    </a>
                </div>
            </div>

            <div class="table">
                <table id="table" class="table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th style="wight: 5%">ลำดับ</th>
                            <th style="wight: 10%">ชื่อ - นามสกุล</th>
                            <th style="wight: 5%">ชื่อเล่น</th>
                            {{--  <th>วันเกิด</th>  --}}
                            {{--  <th>อายุ</th>  --}}
                            <th style="wight: 20%">ที่อยู่</th>
                            <th style="wight: 5%">โทรศัพท์</th>
                            <th style="wight: 5%">โปรไฟล์</th>
                            <th style="wight: 5%">แผนที่</th>
                            <th style="wight: 5%">แก้ไขข้อมูล</th>
                            <th style="wight: 200%">ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elderly as $elderly)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="width: 250px;">{{ $elderly->Title }}{{ $elderly->FirstName }}
                                    {{ $elderly->LastName }}</td>
                                <td style="width: 80px;">{{ $elderly->NickName }}</td>
                                {{--  <td>{{ $elderly->Birthday }}</td>  --}}
                                {{--  <td>{{ $elderly->Age }} ปี</td>  --}}
                                {{--  <td>
                                <a href="{{  }}"></a>
                            </td>  --}}
                                <td style="width: 400px;">{{ $elderly->Address }}</td>
                                <td>{{ $elderly->Phone }}</td>
                                <td>
                                    <a href="{{ route('elderlys.profile', $elderly->id) }}" class="btn btn-success btn-sm">
                                        <i class="nc-icon nc-single-02"></i> โปรไฟล์
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $elderly->Latitude }},{{ $elderly->Longitude }}"
                                        target="_blank" class="btn btn-info btn-sm">
                                        <i class="nc-icon nc-square-pin"></i> แผนที่
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('elderlys.edit', $elderly->id) }}" class="btn btn-warning btn-sm">
                                        <i class="nc-icon nc-preferences-circle-rotate"></i> แก้ไข
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('elderlys.delete', $elderly->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                            data-name="{{ $elderly->FirstName }} {{ $elderly->LastName }}"
                                            data-toggle="tooltip" title="Delete">
                                            <i class="nc-icon nc-simple-remove"></i> ลบข้อมูล
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: 'คุณต้องการลบ ' + name + ' ใช่หรือไม่?',
                text: "หากคุณลบสิ่งนี้ มันจะหายไปตลอดกาล.",
                icon: "warning",
                buttons: ['ยกเลิก', 'ลบ'],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endpush

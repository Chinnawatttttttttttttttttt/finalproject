<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ระบบการคัดกรองข้อมูลและประเมินสภาวะของผู้สูงอายุผ่านคิวอาร์โค้ดของสำนักงานสาธารณสุขจังหวัดบุรีรัมย์ Screening System and Typology of Aged with Illustration Assessment of the Elderly via the QR code of the Public Health Office Buriram Procince</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />

    <!-- Apple Touch Icon และ Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- ฟอนต์และไอคอน -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />

    <!-- CSS เพื่อวัตถุประสงค์การสาธิตเท่านั้น อย่ารวมไปในโปรเจกต์ -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
</head>

<style>
    .content{
        background-color: #ffffff;
    }

</style>

<body>
    <div class="wrapper">
        <!-- รวมไซด์บาร์ -->
        @include('layouts.sidebar')

        <div class="main-panel">
            <!-- รวมแถบนาบาร์ -->
            @include('layouts.navbar')

            <div class="content">
                <!-- Yield เนื้อหา -->
                @yield('content')
                {{--  <button id="print-btn" class="btn btn-primary">พิมพ์</button>  --}}
            </div>

            <!-- รวมฟุตเตอร์ -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- ปลั๊กอินสำหรับ Switches -->
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>

    {{--  <!-- ปลั๊กอิน Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>  --}}

    <!-- ปลั๊กอิน Chartist -->
    <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>

    <!-- ปลั๊กอิน Notifications -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

    <!-- ศูนย์ควบคุมสำหรับ Light Bootstrap Dashboard -->
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>

    <!-- แม้กระทั่ง DEMO ของ Light Bootstrap Dashboard อย่านำมาใช้ในโปรเจกต์! -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>

    <!-- สคริปต์เพิ่มเติม -->
    @stack('scripts')

    <style>
        /* ปรับขนาดช่อง lengthMenu */
        .dataTables_length select {
            width: 100px; /* กำหนดความกว้างที่ต้องการ */
            height: 35px; /* กำหนดความสูงที่ต้องการ */
            font-size: 16px; /* กำหนดขนาดตัวอักษร */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "responsive": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "กำลังแสดงหน้าที่ _PAGE_ ของ _PAGES_",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                    "search": "ค้นหา:",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "หน้าถัดไป",
                        "previous": "หน้าก่อนหน้า"
                    }
                },
                "columnDefs": [
                    { "className": "dt-center", "targets": "_all" }  // ทำให้ข้อความทุกคอลัมน์อยู่ตรงกลาง
                ]
            });
        });
    </script>
</body>
</html>

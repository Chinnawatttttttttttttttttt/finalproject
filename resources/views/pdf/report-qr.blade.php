<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานคะแนน</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            padding: 10mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
            page-break-after: always;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
            text-align: center;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            page-break-before: always;
        }

        .chart-container {
            width: 45%;
            height: 300px;
            margin-bottom: 10mm;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>

    <div class="container">
        <h1>รายงานคะแนน</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อผู้สูงอายุ</th>
                    {{--  <th>คะแนนการเคลื่อนไหว</th>
                    <th>คะแนนการสับสน</th>
                    <th>คะแนนการให้อาหาร</th>
                    <th>คะแนนการใช้ห้องน้ำ</th>
                    <th>กลุ่ม</th>  --}}
                    <th>QR-Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr>
                    <td>{{ $score->id }}</td>
                    <td>{{ $score->elderly->Title.$score->elderly->FirstName }} {{ $score->elderly->LastName }}</td>
                    {{--  <td>{{ $score->mobility }}</td>
                    <td>{{ $score->confuse }}</td>
                    <td>{{ $score->feed }}</td>
                    <td>{{ $score->toilet }}</td>
                    <td>{{ isset($score->group) ? $score->group->name : 'N/A' }}</td>  --}}
                    <td>
                        @if($score->qr_path)
                        <img src="{{ asset($score->qr_path) }}" alt="QR Code" style="width: 100px; height: 100px;">
                    @else
                        ไม่มี QR Code
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>

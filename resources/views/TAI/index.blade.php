@extends('layouts.app')

@section('content')

    <style>
        /* CSS สำหรับการพิมพ์ */
        @media print {
            .print-hidden {
                display: none;
            }
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">รายชื่อผู้สูงอายุและคะแนนการประเมิน</h1>
        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <label for="user_name">ชื่อ-ผู้ประเมิน:</label>
                <span id="user_name">{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                {{--  <a href="{{ route('print.pdf-score') }}" class="btn btn-primary">PDF</a>  --}}
                {{--  <button id="print-btn" class="btn btn-primary">Print</button>  --}}
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('print.pdf-score') }}" class="btn btn-primary mr-2">PDF</a>
                <a href="{{ route('export.scores') }}" class="btn btn-success">EXL</a>
            </div>
        </div>

        @if ($scores->isEmpty())
            <div class="alert alert-info">
                <p>ยังไม่มีข้อมูลของคะแนน</p>
                <a href="{{ route('score.create', ['id' => $elderly->id]) }}" class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>
            </div>
        @else
            <div class="table">
                <table id="table" class="table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ-ผู้สูงอายุ</th>
                            <th>การเคลื่อนไหว</th>
                            <th>สับสน</th>
                            <th>การป้อนอาหาร</th>
                            <th>การใช้ห้องน้ำ</th>
                            <th>กลุ่ม TAI</th>
                            <th>กลุ่มตามคะแนน</th>
                            <th>แบบทดสอบ</th>
                            <th>Qr-Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scores as $score)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $score->elderly->Title }}{{ $score->elderly->FirstName }}
                                    {{ $score->elderly->LastName }}</td>
                                <td>{{ $score->mobility ?? 'N/A' }}</td>
                                <td>{{ $score->confuse ?? 'N/A' }}</td>
                                <td>{{ $score->feed ?? 'N/A' }}</td>
                                <td>{{ $score->toilet ?? 'N/A' }}</td>
                                <td>{{ isset($score->group) ? $score->group->name : 'N/A' }}</td>
                                <td>
                                    @php
                                        $groupName = isset($score->group) ? $score->group->name : 'N/A';
                                        $displayText = 'ยังไม่ได้ประเมิน'; // Default text

                                        if (in_array($groupName, ['B5', 'B4', 'B3'])) {
                                            $displayText = 'กลุ่มปกติ';
                                        } elseif (in_array($groupName, ['C4', 'C3', 'C2'])) {
                                            $displayText = 'กลุ่มติดบ้าน';
                                        } elseif (in_array($groupName, ['I3', 'I2', 'I1'])) {
                                            $displayText = 'กลุ่มติดเตียง';
                                        }

                                    @endphp
                                    {{ $displayText }}
                                </td>

                                <td>
                                    <a href="{{ route('score.create', ['id' => $score->id]) }}"
                                        class="btn btn-primary">ไปที่หน้าแบบทดสอบ</a>
                                </td>
                                <td>
                                    @if ($score->qr_path)
                                        <img src="{{ url($score->qr_path) }}" alt="QR Code"
                                            style="width: 100px; height: 100px;">
                                    @else
                                        ไม่มี QR Code
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

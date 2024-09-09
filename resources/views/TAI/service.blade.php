@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ข้อมูลบริการสำหรับผู้สูงอายุ</h1>

        <div class="table">
            <table id="table" class="table-hover table-striped">
                <thead>
                    <tr>
                        <th>ผู้สูงอายุ</th>
                        <th>กลุ่ม</th>
                        <th>กลุ่มใหญ่</th>
                        <th>ข้อมูลบริการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $score)
                        <tr>
                            <td>{{ $score->elderly->Title . $score->elderly->FirstName }} {{ $score->elderly->LastName }}
                            </td>
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
                                <a href="{{ route('service.details', ['score_id' => $score->id]) }}"
                                    class="btn btn-primary">ดูรายละเอียด</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>แดชบอร์ด</h1>
                <p>อัปเดตล่าสุด: {{ $lastUpdate }}</p>
            </div>
        </div>

        <!-- แผนภูมิ Group Counts -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white-purple">
                        <h4 class="card-title">จำนวนผู้สูงอายุในแต่ละกลุ่ม</h4>
                    </div>
                    <div class="card-body">
                        <div id="groupChart" style="height: 300px;"></div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="legend">
                            <i class="fa fa-circle" style="color: {{ $groupColors['Group 0'] }};"></i> ยังไม่ได้ประเมิน :
                            {{ $groupCounts['Group 0'] }} คน<br>
                            <i class="fa fa-circle" style="color: {{ $groupColors['Group 1'] }};"></i> กลุ่มปกติ :
                            {{ $groupCounts['Group 1'] }} คน<br>
                            <i class="fa fa-circle" style="color: {{ $groupColors['Group 2'] }};"></i> กลุ่มติดบ้าน :
                            {{ $groupCounts['Group 2'] }} คน<br>
                            <i class="fa fa-circle" style="color: {{ $groupColors['Group 3'] }};"></i> กลุ่มติดเตียง :
                            {{ $groupCounts['Group 3'] }} คน<br>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ตารางแสดงจำนวนผู้สูงอายุในแต่ละกลุ่ม -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white-purple">
                        <h4 class="card-title">รายละเอียดจำนวนผู้สูงอายุ</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>กลุ่ม</th>
                                    <th>จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>กลุ่มปกติ</td>
                                    <td>{{ $groupCounts['Group 1'] }}</td>
                                </tr>
                                <tr>
                                    <td>กลุ่มติดบ้าน</td>
                                    <td>{{ $groupCounts['Group 2'] }}</td>
                                </tr>
                                <tr>
                                    <td>กลุ่มติดเตียง</td>
                                    <td>{{ $groupCounts['Group 3'] }}</td>
                                </tr>
                                <tr>
                                    <td>ยังไม่ได้ประเมิน</td>
                                    <td>{{ $groupCounts['Group 0'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- แผนภูมิ Score Counts -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white-purple">
                        <h4 class="card-title">จำนวนผู้สูงอายุตามคะแนน</h4>
                    </div>
                    <div class="card-body">
                        <div id="scoreChart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawGroupChart);
        google.charts.setOnLoadCallback(drawScoreChart);

        function drawGroupChart() {
            var groupData = google.visualization.arrayToDataTable([
                ['Group', 'Number of Elderly'],
                ['กลุ่มปกติ', {{ $groupCounts['Group 1'] }}],
                ['กลุ่มติดบ้าน', {{ $groupCounts['Group 2'] }}],
                ['กลุ่มติดเตียง', {{ $groupCounts['Group 3'] }}]
            ]);

            var options = {
                title: 'จำนวนผู้สูงอายุในแต่ละกลุ่ม',
                pieHole: 0.4,
                colors: ['{{ $groupColors['Group 1'] }}', '{{ $groupColors['Group 2'] }}',
                    '{{ $groupColors['Group 3'] }}'
                ],
                is3D: true
            };

            var groupChart = new google.visualization.PieChart(document.getElementById('groupChart'));
            groupChart.draw(groupData, options);
        }

        function drawScoreChart() {
            var scoreData = google.visualization.arrayToDataTable([
                ['Score', 'จำนวนผู้สูงอายุ'],
                ['B5', {{ $scoreCounts['B5'] }}],
                ['B4', {{ $scoreCounts['B4'] }}],
                ['B3', {{ $scoreCounts['B3'] }}],
                ['C4', {{ $scoreCounts['C4'] }}],
                ['C3', {{ $scoreCounts['C3'] }}],
                ['C2', {{ $scoreCounts['C2'] }}],
                ['I3', {{ $scoreCounts['I3'] }}],
                ['I2', {{ $scoreCounts['I2'] }}],
                ['I1', {{ $scoreCounts['I1'] }}]
            ]);

            var options = {
                title: 'จำนวนผู้สูงอายุตามกลุ่มคะแนน TAI ',
                chartArea: { width: '70%' },
                hAxis: {
                    title: 'จำนวนผู้สูงอายุตามกลุ่ม',
                    minValue: 0,
                    gridlines: { count: 5 } // Add gridlines
                },
                vAxis: {
                    title: 'กลุ่ม',
                    textStyle: { fontSize: 14 }, // Adjust font size
                    titleTextStyle: { fontSize: 16 } // Title font size
                },
                legend: { position: 'none' }, // Hide the legend
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 12,
                        color: '#000',
                        auraColor: 'none'
                    }
                },
                // Set explicit colors for each data series
                {{--  series: {
                    0: { color: '#4caf50' },  // B5
                    1: { color: '#2196F3' },  // B4
                    2: { color: '#FFC107' },  // B3
                    3: { color: '#FF5722' },  // C4
                    4: { color: '#9C27B0' },  // C3
                    5: { color: '#00BCD4' },  // C2
                    6: { color: '#FF9800' },  // I3
                    7: { color: '#673AB7' },  // I2
                    8: { color: '#E91E63' }   // I1
                },  --}}
                animation: {
                    duration: 500,
                    easing: 'out',
                    startup: true // Animate on chart load
                }
            };

            var scoreChart = new google.visualization.ColumnChart(document.getElementById('scoreChart'));
            scoreChart.draw(scoreData, options);
        }

    </script>
@endsection

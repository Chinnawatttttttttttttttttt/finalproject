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
                        <i class="fa fa-circle" style="color: {{ $groupColors['Group 1'] }};"></i> กลุ่มปกติ : {{ $groupCounts['Group 1'] }} คน<br>
                        <i class="fa fa-circle" style="color: {{ $groupColors['Group 2'] }};"></i> กลุ่มติดบ้าน : {{ $groupCounts['Group 2'] }} คน<br>
                        <i class="fa fa-circle" style="color: {{ $groupColors['Group 3'] }};"></i> กลุ่มติดเตียง : {{ $groupCounts['Group 3'] }} คน<br>
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
    google.charts.load('current', {'packages':['corechart', 'bar']});
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
            colors: ['{{ $groupColors['Group 1'] }}', '{{ $groupColors['Group 2'] }}', '{{ $groupColors['Group 3'] }}']
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
            colors: ['#4caf50', '#2196F3', '#FFC107', '#FF5722', '#9C27B0', '#00BCD4', '#FF9800', '#673AB7', '#E91E63'], // Different colors for each bar
            animation: {
                duration: 500,
                easing: 'out',
                startup: true // Animate on chart load
            }
        };

        var scoreChart = new google.visualization.BarChart(document.getElementById('scoreChart'));
        scoreChart.draw(scoreData, options);
    }
</script>
@endsection

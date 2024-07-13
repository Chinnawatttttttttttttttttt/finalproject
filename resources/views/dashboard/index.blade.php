@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>แดชบอร์ด</h1>
        </div>
    </div>

    <!-- แผนภูมิ TAI -->
    <div class="row mt-4">
        <div class="col-md-6">
            <!-- แผนภูมิ Pie Chart TAI -->
            <div class="card">
                <div class="card-header bg-white-purple">
                    <h4 class="card-title ">แผนภูมิ Pie Chart TAI</h4>
                    <p class="card-category ">คะแนนรวมเป็นเปอร์เซ็นต์ (0-5)</p>
                </div>
                <div class="card-body">
                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> การเคลื่อนไหว: {{ $mobilityPercentage }}%
                        <i class="fa fa-circle text-danger"></i> สับสน: {{ $confusePercentage }}%
                        <i class="fa fa-circle text-warning"></i> การให้อาหาร: {{ $feedPercentage }}%
                        <i class="fa fa-circle" style="color: {{ $groupColors['C2'] }};"></i> การใช้ห้องน้ำ: {{ $toiletPercentage }}%
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> อัปเดตล่าสุด: {{ $lastUpdate }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- แผนภูมิ Bar Chart TAI -->
            <div class="card">
                <div class="card-header bg-white-purple">
                    <h4 class="card-title ">แผนภูมิ Bar Chart TAI</h4>
                    <p class="card-category ">คะแนนรวมเป็นเปอร์เซ็นต์ (0-5)</p>
                </div>
                <div class="card-body">
                    <div id="chartHours" class="ct-chart"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> การเคลื่อนไหว: {{ $mobilityPercentage }}%
                        <i class="fa fa-circle text-danger"></i> สับสน: {{ $confusePercentage }}%
                        <i class="fa fa-circle text-warning"></i> การให้อาหาร: {{ $feedPercentage }}%
                        <i class="fa fa-circle" style="color: {{ $groupColors['C2'] }};"></i> การใช้ห้องน้ำ: {{ $toiletPercentage }}%
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> อัปเดตล่าสุด: {{ $lastUpdate }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แผนภูมิ Group Counts -->
    <div class="row mt-4">
        <div class="col-md-6">
            <!-- แผนภูมิ Pie Chart จำนวนกลุ่ม -->
            <div class="card">
                <div class="card-header bg-white-purple">
                    <h4 class="card-title ">แผนภูมิ Pie Chart จำนวนกลุ่ม</h4>
                    <p class="card-category ">เปอร์เซ็นต์ของบุคคลในแต่ละกลุ่ม</p>
                </div>
                <div class="card-body">
                    <div id="chartGroupPie" class="ct-chart ct-perfect-fourth"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="legend">
                        @foreach($groupAverages as $groupName => $groupAverage)
                            <i class="fa fa-circle" style="color: {{ $groupColors[$groupName] }};"></i> {{ $groupName }}: {{ $groupAverage }}%
                        @endforeach
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> อัปเดตล่าสุด: {{ $lastUpdate }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- แผนภูมิ Bar Chart จำนวนกลุ่ม -->
            <div class="card">
                <div class="card-header bg-white-purple">
                    <h4 class="card-title ">แผนภูมิ Bar Chart จำนวนกลุ่ม</h4>
                    <p class="card-category ">เปอร์เซ็นต์ของบุคคลในแต่ละกลุ่ม</p>
                </div>
                <div class="card-body">
                    <div id="chartGroupBar" class="ct-chart"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="legend">
                        @foreach($groupAverages as $groupName => $groupAverage)
                            <i class="fa fa-circle" style="color: {{ $groupColors[$groupName] }};"></i> {{ $groupName }}: {{ $groupAverage }}%
                        @endforeach
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> อัปเดตล่าสุด: {{ $lastUpdate }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Include Bootstrap JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- Include Chartist JS -->
<script src="{{ asset('js/chartist.min.js') }}"></script>
<!-- Your custom scripts -->
<script>
    $(document).ready(function() {
        // Data for TAI pie chart
        var mobility = {{ $mobilityPercentage }};
        var confuse = {{ $confusePercentage }};
        var feed = {{ $feedPercentage }};
        var toilet = {{ $toiletPercentage }};

        new Chartist.Pie('#chartPreferences', {
            labels: ['การเคลื่อนไหว', 'สับสน', 'การให้อาหาร', 'การใช้ห้องน้ำ'],
            series: [mobility, confuse, feed, toilet]
        });

        // Data for TAI bar chart
        var data = {
            labels: ['การเคลื่อนไหว', 'สับสน', 'การให้อาหาร', 'การใช้ห้องน้ำ'],
            series: [
                [{{ $mobilityPercentage }}, {{ $confusePercentage }}, {{ $feedPercentage }}, {{ $toiletPercentage }}]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        new Chartist.Bar('#chartHours', data, options);

        // Data for Group Counts pie chart
        var groupLabels = {!! json_encode(array_keys($groupCounts)) !!};
        var groupPercentages = {!! json_encode(array_values($groupCounts)) !!};

        new Chartist.Pie('#chartGroupPie', {
            labels: groupLabels,
            series: groupPercentages
        });

        // Data for Group Counts bar chart
        new Chartist.Bar('#chartGroupBar', {
            labels: groupLabels,
            series: [groupPercentages]
        }, options);
    });
</script>
@endsection

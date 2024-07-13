<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, dont include it in your project -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main-panel">
            @include('layouts.navbar')

            <div class="content">
                <div class="container-fluid">
                    <!-- Row for Statistics Cards -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAI แผ่นภูมิวงกลม</h4>
                                    <p class="card-category">คะแนนคิดเป็นเปอร์เซ็นต์ทั้งหมด (0-5 คะแนน)</p>
                                </div>
                                <div class="card-body">
                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Mobility: {{ $mobilityPercentage }}%
                                        <i class="fa fa-circle text-danger"></i> Confuse: {{ $confusePercentage }}%
                                        <i class="fa fa-circle text-warning"></i> Feed: {{ $feedPercentage }}%
                                        <i class="fa fa-circle" style="color: purple;"></i> Toilet: {{ $toiletPercentage }}%
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> ข้อมูลอัปเดตล่าสุด
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAI แผ่นภูมิแท่ง</h4>
                                    <p class="card-category">คะแนนคิดเป็นเปอร์เซ็นทั้งหมด (0-5 คะแนน) TAI</p>
                                </div>
                                <div class="card-body">
                                    <div id="chartHours" class="ct-chart"></div>
                                </div>
                                <div class="card-footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Mobility: {{ $mobilityPercentage }}%
                                        <i class="fa fa-circle text-danger"></i> Confuse: {{ $confusePercentage }}%
                                        <i class="fa fa-circle text-warning"></i> Feed: {{ $feedPercentage }}%
                                        <i class="fa fa-circle" style="color: purple;"></i> Toilet: {{ $toiletPercentage }}%
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> ข้อมูลอัปเดตล่าสุด
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row for Statistics Cards -->

                    <!-- Row for Group Counts -->
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Group Counts (Pie Chart)</h4>
                                    <p class="card-category">Percentage of individuals in each group</p>
                                </div>
                                <div class="card-body">
                                    <div id="chartGroupPie" class="ct-chart ct-perfect-fourth"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Group Counts (Bar Chart)</h4>
                                    <p class="card-category">Percentage of individuals in each group</p>
                                </div>
                                <div class="card-body">
                                    <div id="chartGroupBar" class="ct-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row for Group Counts -->
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Chartist JS -->
    <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>
    <!-- Your custom scripts -->
    <script>
        $(document).ready(function() {
            // Data for TAI pie chart
            var mobility = {{ $mobilityPercentage }};
            var confuse = {{ $confusePercentage }};
            var feed = {{ $feedPercentage }};
            var toilet = {{ $toiletPercentage }};

            new Chartist.Pie('#chartPreferences', {
                labels: ['Mobility', 'Confuse', 'Feed', 'Toilet'],
                series: [mobility, confuse, feed, toilet]
            });

            // Data for TAI bar chart
            var data = {
                labels: ['Mobility', 'Confuse', 'Feed', 'Toilet'],
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
</body>
</html>

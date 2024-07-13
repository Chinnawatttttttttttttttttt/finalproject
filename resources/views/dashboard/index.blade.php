<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
                @yield('content')
                <div class="container-fluid">
                    <!-- Row for Statistics Cards -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAI แผ่นภูมิวงกลม </h4>
                                    <p class="card-category">คะแนนคิดเป็นเปอร์เซ็นต์ทั้งหมด ( 0-5 คะแนน)</p>
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
                                    <p class="card-category">คะแนนคิดเป็นเปอร์เซ็นทั้งหมด ( 0-5 คะแนน) TAI</p>
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
                    <!-- Add more content as needed -->
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!-- Google Maps Plugin -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <!-- Chartist Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>
    <!-- Notifications Plugin -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods, dont include it in your project! -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <!-- Your custom scripts -->
    <script>
        $(document).ready(function() {
            // Data for pie chart
            var mobility = {{ $mobilityPercentage }};
            var confuse = {{ $confusePercentage }};
            var feed = {{ $feedPercentage }};
            var toilet = {{ $toiletPercentage }};

            new Chartist.Pie('#chartPreferences', {
                labels: ['Mobility', 'Confuse', 'Feed', 'Toilet'],
                series: [mobility, confuse, feed, toilet]
            });

            // Data for bar chart
            var data = {
                labels: ['Mobility', 'Confuse', 'Feed', 'Toilet'],
                series: [
                    [{{ $mobilityPercentage }}, {{ $confusePercentage }}, {{ $feedPercentage }}, {{ $toiletPercentage }}]
                ]
            };

            // Options for bar chart
            var options = {
                seriesBarDistance: 10,
                axisX: {
                    showGrid: false
                },
                height: "245px"
            };

            // Initialize the bar chart
            new Chartist.Bar('#chartHours', data, options);
        });
    </script>
</body>
</html>

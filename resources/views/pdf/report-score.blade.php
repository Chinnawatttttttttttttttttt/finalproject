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
            text-align: left;
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
</head>
<body>

    <div class="container">
        <h1>รายงานคะแนน</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อผู้สูงอายุ</th>
                    <th>คะแนนการเคลื่อนไหว</th>
                    <th>คะแนนการสับสน</th>
                    <th>คะแนนการให้อาหาร</th>
                    <th>คะแนนการใช้ห้องน้ำ</th>
                    <th>กลุ่ม</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr>
                    <td>{{ $score->id }}</td>
                    <td>{{ $score->elderly->FirstName }} {{ $score->elderly->LastName }}</td>
                    <td>{{ $score->mobility }}</td>
                    <td>{{ $score->confuse }}</td>
                    <td>{{ $score->feed }}</td>
                    <td>{{ $score->toilet }}</td>
                    <td>{{ isset($score->group) ? $score->group->name : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="charts">
            <div class="chart-container">
                <canvas id="mobilityBarChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="confusePieChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="toiletDoughnutChart"></canvas>
            </div>
            <!-- แผนภูมิรวมคะแนนทั้งหมด (Pie Chart) -->
            <div class="chart-container">
                <canvas id="allScoresPieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var scores = @json($scores);

            // ฟังก์ชันเพื่อสรุปคะแนนตามกลุ่ม
            function summarizeByGroup(scores, scoreType) {
                return scores.reduce((acc, score) => {
                    const groupName = score.group ? score.group.name : 'Unknown';
                    if (!acc[groupName]) {
                        acc[groupName] = 0;
                    }
                    acc[groupName] += score[scoreType];
                    return acc;
                }, {});
            }

            // สรุปข้อมูล
            var mobilityGroupTotals = summarizeByGroup(scores, 'mobility');
            var confuseGroupTotals = summarizeByGroup(scores, 'confuse');
            var feedGroupTotals = summarizeByGroup(scores, 'feed');
            var toiletGroupTotals = summarizeByGroup(scores, 'toilet');

            // แผนภูมิสำหรับคะแนนการเคลื่อนไหว (Bar Chart)
            var mobilityBarChartCtx = document.getElementById('mobilityBarChart').getContext('2d');
            new Chart(mobilityBarChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(mobilityGroupTotals),
                    datasets: [{
                        label: 'คะแนนการเคลื่อนไหว',
                        data: Object.values(mobilityGroupTotals),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // แผนภูมิวงกลมสำหรับคะแนนการสับสน (Pie Chart)
            var confusePieChartCtx = document.getElementById('confusePieChart').getContext('2d');
            new Chart(confusePieChartCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(confuseGroupTotals),
                    datasets: [{
                        label: 'คะแนนการสับสน',
                        data: Object.values(confuseGroupTotals),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            // แผนภูมิสำหรับคะแนนการใช้ห้องน้ำ (Doughnut Chart)
            var toiletDoughnutChartCtx = document.getElementById('toiletDoughnutChart').getContext('2d');
            new Chart(toiletDoughnutChartCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(toiletGroupTotals),
                    datasets: [{
                        label: 'คะแนนการใช้ห้องน้ำ',
                        data: Object.values(toiletGroupTotals),
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            // แผนภูมิวงกลมสำหรับคะแนนทั้งหมด (Pie Chart)
            var allScoresPieChartCtx = document.getElementById('allScoresPieChart').getContext('2d');
            new Chart(allScoresPieChartCtx, {
                type: 'pie',
                data: {
                    labels: ['การเคลื่อนไหว', 'การสับสน', 'การให้อาหาร', 'การใช้ห้องน้ำ'],
                    datasets: [{
                        label: 'คะแนนทั้งหมด',
                        data: [
                            Object.values(mobilityGroupTotals).reduce((a, b) => a + b, 0),
                            Object.values(confuseGroupTotals).reduce((a, b) => a + b, 0),
                            Object.values(feedGroupTotals).reduce((a, b) => a + b, 0),
                            Object.values(toiletGroupTotals).reduce((a, b) => a + b, 0)
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            setTimeout(function() {
                window.print();
            }, 100); // เพิ่มการหน่วงเวลาเพื่อให้แน่ใจว่าข้อมูลโหลดเสร็จ
        });
    </script>
</body>
</html>

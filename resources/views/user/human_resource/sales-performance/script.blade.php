{{-- Generic Chart Loader Script Begins --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{-- Generic Chart Loader Script Ends --}}

{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load Google Charts library
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        @foreach ($monthlySales as $sale)
            drawChart({{ $sale->id }}, '{{ $sale->name }}', {{ $sale->January }}, {{ $sale->February }},
                {{ $sale->March }}, {{ $sale->April }}, {{ $sale->May }}, {{ $sale->June }},
                {{ $sale->July }}, {{ $sale->August }}, {{ $sale->September }}, {{ $sale->October }},
                {{ $sale->November }}, {{ $sale->December }});
        @endforeach
    }

    function drawChart(id, name, january, february, march, april, may, june, july, august, september, october, november,
        december) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Sales Amount(₦)');
        data.addRows([
            ['January', january],
            ['February', february],
            ['March', march],
            ['April', april],
            ['May', may],
            ['June', june],
            ['July', july],
            ['August', august],
            ['September', september],
            ['October', october],
            ['November', november],
            ['December', december]
        ]);

        var options = {
            title: 'Monthly Sales Chart for ' + name,
            // + ' (User ID: ' + id + ')', Add/ User ID
            legend: {
                position: 'none'
            },
            hAxis: {
                title: 'Month'
            },
            vAxis: {
                title: 'Sales (₦)'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div' + id));
        chart.draw(data, options);
    }
</script> --}}


{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        @foreach ($chartData as $userData)
            drawChart_{{ $userData['user_id'] }}();
        @endforeach
    }

    @foreach ($chartData as $userData)
        function drawChart_{{ $userData['user_id'] }}() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Sales');
            data.addColumn('number', 'Target');

            @foreach ($months as $month)
                data.addRow(['{{ $month }}', {{ $userData['sales'][$month] ?? 0 }},
                    {{ $userData['target']['target'] }}
                ]);
            @endforeach

            var options = {
                title: 'Sales vs. Target for {{ $userData['user_name'] }}',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById(
                'chart-container-{{ $userData['user_id'] }}'));
            chart.draw(data, options);
        }
    @endforeach
</script> --}}


{{-- //Graph for each user against target --}}
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        @foreach ($chartData as $userData)
            drawChart_{{ $userData['user_id'] }}();
        @endforeach
    }

    @foreach ($chartData as $userData)
        function drawChart_{{ $userData['user_id'] }}() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Sales');
            data.addColumn('number', 'Target');

            var dataArray = [
                @foreach ($months as $month)
                    ['{{ DateTime::createFromFormat('!m', $month)->format('F') }}',
                        {{ $userData['sales'][$month] ?? 0 }}, {{ $userData['target']['target'] }}
                    ],
                @endforeach
            ];

            data.addRows(dataArray);

            var options = {
                title: 'Sales vs. Target for {{ $userData['user_name'] }}',
                bars: 'vertical', // Display bars vertically
                legend: {
                    position: 'bottom'
                },
                // Display data labels on top of each bar
                vAxis: {
                    format: 'decimal'
                },
                series: {
                    0: {
                        dataLabel: 'value'
                    },
                    1: {
                        dataLabel: 'value'
                    }
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(
                'chart-container-{{ $userData['user_id'] }}'));
            chart.draw(data, options);
        }
    @endforeach
</script>
{{-- //Graph for each user against target --}}

{{-- Team Performance Comparison Script Begins  --}}
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // JSON data from Laravel
        var jsonData = {!! $jsonData !!};

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        // Add columns for each user
        jsonData.forEach(function(user) {
            data.addColumn('number', user.name);
        });

        // Add rows for each month
        var months = Object.keys(jsonData[0].data);
        months.forEach(function(month) {
            var row = [month];
            jsonData.forEach(function(user) {
                row.push(user.data[month]);
            });
            data.addRow(row);
        });

        var options = {
            title: 'Team Performance Comparison',
            // curveType: 'function',
            bars: 'vertical',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('team_chart'));
        chart.draw(data, options);
    }
</script>
{{-- Team Performance Comparison Script  Ends --}}

{{-- Combined Team Performance  Script Begins  --}}
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Total Sales');

        // Populate the data table.
        data.addRows([
            <?php foreach ($totalTeamDataForChart as $data): ?>['<?php echo $data['month']; ?>', <?php echo $data['total_sales']; ?>],
            <?php endforeach; ?>
        ]);

        // Set chart options
        var options = {
            title: 'Monthly Sales',
            is3D: true, // Optionally keep is3D true for a 3D effect
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
{{-- Combined Team Performance Script  Ends --}}

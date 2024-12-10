// public/js/charts.js

// Load Google Charts library
google.charts.load('current', {'packages':['corechart']});
console.log('js');
// Callback function to draw charts
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    @foreach ($monthlySales as $sale)
        drawChart{{ $sale->id }}();
    @endforeach
}

// Function to draw chart for a specific user
function drawChart{{ $sale->id }}() {
    var data{{ $sale->id }} = new google.visualization.DataTable();
    data{{ $sale->id }}.addColumn('string', 'Month');
    data{{ $sale->id }}.addColumn('number', 'Sales');

    // Add data rows for each month
    data{{ $sale->id }}.addRows([
        ['January', {{ $sale->January }}],
        ['February', {{ $sale->February }}],
        ['March', {{ $sale->March }}],
        ['April', {{ $sale->April }}],
        ['May', {{ $sale->May }}],
        ['June', {{ $sale->June }}],
        ['July', {{ $sale->July }}],
        ['August', {{ $sale->August }}],
        ['September', {{ $sale->September }}],
        ['October', {{ $sale->October }}],
        ['November', {{ $sale->November }}],
        ['December', {{ $sale->December }}]
    ]);

    var options{{ $sale->id }} = {
        title: 'Monthly Sales for {{ $sale->name }} (User ID: {{ $sale->id }})',
        legend: { position: 'none' },
        hAxis: {
            title: 'Month'
        },
        vAxis: {
            title: 'Sales'
        }
    };

    var chart{{ $sale->id }} = new google.visualization.ColumnChart(document.getElementById('chart_div{{ $sale->id }}'));
    chart{{ $sale->id }}.draw(data{{ $sale->id }}, options{{ $sale->id }});
}

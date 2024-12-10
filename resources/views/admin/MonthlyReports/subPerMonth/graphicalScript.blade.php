<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
console.log(<?php echo $result;?> )
  if(<?php echo $result;?> != 0){
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['Service Type', 'Active Subscribers'],
            ['Home',    <?php echo $home_count;?> ],
            ['SME',      <?php echo $SME_count;?>],
            ['Dedicated', <?php echo $dedicated_count;?> ]
      ]);

      var options = {
        title: "<?php echo $current;?> Active Subscribers",
        is3D: true,
      
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  }
</script>

  <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Month', 'Active', 'Inactive', 'Suspended'],
          <?php echo $HomechartData;?>
          ]);
          var options = {
            chart: {
              title:  'Home Subscribers Statistics For Current Year' ,
              subtitle:'Monthly Home Subcribers for each Month',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
              x: {
                0: { side: 'bottom', label: 'Months'} // Top x-axis.
              }
            },
            bar: { groupWidth: "40%" },
          };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('Home'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  </script>


  <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Month', 'Active', 'Inactive', 'Suspended'],
          <?php echo $SMEchartData;?>
          ]);
          var options = {
            chart: {
              title:  'SME Subscribers Statistics For Current Year' ,
              subtitle:'Monthly SME Subcribers for each Month',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
              x: {
                0: { side: 'bottom', label: 'Months'} // Top x-axis.
              }
            },
            bar: { groupWidth: "40%" },
          };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('SME'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  </script>


  <script type="text/javascript">
    // Dedicated Subscribers
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Active', 'Inactive', 'Suspended'],
         <?php echo $HomechartData;?>
        ]);
        var options = {
          chart: {
            title:  'Dedicated Subscribers Statistics For Current Year' ,
            subtitle:'Monthly Dedicated Subcribers for each Month',
          },
          bar: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Months'} // Top x-axis.
            }
          },
          bar: { groupWidth: "40%" },
        };
          // Instantiate and draw our chart, passing in some options.
          var chart = new google.charts.Bar(document.getElementById('Dedicated'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>
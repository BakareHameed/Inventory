<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Days');    
            data.addColumn('number', 'Survey');
            data.addRows([
              <?php echo $daily
           ?>
            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Months');
            data2.addColumn('number', 'Surveys');
            data2.addRows([
              <?php echo $monthly
           ?>
            ]);

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Year');
            data3.addColumn('number', 'Survey');
         
            data3.addRows([
           <?php echo $data
           ?>
            ]);

            // Set chart options
            var options = {

                  'title': 'Daily Survey Report Graph',
          width: 800,
          height: 600,
          legend: { position: 'none' },
          chart: { title: 'Daily Survey Report Graph',
                   subtitle: '' },
          bar: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Month'} // Top x-axis.
            }
          },
          bar: { groupWidth: "80%" },
       };
            // Set chart options
            var options2 = {
                  'title': 'Monthly Survey Report Graph',
          width: 800,
          height: 700,
          legend: { position: 'none' },
          chart: { title: 'Monthly Survey Report Graph',
                   subtitle: '' },
          bar: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Month'} // Top x-axis.
            }
          },
          bar: { groupWidth: "80%" },
        
        };
            // Set chart options
            var options3 = {

              'title': 'Yearly Survey Report Graph',
          width: 800,
          height: 700,
          legend: { position: 'none' },
          chart: { title: 'Monthly Survey Report Graph',
                   subtitle: '' },
          bar: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Month'} // Top x-axis.
            }
          },
          bar: { groupWidth: "80%" },
        };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);

          }
        </script>

@include('admin.css')
      </head>
   


  <body>
    <div class="container-scroller" style="background-color:#39d8e3">
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')

      <!-- partial -->
    
      @include('admin.navbar')
        <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->


    
  
    <table class="columns">
      <tr>
      <td>  
        <div id="chart_div" align="right" style="padding-right:60px;padding-top:30px;padding-bottom:30px;padding-left:60px">
        </div>
      </td>
      <tr>
        <td>  
          <div id="chart_div2" align="right" style="padding-right:60px;padding-top:30px;padding-bottom:30px;padding-left:60px">
          </div>
        </td>
      </tr>
      <tr>
        <td>  
          <div id="chart_div3" align="right" style="padding-right:60px;padding-top:30px;padding-bottom:30px;padding-left:60px">
          </div>
        </td>
      </tr>
    </table>










@include('admin.script')



  </body>
</html>



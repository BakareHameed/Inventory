<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    
    <!-- @include('admin.css') -->
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')

      <!-- partial -->
    
      @include('admin.navbar')
        <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
	<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Surveys'],
         <?php echo $data
       
         
         ?>
       
        ]);

        var options = {
          title: 'Monthly Survey Report Graph',
          // curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
   </head>
  <body>
    <div id="curve_chart" style="width: 50rem; height: 40rem; "  >
    <input type="date" onchange="Month(this)" style="color:green">
  </div>
  </body>
</html>



@include('admin.script')
    <!-- End custom js for this page -->




  </body>
</html>
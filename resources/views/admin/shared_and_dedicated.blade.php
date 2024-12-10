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
          ['Service Plan', 'Service Plan Count'],
          <?php echo $chartdata;?>
        ]);

        var options = {
          title: 'Active Shared and Dedicated Service Customers Chart',
		  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 70rem; height: 41rem;"></div>
  </body>
</html>


   @include('admin.script')
    <!-- End custom js for this page -->




  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    @include('admin.MonthlyReports.subPerMonth.graphicalScript')
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
    @include('admin.MonthlyReports.subPerMonth.periodic-dashboard-extension')

    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
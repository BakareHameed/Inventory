<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->


    
    @include('admin.css')
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
@include('admin.MD_home')

@include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
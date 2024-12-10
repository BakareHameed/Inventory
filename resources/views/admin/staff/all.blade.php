<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <style>
      thead {color: green;}
      tbody {color: blue;}
      tfoot {color: red;}
      table, th, td {
        border: 1px solid black;
        border-radius: 2px;
      }
      .flex{
        margin-left:-5%;
        margin-top: 2%;
        margin-right:4%;
      }
    </style>
    
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
        @include('admin.staff.dashboard')

        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
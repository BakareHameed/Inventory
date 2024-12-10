<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

  <script src="http://10.0.0.244:8081/js/app.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Script for Multi-level dropdown list  -->
    <script>
      $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
          $(this).next('ul').toggle();
          e.stopPropagation();
          e.preventDefault();
        });
      });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
    <style>
        .dropdown-submenu {
          position: relative;
          background-color:white;
          color:black;
          font-size:18.5px;
        }
        .dropdown-submenu .dropdown-menu {
          position:absolute; top:50px; right:50px;
          background-color: #f0e9e9;
          color:#f2f7c6;
          font-size:18.5px;
        }
        .dropdown-item:hover{
          color:black
        }
        .dropdown-submenu :hover{
          color:black;
        }
    </style>
      <!-- End of Styling for multi-level dropdown -->     
    <style>
      thead {color: black;}
      tbody {color: red;}
      tfoot {color: red;}
      table, th, td {
        border: 2px solid black;
        radius: 10px;
      }
    </style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('admin.POPs.state.header')

  <div class="row" style ="margin-left:10px;margin-top:20px" align="Center">
    <div class="col-xl-2 col-xl-2  mb-4" align="Center">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Pops Count</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                </div>
                <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-xl-2  mb-4" align="Center">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Total Client Count</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$clients}} </div>
                </div>
                <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>
  </div>

  <div align="Center" style="padding-top:10px;padding-bottom:10px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">POPs in all States from {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
            To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}</h1>
    </div>
  </div>

  <div align="center" style="padding-right:30px;padding-top:10px;padding-bottom:30px">
    <table border=1 align='center'>
      <tr style="background-color:black;">
          <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
          <th style="padding:5px; font-size: 20px; color: white ;">POP Name</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Location</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Region</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Trunk IP</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Base Cluster IP</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Activated Date</th>
      </tr>
      @foreach($allPOPs as $cl_state)
          <tr style="background-color: #e8dbca;" align="left">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace" >{{$cl_state->POP_name }}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace" >{{$cl_state->location }}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace">{{$cl_state->Region }}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace">{{$cl_state->Trunk_IP }}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace">{{$cl_state->Base_Cluster_IP }}</td>
            <td style="padding: 5px; color: black;font-size: 20px; font-family:serif, sans serif, cursive, fantasy, and monospace">{{$cl_state->Activated_Date }}</td>
          </tr>
      @endforeach
    </table>      	
  </div>
  <!-- All Scripts -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- All Scripts End -->
</body>
</html>
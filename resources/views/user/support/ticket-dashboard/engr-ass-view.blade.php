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

    <!-- For Authorised user header -->
    @if(Auth::user()->role == "Service Engineer")
        @include('user.service_engr.header')
    @else
        @include('user.support.header')
    @endif
    <!--End of Authorised user header -->

    <!-- Modal View for Engrs -->
    
    <!--End of Modal View for Engrs -->
 <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
      <h1 class="text-center" style="text-align:center;font-size:2rem">
        <strong>         
            All Tickets for Engineer {{ $engrName }} {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}</h4>
        </strong> 
      </h1>
    </div>
</div>


    <div class="container" align="left" >
                <div class="">
                    <div class="col-sm-3  mb-4">
                        <div class="card bg-gray border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> {{$count}} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                           Count
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="pt-5 pb-4 col-lg-12">
                <div class="">
                    <table border="0">
                        <tr style="background-color:black;">
                            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Client</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Fault</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Level</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Type</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Details</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Started?</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Ended?</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                            <th style="padding:5px; font-size: 20px; color: white ;">Report</th>
                        </tr>
                        @foreach($engrAssView as $engrView)
                            <tr style="background-color: white;" align="left">
                                <td>{{$loop->iteration}}</td>
                                <td style="padding: 3px; color: black;">{{$engrView->client_name}}</td>
                                <td style="padding: 3px; color: black;">{{$engrView->fault}}</td>
                                <td style="padding: 3px; color: black;">{{$engrView->fault_level}}</td>
                                <td style="padding: 3px; color: black;">{{$engrView->fault_type}}</td>
                                <td style="padding: 3px; color: black;">{{$engrView->fault_details}}</td>
                                <td style="padding: 3px; color: black;" >{{Carbon\Carbon::parse($engrView->start_time)->format('D, M j, Y g:i A')}}</td>
                                <td style="padding: 3px; color: black;" >
                                  @if($engrView->status==="Done" || $engrView->status==="Closed")
                                    {{Carbon\Carbon::parse($engrView->submitted_at)->format('D, M j, Y g:i A')}}
                                  @else
                                    NA
                                  @endif
                                </td>
                                <td style="padding: 3px; color: black;">{{$engrView->status}}</td>
                                <td style="padding: 3px; color: black;" >
                                  @if($engrView->status==="Done" || $engrView->status==="Closed")
                                    <span><strong>Submitted-{{Carbon\Carbon::parse($engrView->submitted_at)->format('D, M j, Y g:i A')}}</strong><span><br>
                                    <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary" href="{{url('ticket_report',$engrView->ticket_id)}}">
                                      View
                                    </a>
                                  @else
                                    No Report Yet
                                  @endif
                                  <span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
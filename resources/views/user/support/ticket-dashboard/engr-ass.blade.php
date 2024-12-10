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
        radius: 10px
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
        <strong> All Pending Engineers Assignments As At {{Carbon\Carbon::parse($Currentdate)->format(' D, j F,Y')}} </strong> 
      </h1>
    </div>
</div>


    <div class="container" align="left" >
        
            <div class="row">
                @foreach($EngrAssNotdone as $engr)
                    <div class="col-sm-3  mb-4">
                        <div class="card bg-gray border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> {{count($engr)}} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                            {{$engr->unique('first_engr')->pluck('first_engr')->implode(', ')}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pt-5">
                <h4 class="card-title" style="font-size:20px">
                <strong class = "text-secondary">
                    Ticket Statistics for Each Engineer in {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}</h4>
                </strong>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="font-size:20px"> S/N </th>
                            <th style="font-size:20px"> Engineer</th>
                            <th style="font-size:20px"> Tickets Assigned</th>
                            <th style="font-size:20px">Pending</th>
                            <th style="font-size:20px">Reported</th>
                            <th style="font-size:20px">Closed</th>
                            <th style="font-size:20px">Action</th>
                        </tr>
                        </thead>

                        @foreach($allEngrAss as $allEngrAss)
                            <tbody>
                            <tr>
                                <td style="font-size:20px ;color:black;">{{$loop->iteration}}</td>
                                <td style="font-size:20px ;color:black;">{{$allEngrAss->unique('first_engr')->pluck('first_engr')->implode(' ')}} </td>
                                <td style="font-size:20px ;color:black;">{{$allEngrAss->unique('asgts')->pluck('asgts')->implode('')}}</td>
                                <td style="font-size:20px ;color:black;">{{$allEngrAss->unique('pending')->pluck('pending')->implode('')}}</td>
                                <td style="font-size:20px ;color:black;">{{$allEngrAss->unique('done')->pluck('done')->implode('')}}</td>
                                <td style="font-size:20px ;color:black;">{{$allEngrAss->unique('closed')->pluck('closed')->implode('')}}</td>
                                <td style="font-size:0px ;color:black;">
                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{ url('engr-assgt-view',['id'=>$allEngrAss->unique('first_engr_id')->pluck('first_engr_id')->implode('')])}}">view</a><span>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class ="pt-5">
                    <h4 class="card-title" style="font-size:20px">
                        <strong class = "text-secondary"> 
                            Internally Resolved Ticket Statistics By Each Personnel in {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}
                        </strong>
                    </h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="font-size:20px;"> S/N </th>
                            <th style="font-size:20px;"> Personnel</th>
                            <th style="font-size:20px;"> Tickets Assigned</th>
                            <th style="font-size:20px;">Pending</th>
                            <th style="font-size:20px;">Reported</th>
                            <th style="font-size:20px;">Closed</th>
                            </tr>
                        </thead>

                        @foreach($allSupportAss as $allSupportAss)
                            <tbody>
                            <tr>
                                <td style="font-size:20px; color: black">{{$loop->iteration}}</td>
                                <td style="font-size:20px; color: black">{{$allSupportAss->first_engr}} </td>
                                <td style="font-size:20px; color: black">{{$allSupportAss->asgts}}</td>
                                <td style="font-size:20px; color: black">{{$allSupportAss->pending}}</td>
                                <td style="font-size:20px; color: black">{{$allSupportAss->done}} </td>
                                <td style="font-size:20px; color: black">{{$allSupportAss->closed}} </td>
                                <td style="font-size:0px ;color:black;">
                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{ url('engr-assgt-view',['id'=>$allSupportAss->first_engr_id])}}">view</a><span>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
                   
 
<div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-10">
	<div class="flex flex-col mt-6">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<div class="shadow overflow-hidden sm:rounded-lg">
                    
                   
                <diV>        
            </div>
            <!-- -->
            <!-- -->
        </div>
      <!-- Component End  -->
    </div>
  <div>
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
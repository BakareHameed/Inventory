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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- End of Multi-level script -->     

   <!-- Styling for multi-level dropdown -->
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
thead {color: green;}
tbody {color: blue;}
tfoot {color: red;}

table, th, td {
  border: 1px solid black;
}
</style>

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Comms.</a>

        <form action="{{url('search')}}" method="GET" class="d-flex">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
 
            
          
<!--Beginning of of Multi-Level Navbar -->

        <li class="nav-item nav-settings d-none d-lg-block">

        <div class="dropdown">
        <button class="btn btn-outline-info dropdown-toggle"  type="button" style ="font-size:15px" data-toggle="dropdown">
        Subscription
        <span class="caret"></span></button>
        <ul class="dropdown-menu">

        <li class="dropdown-submenu">
        <a class="test" href="#">SME Clients<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{url('Active_sme')}}">Active SME Clients</a></li>
        <li><a class="dropdown-item"  href="{{url('Inactive_sme')}}">Inactive SME Clients</a></li>

        </ul>
        </li>

        <li class="dropdown-submenu">

        <a class="test" href="#">Dedicated<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item"  href="{{url('active_Dedicated_clients')}}">Active Clients</a></li>
        <li><a class="dropdown-item" href="{{url('inactive_Dedicated_clients')}}">Inactive Client</a></li>

        </ul>
        </li>

        <li class="dropdown-submenu">

        <a class="test" href="#">Home Clients<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item"  href="{{url('active_Home_clients')}}">Active Clients</a></li>
        <li><a class="dropdown-item" href="{{url('inactive_Home_clients')}}">Inactive Client</a></li>

        </ul>
        </li>

        </ul>
        </div>


<!--End of Multi-Level Navbar -->


            <li class="nav-item">
            <div class="btn-group" style="color: black; font-size:15px">
                <button type="button" class="btn btn-outline-secondary  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Client Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('pending_client')}}">Pending Client</a></li>
                  <li><a class="dropdown-item" href="{{url('new_sales')}}">New Sales</a></li>
                  <li><a class="dropdown-item" href="{{url('all_clients')}}">All Clients Information</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/">About Finance Team</a></li>
                </ul>
              </div>
          </li>

          
          <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>

            <li class="nav-item">
            <div class="btn-group" style="color: black; font-size:15px">
                <button type="button" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Clients Category
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('sme_clients')}}">SME Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('home_clients')}}">Home Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('dedicated_clients')}}">Dedicated Clients</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <!-- <li><a class="dropdown-item" href="/">About Finance Team</a></li> -->
                </ul>
              </div>
          </li>
            <x-app-layout> 
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


 
<div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <h2 style="font-size:20px">Get All Active Postpaid Customers Between:</h2>
    <form class="main-form" action="{{url('active_Dedicated_customers_report')}}" method="GET" enctype="multipart/form-data">

      @csrf
            <div class="container">
            <div class="row">
                <div class="form-group name1 col-md-6">
                    <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                    <input style="background-color:white" type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                </div>

                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                    <input style="background-color:white"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                </div>
            </div>  
            <button class="btn btn-outline-success" type="submit">Get</button>
        </div>   
    </form>
 </div>


 <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">
        All Active Postpaid Clients From {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
                To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
      </h1>
    </div>
</div>


    <div class="container" align="text-center" style="padding-top: 5px;">
        <div class="row">
            <div class="col-xl-3 col-xl-4  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Active Postpaid Clients</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
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
        </div>
       
        <div align="center" style="margin-left:15px;padding-top:30px">
          <table border=1 align='center' style= "margin-bottom: 50px;">
            <tr style="background-color:black;">
                <th style="padding:20px; font-size: 20px; color: white ;">S/N</th>
                <th style="padding:20px; font-size: 20px; color: white ;">Customer ID</th>
                <th style="padding:20px; font-size: 20px; color: white ;text-alignment:left">Client</th>
                <th style="padding:20px; font-size: 20px; color: white ;">Service Plan</th>
                <th style="padding:20px; font-size: 20px; color: white ;">Service Type</th>
                <th style="padding:20px; font-size: 20px; color: white ;">Deployed Date</th>
                <th style="padding:20px; font-size: 20px; color: white ;">Status</th>
            </tr>
			@foreach($active_dedicated as $postpaid_cust)
                <tr style="background-color: #e8dbca;" align="left">
                    <td>{{$loop->iteration}}</td>
                    <td style="padding: 10px; color: black;">{{$postpaid_cust->customer_id}}</td>
                    <td style="padding: 10px; color: black;">{{$postpaid_cust->clients}}</td>
                    <td style="padding: 10px; color: black;">{{$postpaid_cust->service_plan}}</td>
                    <td style="padding: 10px; color: black;">{{$postpaid_cust->service_type}}</td>
                    <td style="padding: 10px; color: black;">{{$postpaid_cust->created_at}}</td>
                    @if($postpaid_cust->status=='Active')
                        <td style="padding: 10px; color: black;  background-color: #8febab">{{$postpaid_cust->status}}</td>
                    @elseif($postpaid_cust->status=='Inactive')
                        <td style="padding: 10px; color: black;  background-color: yellow">{{$postpaid_cust->status}}</td>
                    @else
                        <td style="padding: 10px; color: black;  background-color: #fc6d6d ">{{$postpaid_cust->status}}</td>
                    @endif
                        
                </tr>
            @endforeach
		</table>      	
      </div>
    <div>
</div>
</x-app-layout> 


      <script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">


     <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

        <form action="{{url('all_survey_report_search')}}" method="GET" class="d-flex">
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
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Engineers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>

            <li class="nav-item">
                <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Survey Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
                  <li><a class="dropdown-item" href="{{url('monthly_installation')}}">Monthly Installation</a></li>
                  <li><a class="dropdown-item" href="{{url('monthly_survey_report')}}">Monthly Survey Report</a></li>
                  <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#"></a></li>
                </ul>
              </div>
          </li>

          
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


  <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <span>  
            <h2>Get Surveys Done:</h2>
            <form class="main-form" action="{{url('survey_reporting')}}" method="GET" enctype="multipart/form-data">

              @csrf
                    <div class="container">
                    <div class="row">
                        <div class="form-group name1 col-md-6">
                            <label for="exampleInputEmail1" class="formText">From:*</label>
                            <input  type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText">To:*</label>
                            <input   type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                        </div>
                    </div>  
                    <button class="btn btn-outline-success" type="submit">Get</button>
                </div>   
            
            </form>
        </span>
      </div>
 

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:30px">
        Report of Surveys carried out from 
        {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
         To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}</h1>
    </div>
</div>


<div class="row container " style="padding-left:30px;padding-bottom:30px">

<!-- Earnings (Monthly) Card Example -->
<div class="col-sm-3 col-md-2 mb-2">
  <div class="card border-right-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Count</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div  class="col-lg-6 py-3 wow fadeInUp text-center" style ='position:absolute; left:1030px; top:400px'>
        <a  style ='align:right' class='btn btn-sm btn-primary' href="{{url('delivery_survey_export/' . $dateS. '/' . $dateE .'')}}">
            Download Excel
        </a>
    </div>

    <div class="container" align="text-center" style="padding-top: 5px;">


      <div align="Center" style="padding-left:10px;padding-bottom:30px">
    
		<table border=1>
			
			<tr style="background-color:black;">
            <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
				<th style="padding:10px; font-size: 20px; color: white ;">ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Client Name</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Contact Person Name</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>

        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>

        <th style="padding:10px; font-size: 20px; color: white ;"> Assigned Engr</th>
    
        <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Marketer</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
     
   
        </tr>

			@foreach($survey_reporting as $appointment)

			<tr style="background-color: white" align="center">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->id}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->customer_email}}</td>
			
        <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
 
        <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->date}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
        @if($appointment->download_bandwidth == null)
        <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}</td>
        @else
        <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td> 
        @endif



        @if ($appointment->third_assigned_engr !== null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null)
        <td style="padding: 10px; color: black;">{{$appointment->third_assigned_engr}}</td>

        @elseif ($appointment->third_assigned_engr == null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null )
        <td style="padding: 10px; color: black;">{{$appointment->second_assigned_engr}}</td>

        @else
      <td style="padding: 10px; color: black;">{{$appointment->first_assigned_engr}}</td>
@endif

        <td style="padding: 10px; color: black;">{{$appointment->feasibility}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->name}}</td>
        <td><a class="btn btn-primary" href="{{url('delivery_survey_report',$appointment->id)}}">view survey report</a></td>
        <!-- <td><a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('commentview',$appointment->id)}}">comment</a></td> -->
        	
      
      </tr>
       
			@endforeach


		</table>      	
    




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
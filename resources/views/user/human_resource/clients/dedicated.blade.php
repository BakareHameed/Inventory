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
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span></a>

        <form action="{{url('/')}}" method="GET" class="d-flex">
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
              <a class="nav-link" href="contact.html">Contact</a>
            </li>

            
          
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>


            <li class="nav-item">
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Clients Category
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('sme_clients_hr')}}">SME Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('home_clients_hr')}}">Home Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('dedicated_clients_hr')}}">Dedicated Clients</a></li>
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


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">All Dedicated Clients</h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">


@if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

<div >
<div class="row">

<div class="col-xl-3 col-xl-4  mb-4">
 <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. Dedicated Clients</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Dedicated_clients}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-xl-4  mb-4">
 <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. of Subscribed Dedicated Clients for This Month</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$subscribed_dedicated_clients}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-xl-4 mb-4">
 <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1">No. of New Dedicated Clients for this month</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$new_dedicated_clients}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
      <div align="left" style="padding-right:30px;padding-top:30px">
    
		<table border=1 align='left'>
			
			<tr style="background-color:black;">
            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>

        <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
		<th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
        <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>

				<th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Bandwidth</th>
         <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
         <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th>

      
       


			@foreach($appointments as $appointment)

			<tr style="background-color: #e8dbca;" align="left">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 5px; color: black;">{{$appointment->id}}</td>
				<td style="padding: 5px; color: black;">{{$appointment->clients}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->customer_email}}</td>
			
        <td style="padding: 5px; color: black;">{{$appointment->phone}}</td>
 
        <td style="padding: 5px; color: black;">{{$appointment->address}}</td>
       
				<td style="padding: 5px; color: black;">{{$appointment->service_plan}}</td>
				<td style="padding: 5px; color: black;">{{$appointment->service_type}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->upload_bandwidth}}{{$appointment->unit}}</td>
        @if($appointment->status=='Active')
        <td style="padding: 5px; color: black;  background-color: #8febab">{{$appointment->status}}</td>
        @elseif($appointment->status=='Inactive')
        <td style="padding: 5px; color: black;  background-color: yellow">{{$appointment->status}}</td>
        @else
        <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$appointment->status}}</td>
        @endif
        
        <td style="padding: 5px; color: black;">{{$appointment->created_at}}</td>
  

       
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
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

              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  @if($appointments)

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center">Search Result for assigned Client's Survey</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">
    
		<table border=1>
			
			<tr style="background-color:black;">
				<th style="padding:10px; font-size: 20px; color: white ;">ID</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Client</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>

        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Message</th>
        <th style="padding:10px; font-size: 20px; color: white ;"> Assigned Engr</th>
    

        <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
     
     
			@foreach($appointments as $appointment)

			<tr style="background-color: white;" align="center">

            <td style="padding: 10px; color: black;">{{$appointment->id}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->customer_email}}</td>
			
        <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
 
        <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->date}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
				<td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->message}}</td>
       
        @if ($appointment->third_assigned_engr !== null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null)
        <td style="padding: 10px; color: black;">{{$appointment->third_assigned_engr}}</td>

        @elseif ($appointment->third_assigned_engr == null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null )
        <td style="padding: 10px; color: black;">{{$appointment->second_assigned_engr}}</td>

        @else
      <td style="padding: 10px; color: black;">{{$appointment->first_assigned_engr}}</td>
@endif


        <td><a class="btn btn-primary" href="{{url('assigned_engr_form',$appointment->id)}}">Report</a></td>

       
			@endforeach


		</table>      	
    

@endif


      </div>



      <script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
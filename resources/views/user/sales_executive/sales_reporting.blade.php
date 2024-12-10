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

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
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
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


 

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:20px">
        My clients from 
        {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
        To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
      </h1>
    </div>
</div>



<div  class="col-lg-6 py-3 wow fadeInUp text-center" style ='align:right'>
        <a class='btn btn-sm btn-primary' href="{{url('sales_customers_export/' . $dateS. '/' . $dateE .'')}}">
            Download Excel
        </a>
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

      <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
    
		<table border="0">
			
			<tr style="background-color:black;">
      <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Customer-ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Client</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Contact Person</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>

 
  
        <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Date Deployed</th>
        
       


			@foreach($sales_report as $appointment)

			<tr style="background-color: skyblue;" align="left">

            <td style="padding: 3px; color: black;">{{$appointment->id}}</td>
            <td style="padding: 3px; color: black;">{{$appointment->customer_id}}</td>
            <td style="padding: 3px; color: black;">{{$appointment->clients}}</td>
				<td style="padding: 3px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 3px; color: black;">{{$appointment->customer_email}}</td>
			
        <td style="padding: 3px; color: black;">{{$appointment->phone}}</td>
 
        <td style="padding: 3px; color: black;">{{$appointment->address}}</td>
        <td style="padding: 3px; color: black;">{{$appointment->date}}</td>
				<td style="padding: 3px; color: black;">{{$appointment->service_plan}}</td>
				<td style="padding: 3px; color: black;">{{$appointment->service_type}}</td>
            
            
  
       
       
        <td style="padding: 3px; color: black;" >{{$appointment->status}}</td>
  

        <td style="padding: 3px; color: black;" >₦{{number_format($appointment->amount_paid)}}</td>
      
        <td style="padding: 3px; color: black;">{{$appointment->created_at}}</td>
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
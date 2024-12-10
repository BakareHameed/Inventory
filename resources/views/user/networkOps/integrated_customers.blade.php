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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm"  style="background-color: #e2d1e6;">
      <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

      <form action="{{url('find_integrated')}}" method="GET" class="d-flex">
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
                  Networks
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{url('ready_integration')}}">Ready Integration</a></li>
                  <li><a class="dropdown-item"  href="{{url('integrated_customers')}}">All Integrated Customers</a></li>
                  <li><a class="dropdown-item" href="{{url('all_base_station')}}">All Base Stations</a></li>
                  <!-- <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li> -->
   
                  <li><hr class="dropdown-divider"></li>
                  <!-- <li><a class="dropdown-item" href="#">Other Info.</a></li> -->
                </ul>
              </div>
          </li>
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


<div>
  <div class="col-sm-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:1.5rem">Filter According to POP</h1>
  </div>
        <form class="main-form" action="{{url('POP_filter')}}" method="GET" enctype="multipart/form-data">

              @csrf

              <select name="pop" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                   <option value="">---select POP---</option>
                  
                    <option>Apapa</option>
                    <option>Bashorun</option>
                    <option>Cocoa House</option>
                    <option>Festac</option>
                    <option>GRA Ikeja</option>
                    <option>Ijaiye</option>
                    <option>Ikeja</option>
                    <option>Ikorodu</option>
                    <option>Ligali</option>
                    <option>Logemo</option>
                    <option>Magodo</option>
                    <option>Maryland</option>
                    <option>Ojodu</option>
                    <option>Opic</option>
                    <option>Surulere</option>
                    <option>clients without POP</option>
                  
                    
              
          </select>


          <button class="btn btn-outline-success" type="submit">Filter</button>
          </form>
    </div>


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center; font-size:30px">Integrated Customers</h1>
    </div>
</div>


      <div align="Center" style="padding:5px;padding-bottom:30px">
    
		<table border=1 align="Center">
			
		<tr style="background-color:black;"  >

		<th style="padding:10px; font-size: 20px; color: white ;">Survey ID</th>
		<th style="padding:10px; font-size: 20px; color: white ;">Client</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
		<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
        <th style="padding:10px; font-size: 20px; color: white ;">IP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">VLAN ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Subnet Mask</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Gateway</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Queue Name</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Device</th>
        <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Edit Parameters</th>

    
        </tr>

			@foreach($appointments as $appointment)

		<tr style="background-color: #bdbbf2;" >

        <td style="padding: 10px; color: black;">{{$appointment->survey_id}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>

    <td style="padding: 10px; color: black;">{{$appointment->ip_address}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->vlan_id}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->subnet_mask}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->gateway}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->queue_name}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->device_type}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->pop}}</td>
        <td> <a style="padding: 20px;margin-bottom:20px;align:center" class="btn btn-secondary" href="{{url('edit_integration_parameters',$appointment->id)}}">Edit</a>
</td>
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
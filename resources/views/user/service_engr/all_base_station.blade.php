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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm"  style="background-color: #e3f2fd;">
      <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

      <form action="{{url('find_linked')}}" method="GET" class="d-flex">
        <input class="form-control me-2" name="index" type="search" placeholder="Search" aria-label="Search">
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
                 Link Details
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{url('ready_links')}}">Links Ready for Deployment</a></li>
                  <li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li>
                  <li><a class="dropdown-item" href="{{url('all_base_station')}}">All Base Stations</a></li>
                  <!-- <li><a class="dropdown-item" href="{{url('create_new_base_station')}}">Create New Base Station</a></li> -->
   
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{url('create_new_base_station')}}">Create New Base Station</a></li>
                </ul>
              </div>
          </li>
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  @if(session()->has ('message'))


<div class="alert alert-success">

  <button type="button" class="close" data-dismiss="alert">
    x
  </button>

{{session()->get('message')}}

</div>

@endif


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center"  style="text-align:center, font: size 300px;"> <strong> ALL Base Stations </strong> </h1>
    </div>
</div>


      <div align="Center" style="padding:5px;padding-bottom:30px">
    
		<table border=1 align="Center">
			
		<tr style="background-color:black;" >
        <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
        <th style="padding:10px; font-size: 20px; color: white ;">POP Name</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Site ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Trunk IP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Base/Cluster IP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Longitude</th>
		    <th style="padding:10px; font-size: 20px; color: white ;">Latitude</th>
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">POP Switch</th> -->
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">POP Router</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Infrastructure Type</th> -->
        <th style="padding:10px; font-size: 20px; color: white ;">Tower Pole Length</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Activated Date</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Edit</th>
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">Deployment Status</th> -->
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">Update Radio Parameters</th> -->
    </tr>
    

			@foreach($pop as $pops)
        <tr style="background-color: #ebb7e4;" >
            <td>{{$loop->iteration}}</td>
            <td style="padding: 10px; color: black;">{{$pops->POP_name}}</td>
            <td style="padding: 10px; color: black;">{{$pops->site_id}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Trunk_IP}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Base_Cluster_IP}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Longitude}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Latitude}}</td>
            <!-- <td style="padding: 10px; color: black;">{{$pops->POP_switch}}</td> -->
            <!-- <td style="padding: 10px; color: black;">{{$pops->POP_router}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Infrastructure_Type}}</td> -->
            <td style="padding: 10px; color: black;">{{$pops->Tower_Pole_Length}}</td>
            <td style="padding: 10px; color: black;">{{$pops->Activated_Date}}</td>
            <td> <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('edit_pop_view',$pops->id)}}">Edit</a>
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
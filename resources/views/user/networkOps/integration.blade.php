
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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm"  style="background-color: #e2d1e6;>
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
            @if(Route::has('login'))

@auth

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
<!-- Example single danger button -->

<x-app-layout>
</x-app-layout>
@else




<li class="nav-item">
<a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
</li>


<li class="nav-item">
<a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
</li>

@endauth

@endif
</ul>


        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
  
    </nav>
  </header>
<body>
  @if($message = Session::get('success'))


<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

<strong>{{$message}}</strong>

</div>

@endif

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center">Integration Parameters</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">



<form class="main-form" action="{{url('integration_param',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="row mt-5 ">
          

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input disabled type="text" name="name" value="{{$data->clients}}" class="form-control">
           </div>

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input disabled type="text" name="service_plan" value="{{$data->service_plan}}" class="form-control" placeholder="No Service Plan"> 
           </div>

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input disabled type="text" name="service_type" value="{{$data->service_type}}" class="form-control" placeholder=""> 
           </div>

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input disabled type="text" name="Bandwidth" value="{{$data->download_bandwidth}}{{$data->unit}}" class="form-control" placeholder="No Bandwidth"> 
           </div>


          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <label for="date"><strong>VLAN ID</strong></label>
            <input type="number" min="4" max="10000" name="vlan_id" class="form-control" placeholder="VLAN ID">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <label for="date"><strong>IP Address</strong></label>
            <input type="text" name="ip_address" class="form-control" placeholder="IP Address">
          </div>
       

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <label for="date"><strong>Subnet Mask</strong></label>
            <input type="text" name="subnet_mask" class="form-control" placeholder="Subnet Mask">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <label for="date"><strong>Gateway</strong></label>
            <input type="text" name="gateway" class="form-control" placeholder="GATEWAY">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <label for="date"><strong>Profile Name</strong></label>
            <input type="text" name="queue_name" class="form-control" placeholder="Profile Name">
          </div>
          
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <label for="date"><strong>Billing date</strong></label>
            <input type="date" name="date" class="form-control" placeholder="First Billing Date">
          </div>

          <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <select required  name="device_type"class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                    <option value="">---select device type---</option>
                    <option>Switch</option>
                    <option>Router</option>
      </select>
          </div>
       
       
        

        
    <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>

    </div>
</div>
</div>
</form>
</body>

<!-- Script for the buttons on the page and some other functions -->


<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<!-- End of these page functionalities script -->
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

        <script>
            $(function() {
                let commonId = ".datepicker";

                $( commonId ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0,
                });
            });
        </script>


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
              <a href="#"><span class="mai-mail text-primary"></span> syscodescomms.com</a>
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

              @if(Route::has('login'))

              @auth

  <!-- Example single danger button -->
         <li class="nav-item">
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Sales Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('sales_personnel_HR')}}">Sales Metrix</a></li>
                  <!-- <li><a class="dropdown-item" href="{{url('industries_dashboard_hr')}}">My Clients</a></li>-->
                   <li><a class="dropdown-item" href="{{url('industries_dashboard_hr')}}">Industries Dashboard</a></li> 
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Other Info.</a></li>
                </ul>
              </div>
          </li>

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
      </div>
    </nav>
  </header>


      

<div >
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Car Rentals</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$c_rent}} </div>
        </div>
        <a href="{{url('c_rent')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Electronics/Equipments/Sales/Support services</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$elec_ware}}</div>
        </div>
        <a href="{{url('elec_ware')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


 <!-- Earnings (Monthly) Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1" >ENERGY </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$ENERGY}}</div>
        </div>
        <a href="{{url('ENERGY')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-users fa-2x text-gray-300"></i>

        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Engineering</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$Engineering}} </div>
        </div>
        <a href="{{url('Engineering')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Equipment/Manufacturing/Constructions</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$eq_man}} </div>
        </div>
        <a href="{{url('eq_man')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Finance/Accounting</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$fin_acc}} </div>
        </div>
        <a href="{{url('fin_acc')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">FINTECH</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$fintech}} </div>
        </div>
        <a href="{{url('fintech')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1"> FOODS & BEVERAGES</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$fd_bev}} </div>
        </div>
        <a href="{{url('fd_bev')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-ash text-uppercase mb-1">FURNITURE</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$furn}} </div>
        </div>
        <a href="{{url('furn')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-ash text-uppercase mb-1">HOSPITALITY</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$hosp}} </div>
        </div>
        <a href="{{url('hosp')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-ash text-uppercase mb-1">HEALTH</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$health}} </div>
        </div>
        <a href="{{url('health')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-ash text-uppercase mb-1">ICT </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$ICT}} </div>
        </div>
        <a href="{{url('ICT')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1">LAW</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$LAW}} </div>
        </div>
        <a href="{{url('LAW')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Logistics/Transport</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$log_tra}} </div>
        </div>
        <a href="{{url('log_tra')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1">MEDIA/ADVERTISING/PHOTOGRAPHY</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$med_adv}} </div>
        </div>
        <a href="{{url('med_adv')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1">NGO</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$ngo}} </div>
        </div>
        <a href="{{url('ngo')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Oil and Gas</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$oil_gas}} </div>
        </div>
        <a href="{{url('oil_gas')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">SECURITY/CCTV</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$sec_cctv}} </div>
        </div>
        <a href="{{url('sec_cctv')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Travels and Tourism</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$tra_tou}} </div>
        </div>
        <a href="{{url('tra_tou')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Others</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$others}} </div>
        </div>
        <a href="{{url('others')}}" class="btn btn-primary">View
            <span class="mdi mdi-arrow-top-right icon-item"></span>
        </a>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>



</div>

  <!-- .banner-home -->

  <!-- .banner-home -->

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Editorial Team</a></li>
            <li><a href="#">Protection</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>More</h5>
          <ul class="footer-menu">
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Advertise</a></li>
            <!-- <li><a href="#">Join as Doctors</a></li> -->
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Our partner</h5>
          <ul class="footer-menu">
            <!-- <li><a href="#">One-Fitness</a></li>
            <li><a href="#">One-Drugs</a></li>
            <li><a href="#">One-Live</a></li> -->
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">3rd Floor, 19 Toyin Street, Ikeja, Lagos.</p>
          <a href="#" class="footer-link">701-573-7582</a>
          <a href="#" class="footer-link">info@syscodescomms.com</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">Copyright &copy; 2022 <a href="https://macodeid.com/" target="_blank"> Syscodes Communications Limited.</a>. All right reserved</p>
    </div>
  </footer>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
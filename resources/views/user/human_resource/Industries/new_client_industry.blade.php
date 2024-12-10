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

        <!-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form> -->

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
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>


              <!-- Example single danger button -->
              <li class="nav-item">
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Sales Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('sales_personnel_HR')}}">Sales Metrix</a></li>
                  <li><a class="dropdown-item" href="{{url('industries_dashboard_hr')}}">Industries Dashboard</a></li> 
                  <!-- <li><a class="dropdown-item" href="{{url('call_out_view')}}">Call Out Form</a></li>  -->
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Other Info.</a></li>
                </ul>
              </div>
          </li>

              @if(Route::has('login'))

              @auth

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
      </div>
    </nav>
  </header>
  

  <body>
  @if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

  <div class="page-section" style="background-color:#e2e3d5; font-size:20px">
    <div class="container" >
  <div style="text-align:center; " class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
  <h1 class="text-center wow fadeInUp">Change Client's Industry</h1>
</div>

<form class="main-form" action="{{url('new_client_industry_form',$data->id)}}" method="POST" >
    @csrf
    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
         <input disabled type="text" class="form-control"  value="{{$data->clients}}">
    </div>

    <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <input disabled type="text" name="Industries"  value="Industry:{{ old('amount_paid', $data->Industries) }}" id="amount_paid" class="form-control" placeholder="Total amount paid..." required>
    </div>

    <div class="col-12 py-2 wow fadeInRight" data-wow-delay="300ms">
        <input disabled type="text" name="Industries_sub_cat" value="Industries Category:{{ old('date', $data->Industries_sub_cat) }}" class="form-control" placeholder="date of payment..." required>
    </div>



   
      <div id="quote_amount" >
        <form class="main-form" action="{{url('new_client_industry_form')}}" method="POST" enctype="multipart/form-data">

            @csrf
    <div class="col-12 py-2 wow fadeInRight" data-wow-delay="300ms">
        <select onchange="planCheck(this);" name="Industries[]" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
            <option value="">---select Industry---</option>
            <option>Cybercafe</option>
            <option>Government</option>
            <option>Hospital & Medical Research</option>
            <option>Institution</option>
            <option>Military</option>
            <option>Multinational</option>
            <option>NGO</option>
            <option>Others</option>
            <option>Private Business</option>
            <option>Public Libraries</option>
            <option>Public Security Service</option>
            <option>Residential & Individual/</option>
            <option>School & Research </option>
        </select>
          </div>

    <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <select onchange="planCheck(this);" id="service_plan" name="Industries_sub_cat[]"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
            <option>---select sub-category---</option>
            <option>Car Rentals</option>
            <option>Constructions </option>
            <option>Electronics/Warehousing/Sales </option>
            <option>ENERGY </option>
            <option>Engineering </option>
            <option>Equipment/Manufacturing/Constructions </option>
            <option>Equipments/Sales/Support services</option>
            <option>Finance/Accounting </option>
            <option>FINTECH</option>
            <option>FOODS & BEVERAGES </option>
            <option>FURNITURE </option>
            <option>HEALTH/HOSPITALITY</option>
            <option>HOME</option>
            <option>ICT</option>
            <option>IT</option>
            <option>LAW </option>
            <option>Manufacturing </option>
            <option>MEDIA/ADVERTISING</option>
            <option>MEDIA/PHOTOGRAPHY</option>
            <option>NGO/Health </option>
            <option>Oil and Gas </option>
            <option>RELIGION </option>
            <option>SECURITY/CCTV </option>
            <option>Travels and Tourism </option>     
            <option>Warehousing/ Logistics/Transport </option>                    
            <option>Warehousing/Trading </option>    
            <!-- <option></option>                  -->
            </select>
          </div>
       </div>
    </div>


    <div style="margin-left: 700px;margin-top: 70px; ">
        <button type="submit" style="font-size:15px; background-color:#64d921;"  class="btn btn-primary btn-lg">Submit</button>
    </div>
</form>

        </div>
        </div>

        </body>







        
<script type="text/javascript">
  function planCheck(that) {
    if (that.value == "Shared") {
         document.getElementById("Shared").style.display = "block";
         document.getElementById("Dedicated").style.display = "none";
   
    } 
    else if (that.value == "Dedicated") {
         document.getElementById("Dedicated").style.display = "block";
         document.getElementById("Shared").style.display = "none";
    }
    else {
             document.getElementById("Shared").style.display = "none";
             document.getElementById("Dedicated").style.display = "none";

    }
}
</script>
        
<script type="text/javascript">
  function QuoteCheck(that) {
    if (that.value == "Yes") {
      
        document.getElementById("ifQuoteYes").style.display = "block";
    } else {
        document.getElementById("ifQuoteYes").style.display = "none";
        document.getElementById("Shared").style.display = "none";
        document.getElementById("Dedicated").style.display = "none";

    }
}
</script>



<!-- Script for the buttons on the page and some other functions -->


<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<!-- End of these page functionalities script -->
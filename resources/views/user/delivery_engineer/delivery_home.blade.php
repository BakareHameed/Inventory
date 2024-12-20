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
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Link Details
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{url('ready_links')}}">Links Ready for Deployment</a></li>
                  <li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li>
                  <li><a class="dropdown-item" href="{{url('all_base_station')}}">All Base Stations</a></li>
                  <li><a class="dropdown-item" href="{{url('my-field-tickets')}}">My Field Raised</a></li>
                  <li><a class="dropdown-item" href="{{url('all_field_support_tickets')}}">All Tickets</a></li>
                  <li><a class="dropdown-item" href="{{url('engr-assignment-dashboard')}}">Engineer Asssignment Dashboard</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{url('create_new_base_station')}}">Create New Base Station</a></li>
                  <li><a class="dropdown-item" href="{{url('erp_cust_ticket')}}">ERP Client Ticket</a></li>
                  
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Engineers</a>
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
            <li class="nav-item">
                <div class="btn-group" style="background-color: green; color: white;">
                  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Work Order 
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{url('my_assigned_survey')}}">My Surveys</a></li>
                      <li><a class="dropdown-item" href="{{url('my_field_support')}}">My Field Support Ticket</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{url('my_surveys_done')}}">My Completed Surveys</a></li>
                      <li><a class="dropdown-item" href="#"></a></li>
                </ul>
              </div>
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
                      Survey Details
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
                      <li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
                      <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
                      <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                      <li><a class="dropdown-item" href="{{url('erp_cust_ticket')}}">ERP Client Ticket</a></li>
                      <li><a class="dropdown-item" href="{{url('engr-assignment-dashboard')}}">Engineer Asssignment Dashboard</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{url('all_field_support_tickets')}}">All Tickets</a></li>
                      <li><a class="dropdown-item" href="{{url('create_field_support_form')}}">Raise Field Support Ticket</a></li>
                      <li>
                        <a href="{{url('raise-job-order')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Raise Job Order</a>
                      </li>
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


            @if(session()->has ('message'))


    <div class="alert alert-success">

      <button type="button" class="close" data-dismiss="alert">
        x
      </button>

    {{session()->get('message')}}

  </div>

  @endif


  <div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/sys.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">A Reliable Network Connection Makes A</span>
        <h1 class="display-4">Happy Customer</h1>
        <a href="#" class="btn btn-primary">Let's Connect</a>
      </div>
    </div>
  </div>


  <div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
              </div>
              <p><span>Chat</span> with a marketing personnel</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-primary text-white">
                <span class="mai-shield-checkmark"></span>
              </div>
              <p><span>Site</span>-Engineers</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-accent text-white">
                <span class="mai-basket"></span>
              </div>
              <p><span>Service</span>-Suport Desk</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->



    <div class="page-section pb-0 $blue-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1>IT Infrastructure and Information Security.</h1>
            <p class="text-grey mb-4">Our Broadband services covers Internet Service Positioning, Virtual Private Network and Communication Systems Integration namely microwave wireless systems, optic fiber installation and provision of last mile connectivity.</p>
            <a href="about.html" class="btn btn-primary">Learn More</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="../assets/img/net6.jpg" style="height: 28rem; width: 80rem" alt="">
            </div>
          </div>
        </div>
      </div>
    <!-- </div> .bg-light -->
  </div> <!-- .bg-light -->

 @include('user.doctor')

 
@include ('user.latest') 


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
            <li><a href="#">Join as Doctors</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Our partner</h5>
          <ul class="footer-menu">
            <li><a href="#">One-Fitness</a></li>
            <li><a href="#">One-Drugs</a></li>
            <li><a href="#">One-Live</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">351 Willow Street Franklin, MA 02038</p>
          <a href="#" class="footer-link">701-573-7582</a>
          <a href="#" class="footer-link">healthcare@temporary.net</a>

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


</body> 

      <hr>

      <p id="copyright">Copyright &copy; 2020 <a href="https://macodeid.com/" target="_blank">MACode ID</a>. All right reserved</p>
    </div>
  </footer>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>





<script>
    function Checkroad() {
        let select = document.getElementById('service_type[]');
        let road = document.getElementById('dedicated');
        if((select.value === "fibre") || (select.value === "wireless"))
            road.style.display='block';
        else  
            road.style.display='none';
     }
</script>




   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
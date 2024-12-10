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

            <!-- <li class="nav-item">
                <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Survey Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
                  <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#"></a></li>
                </ul>
              </div>
          </li> -->

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
<body>
  <center>
  <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Comprehensive Survey Report
        </h2>
</div>
</center>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                        <div class="text-xl">
                            Comprehensive Survey Report for <span class="text-yellow-600">{{ $appointment->clients }}, with ID:
                              
                            @if($appointment->customer_id == null)
                            {{ $appointment->id }}
                            
                            @else
                            {{$appointment->customer_id}}

                            @endif
                            </span>

                            
                            located at 
                            <span class="text-yellow-600">{{ $appointment->address }}</span> carried out by Engineer 
                            
                            <span class="text-blue-600">{{$appointment->engr_name }}</span>
                          
                        </div>

                        
                            <div class="mt-8">
                                <div class="grid grid-cols-3 gap-8">

                              

                                @if ($appointment->engr_name !== null && $appointment->latitude !== null  )
                                
                                    <div>
                                        <div class="font-bold">Feasibility</div>
                                        <div class="pt-3">Feasible</div>
                                    </div>
                            </div>
   

                                <div class="mt-8">
                                    <div class="font-bold">Additional Info:</div>
                                    <div class="pt-3">{{ $appointment->additional_info }}</div>
                                </div>
                                
                                @elseif ($appointment->engr_name !== null && $appointment->latitude == null  )

                                <div>
                                        <div class="font-bold">Feasibility</div>
                                        <div class="pt-3">Not feasible</div>
                                    </div>
                            </div>
   

                                <div class="mt-8">
                                    <div class="font-bold">Reason:</div>
                                    <div class="pt-3">{{ $appointment->additional_info }}</div>
                                </div>
                                @else

                                <div class="mt-8">
                                    <div class="font-bold">This survey is yet to be carried out</div>
                                    <div class="pt-3"></div>
                                </div>

                                @endif

                    </div>

               
                    
            </div>
        </div>


</x-app-layout>

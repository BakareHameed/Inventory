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

      <form action="{{ route('linked.customers.search') }}" method="GET">
        <div class="input-group input-navbar">
          <div class="input-group-prepend">
            <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
          </div>
          <input type="text" name="search" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
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
        
            @if(Route::has('login'))
              @auth
                <li class="nav-item mr-2">
                    <div class="btn-group" style="background-color: green; color: white;">
                      <button type="button" class="btn btn-danger dropdown-toggle mr-2" data-bs-toggle="dropdown" aria-expanded="false">
                          Work Order 
                      </button>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{url('my_assigned_survey')}}">My Surveys</a></li>
                          <li><a class="dropdown-item" href="{{url('my_field_support')}}">My Field Support Ticket</a></li>
                          <li><a class="dropdown-item" href="{{url('my_assigned_installations')}}">My Installations</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="{{url('my_surveys_done')}}">My Completed Surveys</a></li>
                          <li><a class="dropdown-item" href="#"></a></li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="btn-group" >
                    <button type="button" class="btn btn-danger btn-outline-danger mr-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Tickets
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{url('my-field-tickets')}}">My Field Raised</a></li>
                      <li><a class="dropdown-item" href="{{url('all_field_support_tickets')}}">All Tickets</a></li>
                      <li><a class="dropdown-item" href="{{url('engr-assignment-dashboard')}}">Ticket Dashboard</a></li>
                      <li><a class="dropdown-item" href="{{url('raised-job-orders')}}">Job Orders</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{route('all.weekly.expenses')}}">Weekly Expenses</a></li>
                      
                    </ul>
                  </div>
                </li>
                <!-- Example single danger button -->
                <li class="nav-item">
                    <div class="btn-group" style="background-color: greenyellow; color: white;">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Link Details
                      </button>
                      <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{url('ready_links')}}">Links Ready for Deployment</a></li>
                        <li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li>
                        <li><a class="dropdown-item" href="{{url('all_base_station')}}">All Base Stations</a></li>
                        <li><a class="dropdown-item" href="{{url('raised-job-orders')}}">Job Orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('all_base_station')}}">Create New Base Station</a></li>
                        <li><a class="dropdown-item" href="{{url('all-pop-surveys')}}">All Base Stations Surveys</a></li>
                        
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
@include('sweetalert::alert')

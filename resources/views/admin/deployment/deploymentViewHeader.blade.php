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

        <form action="{{url('erp_cust_ticket_search')}}">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <button type=submit class="mai-search  input-group-text">
              <!-- <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span> -->
              </button>
            </div>
            <input type="search" name="erp_customers_search" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
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
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{url('monthly_survey_report')}}">Monthly Survey Report</a></li>
                      <li><a class="dropdown-item" href="{{url('monthly_installation')}}">Monthly Installation</a></li>
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
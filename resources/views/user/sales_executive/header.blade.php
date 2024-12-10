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

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
           <a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('my_call_out')}}">My Call-out</a>
            
            @if (Auth::user()->role === "Sales Executive")
              <li class="nav-item">
                <a class="nav-link" href="my_sales_team">Sales Agent</a>
              </li>

            @elseif(Auth::user()->role === "Sales Account Manager")
              <!-- For Showing Active And Inactive Clients -->
              <li class="nav-item nav-settings d-none d-lg-block">
                <div class="dropdown">
                  <button class="btn btn-outline-info dropdown-toggle"  type="button" style ="font-size:15px" data-toggle="dropdown">
                    Subscription
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                      <a class="test" href="#">SME Clients<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('Active_sme')}}">Active SME Clients</a></li>
                        <li><a class="dropdown-item"  href="{{url('Inactive_sme')}}">Inactive SME Clients</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Home Clients<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  href="{{url('active_Home_clients')}}">Active Clients</a></li>
                        <li><a class="dropdown-item" href="{{url('inactive_Home_clients')}}">Inactive Client</a></li>
                      </ul>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    
                    <li class="dropdown-submenu">
                      <a class="dropdown-submenu" href="{{url('clients-subscription-status')}}">Client's Status</a> 
                    </li>
                    </ul>
                  </ul>
                </div>
              </li> 
            @endif 
            
            @if(Route::has('login'))
                @auth
                  <!-- Example single danger button -->
                  <li class="nav-item">
                      <div class="btn-group" style="background-color: greenyellow; color: white;">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Survey Details
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item"  href="{{url('my_survey')}}">My Created Survey</a></li>
                          <li><a class="dropdown-item" href="{{url('my_clients')}}">My Clients</a></li>
                          <li><a class="dropdown-item" href="{{url('call_out_view')}}">Call Out Form</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="pending_business_page">Pending Business</a></li>
                          <li><a class="dropdown-item" href="{{url('marketer_clients_per_POP')}}">Client Per POP</a></li>
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
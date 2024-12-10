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
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Comms.</a>
        <form action="{{url('search')}}" method="GET" class="d-flex">
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
            <!--Beginning of of Multi-Level Navbar -->
            <li class="nav-item nav-settings d-none d-lg-block">
                <div class="dropdown">
                    <button class="btn btn-outline-info dropdown-toggle"  type="button" style ="font-size:15px" data-toggle="dropdown">
                         Subscription<span class="caret"></span>
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
                            <a class="test" href="#">Dedicated<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"  href="{{url('active_Dedicated_clients')}}">Active Clients</a></li>
                                <li><a class="dropdown-item" href="{{url('inactive_Dedicated_clients')}}">Inactive Client</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test" href="#">Home Clients<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                 <li><a class="dropdown-item"  href="{{url('active_Home_clients')}}">Active Clients</a></li>
                                    <li><a class="dropdown-item" href="{{url('inactive_Home_clients')}}">Inactive Client</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
            <!--End of Multi-Level Navbar -->

            <li class="nav-item">
                <div class="btn-group" style="color: black; font-size:15px">
                    <button type="button" class="btn btn-outline-secondary  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Client Details
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  href="{{url('pending_client')}}">Pending Client</a></li>
                        <li><a class="dropdown-item" href="{{url('new_sales')}}">New Sales</a></li>
                        <li><a class="dropdown-item" href="{{url('all_clients')}}">All Clients Information</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/">About Finance Team</a></li>
                    </ul>
                </div>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
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
            <x-app-layout> 
            </x-app-layout> 
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
</header>
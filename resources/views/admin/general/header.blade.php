<header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> (+234) 8068815379</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> support@syscodescomms.com</a>
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
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
            {{-- Beginning of Multi-Level dropdown  --}}
            <li class="nav-item nav-settings d-none d-lg-block">
              <div class="dropdown">
                  <button class="btn btn-outline-info dropdown-toggle"  type="button" style ="font-size:15px" data-toggle="dropdown">
                      Departments
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a class="test" href="#">Sales Report<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{url('industries_dashboard_hr')}}">Industries Dashboard</a></li> 
                          <li><a class="dropdown-item" href="{{url('pending_business_view')}}">Pending Business</a></li>
                          <li><a class="dropdown-item" href="{{url('sales_personnel_HR')}}">Sales Metrics</a></li> 
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Survey<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
                        <li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
                        <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
                        <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Finance Details<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  href="{{url('pending_client')}}">Pending Client</a></li>
                        <li><a class="dropdown-item" href="{{url('new_sales')}}">New Sales</a></li>
                        <li><a class="dropdown-item" href="{{url('all_clients')}}">All Clients Information</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Network Ops.<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('ready_integration')}}">Ready Integration</a></li>
                            <li><a class="dropdown-item"  href="{{url('integrated_customers')}}">All Integrated Customers</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Service<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('ready_links')}}">Links Ready for Deployment</a></li>
                        <li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li>
                        <li><a class="dropdown-item" href="{{url('all_base_station')}}">All Base Stations</a></li>
                      </ul>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Job Orders<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('admin.allJO')}}">All</a></li>
                        <li><a class="dropdown-item" href="{{url('admin-pending-job-orders')}}">Pending</a></li>
                        <li><a class="dropdown-item" href="#">Approved</a></li>
                      </ul>
                    </li>
                  </ul>
              </div>
            </li>
            {{-- End of Multi-Level dropdown  --}}
            <li class="nav-item">
                <a class="btn btn-outline btn-outline-warning" style="color: black" href="{{ route('admin.dashbaord') }}"><b>Dashboard</b></a>
            </li>
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
                        <li><a class="dropdown-item" href="{{url('clients-subscription-status')}}">Client's Status</a></li>
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
                    </ul>
                </div>
            </li>
            <x-app-layout> 
            </x-app-layout>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
</header>
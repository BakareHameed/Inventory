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

      
      @if(Request::url() === 'http://10.0.0.253:8000/erp_cust_ticket' || Request::url() === 'http://10.0.0.253:8000/erp_cust_ticket_search')
        <form action="{{url('erp_cust_ticket_search')}}">
      @elseif(Request::url() === 'http://10.0.0.253:8000/all_field_support_tickets' || Request::url() === 'http://10.0.0.253:8000/all-field-ticket-search')
        <form action="{{url('all-field-ticket-search')}}">
      @elseif(Request::url() === 'http://10.0.0.253:8000/my-field-tickets' || Request::url() === 'http://10.0.0.253:8000/my-field-ticket-search')
          <form action="{{url('my-field-ticket-search')}}">
      @elseif(Route::is('my.dailyHandover.query') || Route::Is('all.dailyHandover.query') || Route::Is('all.daily.handover.search'))
        <form action="{{route('all.daily.handover.search')}}">
      @else
        <form action="{{url('find_customers_search')}}">
      @endif
        <div class="input-group input-navbar">
          <div class="input-group-prepend">
            <button type=submit class="mai-search  input-group-text">
            <!-- <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span> -->
            </button>
          </div>
          
          <input type="search" name="search" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
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
                  <div class="btn-group" style="background-color: green; color: white;">
                  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Work Order 
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{url('my_field_support')}}">My Field Support Ticket</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#"></a></li>
                  </ul>
              </div>
            </li>
            @if(Route::has('login'))
            @auth
            @if(Auth::user()->role == 'Admin Manager' || Auth::user()->role == 'I Operation')
              <li class="nav-item ml-2 mr-2">
                <a  href="{{ url('add-new-client') }}">       
                    <button type="button" class="btn btn-outline-secondary">Add Customer</button>
                </a>
              </li>
            @endif
            <!-- Example single danger button -->
            <li class="nav-item">
              <div class="btn-group" style="background-color: green; color: white;">
              <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <strong> Support</strong> 
              </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                  <li><a class="dropdown-item" href="{{url('my-field-tickets')}}">My Raised Ticket</a></li>
                  <li><a class="dropdown-item" href="{{url('erp_cust_ticket')}}">ERP Client Ticket</a></li>
                  <li><a class="dropdown-item" href="{{url('engr-assignment-dashboard')}}">Ticket Dashboard</a></li>
                  <li><a class="dropdown-item" href="{{url('clients-subscription-status')}}">Client's Status</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#"></a></li>
                  <!-- <li><a class="dropdown-item" href="{{url('create_field_support_form')}}">Raise Field Support Ticket</a></li> -->
                  <li><a class="dropdown-item" href="{{url('raise-pop-ticket')}}">Raise Ticket For POP</a></li>
                  <li><a class="dropdown-item" href="{{url('all_field_support_tickets')}}">All Tickets</a></li>
                  
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

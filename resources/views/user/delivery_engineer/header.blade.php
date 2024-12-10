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

        <form action="{{url('all_survey_report_search')}}" method="GET" class="d-flex">
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
            <li class="nav-item">
                <div class="btn-group" style="background-color: green; color: white;">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                       Handover
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url('all-client-technical-handover')}}">All</a></li>
                        <li><a class="dropdown-item" href="#">Pending</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <!-- <li><a class="dropdown-item" href="{{url('my_surveys_done')}}">My Completed Surveys</a></li> -->
                        <li><a class="dropdown-item" href="#"></a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Engineers</a>
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


          <div class="btn-group" style="background-color: greenyellow; color: white;">
              <button id="multiLevelDropdownButton" data-dropdown-toggle="dropdown"   class="text-red bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-blue focus:ring-blue-300 font-large rounded-lg text-xl px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Survey Details <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
              <!-- Dropdown menu -->
              <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700" style="background-color: greenyellow; color: black;">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
                      <li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
                      <li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
                      <li><a class="dropdown-item" href="{{url('monthly_survey_report')}}">Monthly Survey Report</a></li>
                      <li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
                      <li><a class="dropdown-item" href="{{url('engr-assignment-dashboard')}}">Engineer Asssignment Dashboard</a></li>
                      <li><hr class="dropdown-divider"></li>
                    <li>
                      <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Job Order<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                      <div id="doubleDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton">
                            <li>
                              <a href="{{url('raise-job-order')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Raise Job Order</a>
                            </li>
                            <li>
                              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My downloads</a>
                            </li>
                            <li>
                              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Billing</a>
                            </li>
                            <li>
                              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rewards</a>
                            </li>
                          </ul>
                      </div>
                    </li>
                  </ul>
              </div>
          </div>
            <x-app-layout> 
            </x-app-layout>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
    <!-- Tailwind required Script for Multilevel dropdown -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <!-- End of Tailwind script -->
</header>
@include('sweetalert::alert')

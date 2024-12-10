<div class="container-fluid page-body-wrapper" >
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row" >
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center" > 
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="admin/assets/images/logo-mini.svg" alt="logo" />
            </a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
             <a  href="{{url('delivery_table')}}">
             <button type="button" class="btn btn-outline-warning">Pending Survey</button>
           </a>
            </li>
            <li class="nav-item w-100">
              <a href="{{url('assigned_survey')}}">
              <button type="button" class="btn btn-outline-info">Assigned Client Survey </button>
              </a>
            </li>
            <li class="nav-item w-100"> 
              <a  href="{{url('all_survey_report')}}">       
                <button type="button" class="btn btn-outline-secondary">All Survey Report</button>
              </a>
              

      
            </li>
            <li class="nav-item w-100">
              <a href="{{url('monthly_installation')}}">
              <button type="button" class="btn btn-outline-primary">Monthly Installation</button>
            </a>
            </li>
  
            <li class="nav-item w-100">
              <a href="{{url('monthly_survey_report')}}">
              <button type="button" class="btn btn-outline-danger">Monthly Survey Report</button>
            </a>
            </li>
            
            </ul>

            
           
              <x-app-layout>

              </x-app-layout>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>

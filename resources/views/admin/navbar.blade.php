<div class="container-fluid page-body-wrapper" >
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color:#99aab0">
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
        <li class="dropdown-submenu mx-1 ml-3 d-xl-block pt-2 pb-2 pl-3 pr-3">
            <a class="test  dropdown-toggle btn btn-outline-danger" href="#" ><strong style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size:2 rem"> IT <span class="caret">Personnel</span></strong></a>
            <ul class="dropdown-menu ">
              <li><a class="dropdown-item" href="{{url('IT-update-client-payment-status')}}">Payment Update</a></li> 
              <li><a class="dropdown-item" href="{{url('clients_monthly_dashboard')}}">Monthly New Clients</a></li> 
              <li><a class="dropdown-item" href="{{url('clients-monthly-subscription-dashboard')}}">Monthly Subscription</a></li> 
            </ul>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-settings d-none d-lg-block">
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Other Info.
            <span class="caret"></span></button>
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
        <li class="nav-item nav-settings d-none d-lg-block">
          <a class="nav-link" href="{{url('/')}}">
            <i class="mdi mdi-view-grid"></i>
          </a>
        </li>
        <li class="nav-item dropdown border-left">
          <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-email"></i>
            <span class="count bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            <h6 class="p-3 mb-0">Messages</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                <p class="text-muted mb-0"> 1 Minutes ago </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                <p class="text-muted mb-0"> 15 Minutes ago </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                <p class="text-muted mb-0"> 18 Minutes ago </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <p class="p-3 mb-0 text-center">4 new messages</p>
          </div>
        </li>
        <li class="nav-item dropdown border-left">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell"></i>
            <span class="count bg-danger"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <h6 class="p-3 mb-0">Notifications</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Event today</p>
                <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Settings</p>
                <p class="text-muted ellipsis mb-0"> Update dashboard </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-link-variant text-warning"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Launch Admin</p>
                <p class="text-muted ellipsis mb-0"> New admin wow! </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <p class="p-3 mb-0 text-center">See all notifications</p>
          </div>
        </li>
        <x-app-layout>
        </x-app-layout>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>

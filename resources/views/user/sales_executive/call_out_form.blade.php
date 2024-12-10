
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
              <a href="#"><span class="mai-call text-primary"></span>(+234) 9136299695</a>
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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm"  style="background-color: #e3f2fd;">
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

            <li class="nav-item">
            <div class="pt-3"> <a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('my_call_out')}}">My Call-out</a></div>
            
            </li>

            <!-- <li class="nav-item">
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Survey Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('my_survey')}}">My Created Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('my_clients')}}">My Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('call_out_view')}}">Call Out Form</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Other Info.</a></li>
                </ul>
              </div>
          </li> -->

      <x-app-layout>
      </x-app-layout>

        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="container mt-3">
    <div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md- mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. of Call-Outs (This Month)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$call_outs}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Quotes Sent (This Month)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$quotes}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. of Sales (This Month)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$sales}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1" > Total No. of Surveys (This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$surveys}}</div>
                <a href="{{url('my_survey')}}" class="btn btn-primary">View</a>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Amount Of Sales (This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($sales_amount)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Amount Of Quotes (This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($quote_amount)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Total MRC(This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($MRC)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total OTC(This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($OTC)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Total MRC for Sales (This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($MRC_sales)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total OTC for Sales(This Month) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦{{number_format($OTC_sales)}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{$message}}</strong>
    </div>
  @endif
    <div align="Center" style="padding:0px">
      <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center; font-size: 30px">Call Out Form</h1>
      </div>
    </div>
    <div class="container" align="Center" style="padding-left:30px;padding-bottom:30px">
      <form class="main-form" action="{{url('call_out_form')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
              <input type="text" name="company_name" class="form-control rounded-md shadow-sm border-gray-300" placeholder="Company Name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
              <input type="text" name="contact_name" class="form-control rounded-md shadow-sm border-gray-300" placeholder="Contact Name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
              <input  type="text" name="contact_number"  class="form-control rounded-md shadow-sm border-gray-300" Placeholder=" Contact Number"> 
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" >
            <input type="date" name="date" class="form-control rounded-md shadow-sm border-gray-300" required>
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="location" class="form-control rounded-md shadow-sm border-gray-300" placeholder="Location">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="address" class="form-control rounded-md shadow-sm border-gray-300" placeholder="Address">
          </div>
          @if( Auth::user()->role == "Admin Manager")
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
              <select  name="account_owner" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" onchange="Checkroad()">
                <option selected disabled>---select Account Owner---</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          @endif

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" >
            <select required onchange="QuoteCheck(this);" id="quote" name="quote"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
              <option value="">--- Any Quote?---</option>
              <option>Yes</option>
              <option>No</option>
            </select>
          </div>
          <div id="ifQuoteYes" style="display: none;">
              <div id="quote_amount" >
                  <label>Quote Amount(₦): </label><input type="number" name="quote_amount" class="rounded-md shadow-sm border-gray-300">
              </div>
          </div>
          <div id="MTCYes" style="display: none;">
            <div>
              <span style="margin-left:15px;margin-right:0px">
                <label>Quote_MRC(₦):<input type="number" name="MRC" class="rounded-md shadow-sm border-gray-300"> </label>
              </span>
              <span style="margin-left:20px">
                <label>Quote_OTC(₦):<input type="number" name="OTC" class="rounded-md shadow-sm border-gray-300"> </label>
              </span>
            </div>
          </div>
      
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" >
            <select required onchange="yesnoCheck(this);" id="sales" name="sales" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
              <option value="">--- Any Sale?---</option>
              <option  value="Yes">Yes</option>
              <option  value= "No">No</option>
            </select>
          </div>
          <div id="ifYes" style="display: none;">
            <div id="sales_amount"  style="margin-bottom:5px;margin-left:5px">
              <label>Sales Amount(₦): </label><input type="number" name="sales_amount" class="rounded-md shadow-sm border-gray-300">
            </div>
          </div>
          <div id="MTC_sales_Yes" style="display: none;">
            <div>
              <span style="margin-left:20px">
                <label>Sales_MRC(₦):<input type="number" name="MRC_sales" class="rounded-md shadow-sm border-gray-300"> </label>
              </span>
              <span style="margin-left:40px">
                <label>Sales_OTC(₦):<input type="number" name="OTC_sales" class="rounded-md shadow-sm border-gray-300"> </label>
              </span>
            </div>
          </div>
          <div id="Service" style="display: none;" class="col-12 py-2 wow fadeInUp form-group" data-wow-delay="300ms" >
            <select onchange="planCheck(this);" id="service_plan" name="service_plan[]"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
              <option value="">---Service Plan---</option>
              <option>Shared</option>
              <option>Dedicated</option>
            </select>
          </div>
        </div>
        <div id ="Shared" style="display: none;" class="form-group" >
          <select name="service_type[]" id="service_type[]"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
            multiple>
            <option id="service_type[]" name="service_type[]" >Home Frenzie</option>
            <option id="service_type[]" name="service_type[]" >Home Delight</option>
            <option id="service_type[]" name="service_type[]" >Home Delight Plus</option>
            <option id="service_type[]" name="service_type[]" >Home Extreme</option>
            <option id="service_type[]" name="service_type[]" >SME Lite</option>
            <option id="service_type[]" name="service_type[]" >SME Extra</option>
            <option id="service_type[]" name="service_type[]" >SME Gold</option>
            <option id="service_type[]" name="service_type[]" >SME Diamond</option>
            <option id="service_type[]" name="service_type[]" >SME Platinum</option>
          </select>
        </div>
        <div id ="Dedicated" style="display: none;" class="form-group" >
          <select name="service_type[]" id="service_type[]"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
            multiple>
            <option  name="service_type[]" value="LAN">LAN</option>
            <option id="txtBandwidth" name="service_type[]" value="wireless">Wireless</option>
            <option id="fibre" name="service_type[]" value="fibre">Fibre</option>
            <option name="service_type[]" value="Power">Power</option>
          </select>
        </div>
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <textarea name="comment" id="comment" class="form-control rounded-md shadow-sm border-gray-300" rows="6" placeholder="Any comment?"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>
      </form>
    </div>
</body>

<script type="text/javascript">
  function yesnoCheck(that) {
    if (that.value == "Yes") {
        document.getElementById("ifYes").style.display = "block";
        document.getElementById("MTC_sales_Yes").style.display = "block";
        document.getElementById("Service").style.display = "block";
    } else {
        document.getElementById("ifYes").style.display = "none";
        document.getElementById("MTC_sales_Yes").style.display = "none";
        document.getElementById("Service").style.display = "none";
    }
  }
</script>
<script type="text/javascript">
  function QuoteCheck(that) {
    if (that.value == "Yes") {
        document.getElementById("ifQuoteYes").style.display = "block";
        document.getElementById("MTCYes").style.display = "block";
    } else {
        document.getElementById("ifQuoteYes").style.display = "none";
        document.getElementById("MTCYes").style.display = "none";
    }
  }
</script>

<script type="text/javascript">
  function planCheck(that) {
    if (that.value == "Shared") {
        document.getElementById("Shared").style.display = "block";
        document.getElementById("Dedicated").style.display = "none";
    } 
    else if (that.value == "Dedicated") {
        document.getElementById("Dedicated").style.display = "block";
        document.getElementById("Shared").style.display = "none";
    }
    else {
        document.getElementById("Shared").style.display = "none";
        document.getElementById("Dedicated").style.display = "none";
    }
  }
</script>
        

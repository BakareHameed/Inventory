
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


        <script>
            $(function() {
                let commonId = ".datepicker";

                $( commonId ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0,
                });
            });
        </script>


<script type="text/javascript">
 window.onload = function() {
    document.getElementById('ifYes').style.display = 'none';
    document.getElementById('ifNo').style.display = 'none';
}
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
        document.getElementById('ifNo').style.display = 'none';
   
    } 
    else if(document.getElementById('noCheck').checked) {
        document.getElementById('ifNo').style.display = 'block';
        document.getElementById('ifYes').style.display = 'none';
        document.getElementById('redhat1').style.display = 'none';
        document.getElementById('aix1').style.display = 'none';
   }
}
</script>


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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm"  style="background-color: #e3f2fd;>
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

        <!-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control rounded-md shadow-md border-gray-300" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form> -->

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
        <h1 class="text-center" style="text-align:center; font-size: 30px">Edit Call-Out Form</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">



<form class="main-form" action="{{url('call_out_form_edit',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5 ">
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <input type="text" name="company_name" value="{{ old('company_name', $data->company_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Company Name">
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <input type="text" name="contact_name" value="{{ old('contact_name', $data->contact_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Contact Name">
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input  type="text" name="contact_number" value="{{ old('contact_name', $data->company_name) }}"  class="form-control rounded-md shadow-md border-gray-300" Placeholder=" Contact Number"> 
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" >
        <input type="date" name="date" value="{{ old('date', $data->date) }}" class="form-control rounded-md shadow-md border-gray-300" required>
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <input type="text" name="location" value="{{ old('location', $data->location) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Location">
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <input type="text" name="address" value="{{ old('address', $data->address) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Address">
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInRight" >
        <select required onchange="QuoteCheck(this);" id="quote" name="quote" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
          <option value="">--- Any Quote?---</option>
          <option>Yes</option>
          <option>No</option>
        </select>
      </div>
      <div id="ifQuoteYes" style="display: none;">
        <div id="quote_amount" >
            <label>Quote Amount(₦): </label><input type="number" name="quote_amount" class="rounded-md shadow-md border-gray-300">
        </div>
      </div>
      <div id="MTCYes" style="display: none;">
        <div>
          <span style="margin-left:10px">
            <label>MRC(₦):<input type="number" name="MRC" class="rounded-md shadow-md border-gray-300"> </label>
          </span>
          <span style="margin-left:150px">
            <label>OTC(₦):<input type="number" name="OTC" class="rounded-md shadow-md border-gray-300"> </label>
          </span>
        </div>
      </div>
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft" >
        <select required onchange="yesnoCheck(this);" id="sales" name="sales" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
          <option value="">--- Any Sale?---</option>
          <option  value="Yes">Yes</option>
          <option  value= "No">No</option>
        </select>
      </div><br>
      <div id="ifYes" style="display: none;">
        <div id="sales_amount" style="margin-bottom:5px;margin-left:5px">
            <label>Sales Amount(₦): </label><input type="number" name="sales_amount" class="rounded-md shadow-md border-gray-300">
        </div>
      </div>

      <div id="MTC_sales_Yes" style="display: none;">
        <div>
          <span style="margin-left:20px">
            <label>Sales_MRC(₦):<input type="number" name="MRC_sales" class="rounded-md shadow-md border-gray-300"> </label>
          </span>
          <span style="margin-left:40px">
            <label>Sales_OTC(₦):<input type="number" name="OTC_sales" class="rounded-md shadow-md border-gray-300"> </label>
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
      <select  name="service_type[]" id="service_type[]"
        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
        multiple>
        <option  name="service_type[]" value="LAN">LAN</option>
          <option id="txtBandwidth" name="service_type[]" value="wireless">Wireless</option>
          <option id="fibre" name="service_type[]" value="fibre">Fibre</option>
          <option name="service_type[]" value="Power">Power</option>
      </select>
    </div>

    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
      <textarea name="comment" id="comment" value="{{ old('comment', $data->comment) }}" class="form-control rounded-md shadow-md border-gray-300" rows="6" placeholder="Any comment?"></textarea>
    </div>
    <div>
      <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>
    </div>
</form>


</body>


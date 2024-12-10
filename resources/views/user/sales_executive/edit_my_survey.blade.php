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


        <style>
thead {color: green;}
tbody {color: blue;}
tfoot {color: red;}

table, th, td {
  border: 1px solid black;
}
</style>
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

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

        <form  action="{{url('my_survey_search')}}" method="GET" class="d-flex">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <button class="btn btn-outline-success" type="submit"><span class="mai-search"></span> </button>           
            </div>
            <input type="text" class="form-control" name="client" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
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
            <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <x-app-layout> 
              
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


 

<div class="container" align="text-center" style="padding-top: 5px;">
@if($message = Session::get('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
      x
    </button>
  <strong>{{$message}}</strong>
</div>

@endif
    
<div align="Center" style="padding:0px">
    @if(Session::has('message'))
        <div class="col-lg-6 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
    @endif
</div>

<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp" style="font-size:30px;">Edit Survey Details</h1>
      <form class="main-form" action="{{url('edit_survey_form',$survey->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" name="clients" class="form-control" placeholder="Client's Name" value="{{ old('clients', $survey->clients) }}" required>
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" name="contact_person_name" value="{{ old('contact_person_name', $survey->contact_person_name) }}" class="form-control" placeholder="Contact Person's Name" required>
          </div>
   
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="email" name="email" value="{{ old('customer_email', $survey->customer_email) }}" class="form-control" placeholder="Email address.." >
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" >
            <input type="date" name="date" value="{{ old('date', $survey->date) }}" class="form-control" required>
          </div>

          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" name="address" value="{{ old('address', $survey->address) }}" class="form-control" placeholder="Residential address" required>
          </div>
         

          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" name="number" value="{{ old('phone', $survey->phone) }}" class="form-control" placeholder="Number.." required>
          </div>

          <div id="app" class="col-12 py-2 wow fadeInUp" >
               
            <div class="col-12 py-2 wow fadeInUp" >

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 form-group">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div class="text-xl">Service Plan</div>

                    <div class="pt-6 form-group">
                        <label class="inline-flex items-center pr-24">
                            <input
                            type="radio"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="service_plan[]" value="Dedicated"
                            onclick="javascript:yesnoCheck();" 
                            id="yesCheck"
                            name="service_plan"
                            />
                            <span class="ml-2">Dedicated </span>
                        </label>

                        <label class="inline-flex items-center">
                            <input
                            type="radio"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="service_plan[]" value="Shared"
                            onclick="javascript:yesnoCheck();" 
                            id="noCheck"
                            name="service_plan"
                            />
                            <span class="ml-2">Shared</span>
                        </label>
                    </div>


                    <div id="ifYes" style="display:none" class="form-group">
                        <div class="mt-8 mx-auto max-w-4xl">
                          

            <div class="form-group" >
    
    <select id="service_type[]" name="service_type[]"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" onchange="Checkroad()" multiple >

      <option  name="service_type[]" value="LAN">LAN</option>
      <option id="txtBandwidth" name="service_type[]" value="wireless">Wireless</option>
      <option id="fibre" name="service_type[]" value="fibre">Fibre</option>
      <option name="service_type[]" value="Power">Power</option>
      </select>  
                    <br />

                    <div id="dedicated" style="display: none;">
                    <label>Upload: </label><input id="dedicated" type="number" name="upload_bandwidth">
                    <label>Download: </label><input id="dedicated" type="number" name="download_bandwidth">
                    <label>Unit: </label>
                    <select id="dedicated" name="bandwidth_unit"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">---select Unit---</option>
                    <option>Mbps</option>
                    <option>Gbps</option>
                    <!-- <option>Tbps</option>
                    <option></option> -->
                    </select>  

                    </div>
                          </div>
                    </div>
                  </div>

                          <div id="ifNo" style="display:none" class="form-group">
                        <div class="mt-8 mx-auto max-w-4xl">


  <div class="form-group" >
    
    <select
    name="service_type[]" id="service_type[]"
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
      </div>
      </div>

        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" value="{{ old('message', $survey->message) }}" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn" style="background-color:#8cd687">Submit Request</button>
      </form>
    </div>
  </div> <!-- .page-section -->

</div>
</x-app-layout> 


<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/theme.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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

<script>
    function Checkroad() {
        let select = document.getElementById('service_type[]');
        let road = document.getElementById('dedicated');
        if((select.value === "fibre") || (select.value === "wireless"))
            road.style.display='block';
        else  
            road.style.display='none';
     }
</script>
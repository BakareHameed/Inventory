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

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
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
              </x-app-layout>
          
          </ul>


        </div> <!-- .navbar-collapse -->
      </div>
    </nav>
  </header>

  
  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center">Edit POP</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">



<form class="main-form" action="{{url('edit_pop',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="row mt-5 ">
          
 
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input  type="text" name="POP_name" value="{{ old('POP_name', $data->POP_name) }}" class="form-control" placeholder="{{$data->POP_name}}" required>
           </div>

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input type="text" name="site_id" value="{{ old('site_id', $data->site_id) }}"  class="form-control" placeholder="Site ID" required> 
           </div>

           

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="Trunk_IP" value="{{ old('Trunk_IP', $data->Trunk_IP) }}" class="form-control" placeholder="Trunk IP" required>
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
           <input type="text" name="Base_Cluster_IP" value="{{ old('Base_Cluster_IP', $data->Base_Cluster_IP) }}" class="form-control" placeholder="Base/Cluster IP" required> 
           </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" name="POP_router" value="{{ old('POP_router', $data->POP_router) }}" class="form-control" placeholder="POP router" required>
          </div>
       

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="POP_switch" value="{{ old('POP_switch', $data->POP_switch) }}" class="form-control" placeholder="POP switch" required>
          </div>

          <!-- <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <input type="text" name="service_description" class="form-control" placeholder="Service Description">
          </div> -->
       

          <div class="col-12 py-2 wow fadeInRight" data-wow-delay="300ms">
          <input type="text" name="Third_Party_Vendor" value="{{ old('Third_Party_Vendor', $data->POP_switch) }}" class="form-control" placeholder="Third Party Vendor" required>
         
         </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="Longitude" value="{{ old('Longitude', $data->Longitude) }}" class="form-control" placeholder="Longitude" required> 
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="text" name="Latitude" value="{{ old('Latitude', $data->Latitude) }}" class="form-control" placeholder="Latitude" required>
          </div>
         
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="text" name="Inverter_Power" value="{{ old('Inverter_Power', $data->Inverter_Power) }}" class="form-control" placeholder="Inverter Power" required>
          </div>
      
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="text" name="Infrastructure_Type" value="{{ old('Infrastructure_Type', $data->Infrastructure_Type) }}" class="form-control" placeholder="Infrastructure Type" required>
         </div>
         
         
         <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="date" name="Activated_Date" value="{{ old('Activated_Date', $data->Activated_Date) }}" class="form-control" placeholder="Activated Date" required>
        
        </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="text" name="Tower_Pole_Length" value="{{ old('Tower_Pole_Length', $data->Tower_Pole_Length) }}" class="form-control" placeholder="Tower Pole Length" required>
         </div>


    <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>

    </div>
</div>
</div>
</form>
</body>

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

            @if(Route::has('login'))

@auth

<!-- Example single danger button -->

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
        <h1 class="text-center" style="text-align:center">Edit Parameters</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">



<form class="main-form" action="{{url('edit_radio_param',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf

<!-- <input type="hidden" name="id" value="{{$data->id}}"> <br> </br>
    <input disabled type="text" name="service_plan" value="{{$data->service_plan}}"> <br> </br>
    <input disabled type="text" name="service_type" value="{{$data->service_type}}"> <br> </br>
    <input disabled type="text" name="Bandwidth" value="{{$data->Bandwidth}}"> <br> </br> -->


    <div class="row mt-5 ">
          

          <!-- <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input disabled type="text" name="name" value="{{$data->clients}}" class="form-control">
           </div> -->

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input  type="text" name="address" value="{{ old('address', $data->address) }}" class="form-control"> 
           </div>

           

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="access_radio_ip" value="{{ old('access_radio_ip', $data->access_radio_ip) }}" class="form-control" placeholder="Access Radio IP(AP)">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" name="station_radio_ip" value="{{ old('station_radio_ip', $data->station_radio_ip) }}" class="form-control" placeholder="Station Radio IP(SM)">
          </div>
       

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="number" name="port" value="{{ old('port', $data->port) }}" class="form-control" placeholder="Port">
          </div>

          <!-- <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <input type="text" name="service_description" class="form-control" placeholder="Service Description">
          </div> -->
       
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
           <input  type="text" name="vlan_id" value="{{ old('vlan_id', $data->vlan_id) }}" class="form-control" placeholder="vlan_id"> 
           </div>
           
          <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="subnet_mask" value="{{ old('subnet_mask', $data->subnet_mask) }}" class="form-control" placeholder="Subnet Mask">
          </div>

          <div class="col-12 py-2 wow fadeInRight" data-wow-delay="300ms">
         
         <select required name="pop" value="{{ old('pop', $data->pop) }}" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                   <option value="">---select POP---</option>
                  @foreach($pop_name as $pops)
                    <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
                  @endforeach 
              
          </select>

         </div>
      

    <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>

    </div>
</div>
</div>
</form>
</body>
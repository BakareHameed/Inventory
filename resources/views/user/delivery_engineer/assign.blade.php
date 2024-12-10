
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


        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>



  <div class="page-section" style="background-color:#e2e3d5; font-size:20px">
    <div class="container" >
  <div style="text-align:center; " class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
        <h2 class="text-center" style="text-align:center"> Assign Engineer</h2>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px" >



<form class="main-form" action="{{url('update_assigned_engr_form',$data->id)}}" method="POST" >
    @csrf
<!-- <input type="hidden" name="id" value="{{$data->id}}"> <br> </br> -->

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
   <input disabled type="text" name="name" value="{{$data->clients}}" class="form-control"> 
</div>
<div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
    <input disabled type="text" name="address" value="{{$data->address}}" class="form-control"> 
</div>
<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="service_plan" value="{{$data->service_plan}}" class="form-control"> 
</div>

@if ($data->service_plan == 'Shared')

<div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
    <input disabled type="text" name="service_type" value="{{$data->service_type}}" class="form-control"> 
</div>

@else

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="Bandwidth" value="{{$data->download_bandwidth}}" class="form-control"> 
</div>

@endif


@if ($data->third_assigned_engr == null && $data->second_assigned_engr == null && $data->first_assigned_engr == null)
    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms" style="padding: 10px; color: black;">
    <select name="first_assigned_engr" id="first_assigned_engr" class="custom-select form-control">
            <option selected>--Select first assigned Engineer---</option>
          @foreach($users as $user)
            <option value="{{$user->name}}" name="first_assigned_engr" id="first_assigned_engr" >{{$user->name}}</option>
         @endforeach
      </select>
</div>

@elseif ($data->third_assigned_engr == null && $data->second_assigned_engr == null && $data->first_assigned_engr !== null)

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="first_assigned_engr" value="{{$data->first_assigned_engr}}" class="form-control"> 
</div>

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" style="padding: 10px; color: black;">
    <select name="second_assigned_engr" id="second_assigned_engr" class="custom-select form-control">
            <option value=" " selected>--Select second assigned Engineer---</option>
          @foreach($users as $user)
            <option value="{{$user->name}}" name="second_assigned_engr" id="second_assigned_engr" >{{$user->name}}</option>
         @endforeach
      </select>
</div>

@else

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="first_assigned_engr" value="{{$data->first_assigned_engr}}" class="form-control"> 
</div>

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="second_assigned_engr" value="{{$data->second_assigned_engr}}" class="form-control"> 
</div>

<div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms" style="padding: 10px; color: black;">
    <select name="third_assigned_engr" id="third_assigned_engr" class="custom-select form-control">
            <option value=" " selected diabled>--Select third assigned Engineer---</option>
          @foreach($users as $user)
            <option value="{{$user->name}}" name="third_assigned_engr" id="third_assigned_engr" >{{$user->name}}</option>
         @endforeach
      </select>
</div>

@endif
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>



    </div>
</div>
</div>
</form>
</body>
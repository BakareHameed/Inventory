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
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">One</span>-Health</a>

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


      <div align="Center" style="padding:70px">
		

		<table>
			
			<tr style="background-color:black;">
				<th style="padding:10px; font-size: 20px; color: white ;">Client Name</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Survey Request Date</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Message</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>

        <th style="padding:10px; font-size: 20px; color: white ;">Bandwith</th>



        <th style="padding:10px; font-size: 20px; color: white ;">Cancel Request</th>
			</tr>

			@foreach($appoint as $appoints)

			<tr style="background-color: black;" align="center">

				<td style="padding: 10px; color: white;">{{$appoints->name}}</td>
				<td style="padding: 10px; color: white;">{{$appoints->date}}</td>
        <td style="padding: 10px; color: white;">{{$appoints->Message}}</td>
        <td style="padding: 10px; color: white;">{{$appoints->address}}</td>

				<td style="padding: 10px; color: white;">{{$appoints->service_plan}}</td>
				<td style="padding: 10px; color: white;">{{$appoints->service_type}}</td>
        <td style="padding: 10px; color: white;">{{$appoints->Bandwith}}</td>
        

        <td><a class="bt btn-danger" onclick="return confirm('Are you sure that you want to cancel this appointment?')" href="{{url('cancel_appoint',$appoints->id)}}">Delete</a></td>

			</tr>

			@endforeach


		</table>      	





      </div>



      <script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
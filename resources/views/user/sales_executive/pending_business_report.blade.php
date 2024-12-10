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

            <li class="nav-item">
              <div class="btn-group" style="background-color: greenyellow; color: white;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Survey Details
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"  href="{{url('my_survey')}}">My Created Survey</a></li>
                  <li><a class="dropdown-item" href="{{url('my_clients')}}">My Clients</a></li>
                  <li><a class="dropdown-item" href="{{url('call_out_view')}}">Call Out Form</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="pending_business_page">Pending Business</a></li>
                </ul>
              </div>
          </li>
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


 
  <div>
  <div class="col-sm-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:1rem">Get Pending Business Between:</h1>
  </div>
        <form class="main-form" action="{{url('pending_business_report')}}" method="GET" enctype="multipart/form-data">

              @csrf
<div class="row">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" >
            <input type="date" name="dateS" class="form-control" required>
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms" >
            <input type="date" name="dateE" class="form-control" required>
          </div>

          <button class="btn btn-outline-success" type="submit">Get</button>

          </div>
          </form>
     
    </div>


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:30px">
        My Pending Business from  
          {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
         To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
      </h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">

<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Count</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

@if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

      <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
    
		<table border=1>
			
			<tr style="background-color:black;">
				<th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
				<th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Company</th>
        <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Name</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Contact Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Location</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Date</th>

        <th style="padding:5px; font-size: 20px; color: white ;">Quote Amount</th>
        <th style="padding:5px; font-size: 20px; color: white ;">MRC</th>
        <th style="padding:5px; font-size: 20px; color: white ;">OTC</th>

        <th style="padding:5px; font-size: 20px; color: white ;">Remark</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Edit</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Delete</th>
   
        
       


			@foreach($pending_business as $pending_business)

			<tr style="background-color: skyblue;" align="left">

      <td style="padding: 5px; color: black;">{{$loop->iteration}}</td>
				<td style="padding: 3px; color: black;">{{$pending_business->company_name}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->contact_name}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->email}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->contact_number}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->service_plan}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->service_type}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->location}}</td>
 
        <td style="padding: 3px; color: black;">{{$pending_business->address}}</td>
        <td style="padding: 3px; color: black;">{{$pending_business->date}}</td>

        <td style="padding: 3px; color: black;" >₦{{number_format($pending_business->quote_amount)}}</td>
        <td style="padding: 3px; color: black;" >₦{{number_format($pending_business->MRC)}}</td>
        <td style="padding: 3px; color: black;" >₦{{number_format($pending_business->OTC)}}</td>
		
        <td style="padding: 3px; color: black;" >{{$pending_business->remark}}</td>
   
        <td style="padding: 3px; color: black;" >
           <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary" href="{{url('pending_business_edit_view',$pending_business->id)}}">Edit</a><span>
       </td>
       <td style="padding: 3px; color: black;" >
           <form method="POST" action="{{ url('delete_pending_business',$pending_business->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button style="background-color:red"  type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
            </form>
          <!-- <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-danger" href="{{ url('delete_pending_business',$pending_business->id) }}">Delete</a><span> -->
        </td>
			@endforeach


		</table>      	
    




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


<!-- Script for laravel sweet alert when deleting record -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
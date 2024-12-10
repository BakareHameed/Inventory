<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Syscodes Network Services</title>
  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

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
 
<div>
    <div class="col-sm-12 py-3 wow fadeInUp text-center">
        <h1 class="text-center" style="text-align:center;font-size:1.5rem">Get survey Between:</h1>
        <form class="main-form" action="{{url('survey_report')}}" method="GET" enctype="multipart/form-data">
          @csrf
            <div class="container">
              <div class="row" align="center">
                  <div class="form-group name1 col-md-6">
                      <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                      <input style="background-color:white;color:black" type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                  </div>

                  <div class="form-group name2 col-md-6">
                      <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                      <input style="background-color:white;color:black"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                  </div>
              </div>  
            <button class="btn btn-outline-success" type="submit">Get</button>
          </div>
        </form>
    </div>
</div>

<div class="row col-md-12 py-3 wow fadeInUp text-center" style = "align-content: center;cell-spacing:0;">
  <div class="form-group col-md-6">
    <!-- Modal for non-feasible Surveys -->
    <button type="button" class="btn btn-primary" style="background-color:#a67649;"  data-toggle="modal" data-target=".non-feasible">Non Feasible Survey</button>
    @include('user.sales_executive.feasibility.non-feasible')
  </div>

  <div class="form-group name1 col-md-6">
    <!-- Modal for Feasible Surveys-->
    <button type="button" class="btn btn-primary" style="background-color:blue;"  data-toggle="modal" data-target=".feasible">Feasible But Not Paid</button>
    @include('user.sales_executive.feasibility.feasible')
  </div>
</div>

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:20px">
        My Created Survey for  {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}
       </h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">


@if($message = Session::get('success'))

<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">x</button>
<strong>{{$message}}</strong>
</div>

@endif

      <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
    
		<table border="0">
			<tr style="background-color:black;">
        <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
        <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Customer-ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Client</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Contact Person</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Assigned Engr.</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Feasibility</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
        {{-- <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th> --}}
        <th style="padding:5px; font-size: 20px; color: white ;">Change Status</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Action</th>
      </tr>

			@foreach($appointments as $appointment)
      <tr style="background-color: skyblue;" align="left">
          <td>{{$loop->iteration}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->id}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->customer_id}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->clients}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->contact_person_name}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->customer_email}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->phone}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->address}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->date}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->service_plan}}</td>
          <td style="padding: 3px; color: black;">{{$appointment->service_type}}</td>
          @if ($appointment->third_assigned_engr !== null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null)
            <td style="padding: 10px; color: black;">{{$appointment->third_assigned_engr}}</td>
          @elseif ($appointment->third_assigned_engr == null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null )
            <td style="padding: 10px; color: black;">{{$appointment->second_assigned_engr}}</td>
          @else
            <td style="padding: 10px; color: black;">{{$appointment->first_assigned_engr}}</td>
          @endif
          @if ($appointment->engr_name !== null && $appointment->latitude !== null  )
            <td style="padding: 10px; color: black;">Feasible
              <a class="btn btn-primary" href="{{url('survey_report',$appointment->id)}}"> survey report</a>
            </td>
          @elseif ($appointment->engr_name !== null && $appointment->latitude == null  )
            <td style="padding: 10px; color: black;">Not feasible
              <a class="btn btn-primary" href="{{url('survey_report',$appointment->id)}}"> survey report</a>
            </td>
          @else
            <td style="padding: 10px; color: black;">NA</td>
          @endif
            <td style="padding: 3px; color: black;" >{{$appointment->status}}</td>
            {{-- <td style="padding: 3px; color: black;" >₦{{number_format($appointment->amount_paid)}}</td> --}}
          @if ($appointment->engr_name == null )
              <td style="padding: 3px; color: black;" >NA because feasibility is unknown</td>
          @else
            <td>
              <a style="padding: 0px;margin-bottom:5px" class="btn btn-secondary" href="{{url('payment_confirmation_paid',$appointment->id)}}">paid</a><span>
              <a style="padding: 0px;margin-bottom:5px" class="btn btn-danger" href="{{url('payment_confirmation_notpaid',$appointment->id)}}">Not paid</a></span>
            </td>
          @endif
            <td style="padding: 5px; color: black;">
              <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{url('edit_my_survey',$appointment->id)}}">Edit</a><span>
              <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#SLA{{$appointment->id}}">SLA</a> 
            </td>
          @endforeach
      </tr>
		</table>      	
  </div>
</x-app-layout> 

    @foreach($appointments as $survey)
      @include('user.sales_executive.salesAgents.SLA')
    @endforeach

    <!-- Generic scripts -->
      <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
      <script src="{{ asset('assets/js/theme.js') }}"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End of generic scripts -->

    <!-- Beginning of required script for Modal -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- End of required script for Modal -->
</body>
</html>
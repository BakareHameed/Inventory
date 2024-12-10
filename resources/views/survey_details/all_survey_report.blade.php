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

  @include('user.delivery_engineer.header')
  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:30px">All Survey Report</h1>
    </div>
  </div>

  <div align="Center" style="padding-left:30px;padding-bottom:30px">
		<table border=1>
			<tr style="background-color:black;">
				<th style="padding:10px; font-size: 20px; color: white ;">ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Client Name</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Contact Person Name</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
        <th style="padding:10px; font-size: 20px; color: white ;"> Assigned Engr</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
        <th style="padding:10px; font-size: 20px; color: white ;">status</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Marketer</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Edit Report</th>
      </tr>

			@foreach($appointments as $appointment)
        <tr style="background-color: white" align="center">
          <td style="padding: 10px; color: black;">{{$appointment->id}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->customer_email}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->date}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
          <td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
          @if($appointment->download_bandwidth == null)
            <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}</td>
          @else
            <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td> 
          @endif
          @if ($appointment->third_assigned_engr !== null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null)
            <td style="padding: 10px; color: black;">{{$appointment->third_assigned_engr}}</td>
          @elseif ($appointment->third_assigned_engr == null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null )
            <td style="padding: 10px; color: black;">{{$appointment->second_assigned_engr}}</td>
          @else
            <td style="padding: 10px; color: black;">{{$appointment->first_assigned_engr}}</td>
          @endif
            <td style="padding: 10px; color: black;">{{$appointment->feasibility}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->status}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->name}}</td>
          @if ($appointment->feasibility == null)
          <td style="padding: 10px; color: black;">Not Available</td>
          @else
          <td><a class="btn btn-primary" href="{{url('delivery_survey_report',$appointment->id)}}">view survey report</a></td>
          <!-- <td><a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('commentview',$appointment->id)}}">comment</a></td> -->
        
          <td><a class="btn btn-outline-info" href="{{url('edit_survey_report_view',$appointment->id)}}">
        
          Edit Report 
          </a></td>
          @endif	
        </tr>
			@endforeach
		</table>  
    <div class="pt-2 pb-2">    	
      {{ $appointments->links('user.customPagination') }}
    </div>
  </div>
      
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <!-- End of Tailwind script -->
  </header>
</body>
</html>
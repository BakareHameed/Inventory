
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
@if($linked)
               
  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center">Searched Results</h1>
    </div>
</div>


      <div align="Center" style="padding:5px;padding-bottom:30px">
    
		<table border=1 align="Center">
			
		<tr style="background-color:black;" >

		<th style="padding:10px; font-size: 20px; color: white ;">Survey ID</th>
    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
    <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
		<th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Service ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Port</th>
        <th style="padding:10px; font-size: 20px; color: white ;">AP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">SM</th>
        <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Edit</th>
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">Deployment Status</th> -->
        <!-- <th style="padding:10px; font-size: 20px; color: white ;">Update Radio Parameters</th> -->
        
        </tr>

			@foreach($linked as $appointment)

		<tr style="background-color: #ebb7e4;" >

        <td style="padding: 10px; color: black;">{{$appointment->survey_id}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
<td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
        <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
		<td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->service_description}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->port}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->access_radio_ip}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->station_radio_ip}}</td>
    <td style="padding: 10px; color: black;">{{$appointment->pop}}</td>
        <!-- <td style="padding: 10px; color: black;">{{$appointment->deployment_status}}</td>   -->
        <td> <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('edit_radio_parameters',$appointment->id)}}">Edit</a>
     </td>  
        
      </tr>
       
			@endforeach


		</table>      	
    


                </tbody>
                </table> 
               
                @endif

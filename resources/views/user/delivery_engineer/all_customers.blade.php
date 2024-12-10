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

@include('user.support.header')

<div>
    <div class="col-sm-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:1.5rem">Filter According to POP</h1>
    </div>
    <form class="main-form" action="{{url('POP_filter')}}" method="GET" enctype="multipart/form-data">
      @csrf
      <select name="pop" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
            <option value="">---select POP---</option>
            <option>Apapa</option>
            <option>Bashorun</option>
            <option>Cocoa House</option>
            <option>Festac</option>
            <option>GRA Ikeja</option>
            <option>Ijaiye</option>
            <option>Ikeja POP</option>
            <option>Ikorodu</option>
            <option>Ligali</option>
            <option>Logemo</option>
            <option>Magodo</option>
            <option>Maryland</option>
            <option>Ojodu</option>
            <option>Opic</option>
            <option>Oshodi</option>
            <option>Oshodi</option>
            <option>Ota</option>
            <option>Surulere</option>
            <option>clients without POP</option>
      </select>
      <button class="btn btn-outline-success" type="submit">Filter</button>
    </form>
</div>



  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center: font-size:70px"><strong>All Customers </strong></h1>
    </div>
</div>


      <div align="Center" style="padding:5px;padding-bottom:30px">
    
		<table border=1 align="Center">
      <tr style="background-color:black;" >
        <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Survey ID</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
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

      @foreach($appointments as $appointment)
        <tr style="background-color: white;" >
            <td>{{$loop->iteration}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->survey_id}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->customer_email}}</td>
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
            <td> 
              <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('edit_customer',$appointment->survey_id)}}">Edit</a>
            </td>  
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
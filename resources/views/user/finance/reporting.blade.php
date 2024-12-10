<!DOCTYPE html>
<html lang="en">
  @include('user.finance.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">Customers from {{$dateS}} to {{$dateE}}</h1>
    </div>
</div>

<div  class="col-lg-6 py-3 wow fadeInUp text-center" style ='align:right'>
        <a class='btn btn-sm btn-primary' href="{{url('customers_export/' . $dateS. '/' . $dateE .'')}}">
            Download Excel
        </a>
    </div>


<div class="container" align="text-center" style="padding-top: 5px;">




      <div align="left" style="padding-right:30px;padding-top:30px">
    
		<table border=1 align='left'>
			
			<tr style="background-color:black;">
				<th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Customer ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
        <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
        <!-- <th style="padding:5px; font-size: 20px; color: white ;">Date</th> -->
				<th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
         <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
         <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th>

        <!-- <th style="padding:5px; font-size: 20px; color: white ;">Payment Status</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th> -->
      
       


			@foreach($customers_report as $report)

			<tr style="background-color: #e8dbca;" align="left">

            <td>{{$loop->iteration}}</td>
            <td style="padding: 5px; color: black;">{{$report->customer_id}}</td>
				<td style="padding: 5px; color: black;">{{$report->clients}}</td>
        <td style="padding: 5px; color: black;">{{$report->contact_person_name}}</td>
        <td style="padding: 5px; color: black;">{{$report->customer_email}}</td>
			
        <td style="padding: 5px; color: black;">{{$report->phone}}</td>
 
        <td style="padding: 5px; color: black;">{{$report->address}}</td>
       
				<td style="padding: 5px; color: black;">{{$report->service_plan}}</td>
				<td style="padding: 5px; color: black;">{{$report->service_type}}</td>
        <td style="padding: 5px; color: black;">{{$report->status}}</td>
       
        <td style="padding: 5px; color: black;">{{$report->created_at}}</td>

        <!-- <td style="padding: 5px; color: black;" >{{$report->status}}</td>
        <td style="padding: 5px; color: black;" >{{$report->amount_paid}}</td> -->

   
			@endforeach


		</table>      	
    

  


      </div>

      <div>
    

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
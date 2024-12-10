<!DOCTYPE html>
<html lang="en">
  @include('user.finance.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')

  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">New Sales</h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">


@if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

      <div align="left" style="padding-left:30px;padding-top:30px">
    
		<table border=1>
			
			<tr style="background-color:black;">
				<th style="padding:5px; font-size: 20px; color: white ;">ID</th>
				<th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
        <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Email</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
				<th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Payment Status</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th>
      
       


			@foreach($appointments as $appointment)

			<tr style="background-color: #e8dbca;" align="left">

            <td style="padding: 5px; color: black;">{{$appointment->id}}</td>
				<td style="padding: 5px; color: black;">{{$appointment->clients}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->customer_email}}</td>
			
        <td style="padding: 5px; color: black;">{{$appointment->phone}}</td>
 
        <td style="padding: 5px; color: black;">{{$appointment->address}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->date}}</td>
				<td style="padding: 5px; color: black;">{{$appointment->service_plan}}</td>
				<td style="padding: 5px; color: black;">{{$appointment->service_type}}</td>
        <td style="padding: 5px; color: black;" >{{$appointment->status}}</td>
        <td style="padding: 5px; color: black;" >₦{{number_format($appointment->amount_paid)}}</td>
<!-- 
        <td><a class="btn btn-danger" href="{{url('cancel_appoint',$appointment->id)}}">Delete</a></td>
         -->
        
       
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
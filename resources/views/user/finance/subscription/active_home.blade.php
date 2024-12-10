<!DOCTYPE html>
<html lang="en">
  @include('user.finance.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')
 
  <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <span>
      
    <h2 style="font-size:20px">Get Active Retail Customers Between:</h2>
    <form class="main-form" action="{{url('active_Home_customers_report')}}" method="GET" enctype="multipart/form-data">

      @csrf
            <div class="container">
            <div class="row">
                <div class="form-group name1 col-md-6">
                    <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                    <input style="background-color:white" type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                </div>

                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                    <input style="background-color:white"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                </div>
            </div>  
            <button class="btn btn-outline-success" type="submit">Get</button>
        </div>   
    
    </form>
  
 </div>


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">All Active Retail Clients</h1>
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



<div >
<div class="row">
<div class="col-xl-3 col-xl-4  mb-4">
 <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. Active Retail Clients(This Month)</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$no_active_home_clients}} </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


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
        <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
        @if(Auth::user()->role=='Finance Officer')
          <th style="padding:5px; font-size: 20px; color: white ;">Monthly Activation/Deactivation Date</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Confirm Payment</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Deactivate</th>
          <!-- <th style="padding:5px; font-size: 20px; color: white ;">Payment Status</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th> -->
        @endif

			@foreach($active_home_clients as $appointment)
        <tr style="background-color: #e8dbca;" align="left">
        <td>{{$loop->iteration}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->id}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->clients}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->contact_person_name}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->customer_email}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->phone}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->address}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->service_plan}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->service_type}}</td>
        <td style="padding: 5px; color: black;">{{$appointment->created_at}}</td>
        @if($appointment->status=='Active')
        <td style="padding: 5px; color: black;  background-color: #8febab">{{$appointment->status}}</td>
        @elseif($appointment->status=='Inactive')
        <td style="padding: 5px; color: black;  background-color: yellow">{{$appointment->status}}</td>
        @else
        <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$appointment->status}}</td>
        @endif
        @if(Auth::user()->role=='Finance Officer')
          <td style="padding: 5px; color: black;">{{$appointment->activation_deactivation_date}}</td>
          <!-- <td style="padding: 5px; color: black;" >{{$appointment->status}}</td>
          <td style="padding: 5px; color: black;" >{{$appointment->amount_paid}}</td> -->
          <td style="padding: 5px; color: black;" >
            <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('activation_payment',$appointment->id)}}">Amount paid</a>
          </td>
          <td style="padding: 5px; color: black;" >
            <a style="padding: 5px;margin-bottom:5px" class="btn btn-warning"href="{{url('customer_deactivation',$appointment->id)}}">Deactivate</a><span>
            <a style="padding: 5px;margin-bottom:5px" class="btn btn-danger" href="{{url('suspend_customer',$appointment->id)}}">Suspend</a><span>
          </td>
        @endif

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
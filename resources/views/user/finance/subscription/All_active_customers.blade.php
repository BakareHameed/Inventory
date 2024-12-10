<!DOCTYPE html>
<html lang="en">
@include('user.finance.head')
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.finance.header')
  
<div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <h2 style="font-size:20px">Get Active Customers Between:</h2>
    <form class="main-form" action="{{url('All_active_customers_reporting')}}" method="GET" enctype="multipart/form-data">
      @csrf
        <div class="container">
            <div class="row">
                <div class="form-group name1 col-md-6">
                    <label for="exampleInputEmail1" class="formText">Sart Date:*</label>
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
        <h1 class="text-center" style="text-align:center;font-size:2rem">All Active Clients</h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">



<div >
    <div class="row">
        <div class="col-sm-3 col-xl-4  mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Active Clients</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}}
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div align="left" style="padding-left:20px;padding-top:30px">
      <table border=1 align='left'>
              <tr style="background-color:black;">
                  <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Customer ID</th>
                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Email</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">POP</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                  @if(Auth::user()->role=='Finance Officer')
                    <th style="padding:5px; font-size: 20px; color: white ;">Monthly Activation/Deactivation Date</th>
                    <th style="padding:5px; font-size: 20px; color: white ;">Confirm Payment</th>
                    <th style="padding:5px; font-size: 20px; color: white ;">Deactivate</th>
                  @endif
              </tr>

            @foreach($total_customers as $active_cust)
              <tr style="background-color: #e8dbca;" align="left">
                  <td>{{$loop->iteration}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->id}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->customer_id}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->clients}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->contact_person_name}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->customer_email}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->phone}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->address}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->service_plan}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->service_type}}</td>
                  <td style="padding: 10px; color: black;">{{$active_cust->pop}}</td>
                  <td style="padding: 5px; color: black;">{{$active_cust->created_at}}</td>
                  @if($active_cust->status=='Active')
                  <td style="padding: 5px; color: black;  background-color: #8febab">{{$active_cust->status}}</td>
                  @elseif($active_cust->status=='Inactive')
                  <td style="padding: 5px; color: black;  background-color: yellow">{{$active_cust->status}}</td>
                  @else
                  <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$active_cust->status}}</td>
                  @endif

                  @if(Auth::user()->role=='Finance Officer')
                    <td style="padding: 5px; color: black;">{{$active_cust->activation_deactivation_date}}</td>
                    <td style="padding: 5px; color: black;" ><span>{{$active_cust->amount_paid}}</span>
                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('activation_payment',$active_cust->id)}}">Amount paid</a>
                    </td>
                    <td style="padding: 5px; color: black;" >
                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-warning"href="{{url('customer_deactivation',$active_cust->id)}}">Deactivate</a><span>
                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-danger" href="{{url('suspend_customer',$active_cust->id)}}">Suspend</a><span>
                    </td>
                  @endif
                  @endforeach
              </tr>
      </table>      	
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
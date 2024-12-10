<!DOCTYPE html>
<html lang="en">
@include('user.finance.head')
<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')

<div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <h2 style="font-size:20px">Get Inactive Corporate Customers Between:</h2>
    <form class="main-form" action="{{url('Inactive_corporate_customers_reporting')}}" method="GET" enctype="multipart/form-data">
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
         <h1 class="text-center" style="text-align:center;font-size:2rem">
            All Inactive Corporate Clients
            From {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
            To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
        </h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">

<div >
    <div class="row">
        <div class="col-xl-3 col-xl-4  mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Inactive Corporate Clients</div>
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


    <div align="left" style="padding-left:20px;padding-top:30px:margin-bottom: 30px;">
      <table border=1 align='left' style="margin-bottom: 50px">
              <tr style="background-color:black;">
                  <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                  <th style="padding:5px; font-size: 20px; color: white ;"> ID</th>
                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                  <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
              </tr>

            @foreach($corporate as $Inactive_cust)
              <tr style="background-color: #e8dbca;" align="left">
                  <td>{{$loop->iteration}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->customer_id}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->clients}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->phone}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->address}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->service_plan}}</td>
                  <td style="padding:  20px; color: black;">{{$Inactive_cust->service_type}}</td>
                  @if($Inactive_cust->status=='Active')
                  <td style="padding:  20px; color: black;  background-color: #8febab">{{$Inactive_cust->status}}</td>
                  @elseif($Inactive_cust->status=='Inactive')
                  <td style="padding:  20px; color: black;  background-color: yellow">{{$Inactive_cust->status}}</td>
                  @else
                  <td style="padding:  20px; color: black;  background-color: #fc6d6d ">{{$Inactive_cust->status}}</td>
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
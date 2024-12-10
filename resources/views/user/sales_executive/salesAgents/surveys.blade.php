<!DOCTYPE html>
<html lang="en">
  @include('user.sales_executive.head')
  <body>
      <!-- Back to top button -->
      <div class="back-to-top"></div>
        @include('user.sales_executive.header')

        <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
            <span>  
                <h2>Get call out:</h2>
                <form class="main-form" action="{{url('SA_surveys_HR_reporting',$id)}}" method="GET" enctype="multipart/form-data">
                  @csrf
                        <div class="container">
                          <div class="row">
                              <div class="form-group name1 col-md-6">
                                  <label for="exampleInputEmail1" class="formText">From:*</label>
                                  <input  type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                              </div>

                              <div class="form-group name2 col-md-6">
                                  <label for="exampleInputEmail1## Heading ##" class="formText">To:*</label>
                                  <input   type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                              </div>
                          </div>  
                        </div>
                        <button class="btn btn-outline-success" type="submit">Get</button>
                    </div>   
                </form>
            </span>
        </div>
    
        <div align="Center" style="padding:0px">
            <div class="col-lg-6 py-3 wow fadeInUp text-center" >
                <h1 class="text-center" style="text-align:center;font-size:30px">
                    <!-- {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}} -->
                    Survey Details for {{$SA}}
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

            <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
                <table border=1>
                    <tr style="background-color:black;">
                        <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Client Name</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                        <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
                    </tr>

                    @foreach($surveys as $appointment)
                        <tr style="background-color:#dec8da;" align="left">
                            <td>{{$loop->iteration}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->created_at}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
                            <td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
                            @if($appointment->download_bandwidth == null)
                            <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}</td>
                            @else
                            <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td> 
                            @endif
                            <td style="padding: 10px; color: black;">{{$appointment->feasibility}}</td>     
                        </tr>
                    @endforeach
                </table>       	
            </div>
          </div>
        </div>
      </diV>
  </body>
</html>


<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
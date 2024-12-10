<!DOCTYPE html>
<html lang="en">
@include('user.finance.head')
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.finance.header')

  <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <span>
    <h2 style="font-size:20px">Get Customers Between:</h2>
    <form class="main-form" action="{{url('customers_report')}}" method="GET" enctype="multipart/form-data">
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
        <h1 class="text-center" style="text-align:center;font-size:2rem">All Clients</h1>
    </div>
  </div>

  <div class="container" style="padding-top: 5px;">
      <div class="row">
          <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> 
                      <a href="" style="text-decoration: none">
                        Total
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{$total_all_clients}} 
                    </div> 
                  </div>
                  <div class="col-auto">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> 
                      <a href="" style="text-decoration: none">
                        Active
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{$active_all_clients}}
                    </div> 
                  </div>
                  <div class="col-auto">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> 
                      <a href="" style="text-decoration: none">
                        Inactive
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{$inactive_all_clients}}
                    </div> 
                  </div>
                  <div class="col-auto">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> 
                      <a href="" style="text-decoration: none">
                        Suspended
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{$suspended_all_clients}}
                    </div> 
                  </div>
                  <div class="col-auto">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div >
        <div style="margin-left:20vw"  class="flex ml-3  items-center justify-content-center bg-gray-900 py-0" >
          <div class="flex mt-0">
              <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                  <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                      <div >
                          <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                              <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;">
                                    <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Email</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                                    {{-- <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th> --}}
                                    <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Avg. Speed</th>
                                    {{-- <th style="padding:5px; font-size: 20px; color: white ;">Bandwidth</th> --}}
                                    {{-- <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th> --}}
                                    <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">POP</th>
                                    {{-- <th style="padding:5px; font-size: 20px; color: white ;">Subscription Date</th> --}}
                                    <th style="padding:5px; font-size: 20px; color: white ;">Action</th>
                                </tr>
                              </thead>
                              @php
                                  $i = ($appointments->currentPage() - 1) * $appointments->perPage();
                              @endphp
                              <tbody>
                                @foreach($appointments as $appointment)
                                  <tr style="background-color: white;" align="left">
                                      <td>{{++$i}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->id}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->clients}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->contact_person_name}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->customer_email}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->phone}}</td>
                                      <td style="padding: 5px; color: black;">{{$appointment->address}}</td>
                                      {{-- <td style="padding: 5px; color: black;">{{$appointment->service_plan}}</td> --}}
                                      <td style="padding: 5px; color: black;">{{$appointment->service_type}}</td>
                                      <td style="padding: 10px; color: black;">{{$appointment->avg_speed}}{{$appointment->unit}}</td>
                                      {{-- <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td> --}}
                                      {{-- <td style="padding: 5px; color: black;">{{$appointment->created_at}}</td> --}}
                                      @if($appointment->status=='Active')
                                          <td style="padding: 5px; color: black;  background-color: #8febab">{{$appointment->status}}</td>
                                      @elseif($appointment->status=='Inactive')
                                          <td style="padding: 5px; color: black;  background-color: yellow">{{$appointment->status}}</td>
                                      @else
                                          <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$appointment->status}}</td>
                                      @endif
                                      <td style="padding: 5px; color: black;">{{$appointment->pop}}</td>
                                      {{-- <td style="padding: 5px; color: black;">{{$appointment->activation_deactivation_date}}</td> --}}
                              
                                      <td style="padding: 5px; color: black;" >
                                          <a style="padding: 10px;margin-bottom:8px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Activate{{$appointment->id}}">Activate</a>
                                          <a style="padding: 3px;margin-bottom:5px" class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#Deactivate{{$appointment->id}}">Deactivate</a>
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Component End  -->
        </div>     	
      </div>
      {{ $appointments->links('user.customPagination') }}
    <div>
  </div>

  @foreach($appointments as $client)
    @include('user.finance.client-sub.deactivate')
  @endforeach

  @foreach($appointments as $client)
    @include('user.finance.client-sub.activate')
  @endforeach

  @include('user.finance.general-scripts')

</body>
</html>

<script>
  // Get today's date
  var today = new Date().toISOString().split('T')[0];
  // Set the value of the date input field to today's date
  document.getElementById("billingDate").value = today;
</script>
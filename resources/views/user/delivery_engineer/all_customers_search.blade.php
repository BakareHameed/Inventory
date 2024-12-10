<!DOCTYPE html>
<html lang="en">
@include('user.support.head')

<body>
    <!-- Back to top button -->
     <div class="back-to-top"></div>
     
    @include('user.support.header')
    @if($linked)
      <div align="Center" style="padding:0px">
          <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:2rem">
              Searched Results
          </h1>
          </div>
      </div>
  
      <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
          <h1 class="text-center" style="text-align:center;font-size:1.0rem">Filter According to POP</h1>
          <form class="main-form" action="{{url('POP_filter')}}" method="GET" enctype="multipart/form-data">
              @csrf
              <select name="pop" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                      <option value="">---select POP---</option>
                      @foreach($pop_name as $pops)
                          <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
                      @endforeach
              </select>
              <button class="btn btn-outline-success mt-2" type="submit">Filter</button>
          </form>
      </div>

      <div class="container pb-3" align="text-center" style="padding-top: 5px;">
          <div class="row ml-3">
              <div class="col-sm-3 col-lg-3 mb-1">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                    <div class="col-auto">
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-3 col-lg-3  mb-1">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Page Count</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$PageCount}} </div>
                                    <div class="col-auto">
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div align="center"  style="margin:15px; margin-left:30px;padding-top:30px">
              @if(Session::has('message'))
                  <div class="alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
              @endif

          <div class="flex flex-col items-center justify-center w-screen bg-gray-900 py-0" style="margin-left:5rem">
          <div class="flex flex-col mt-0">
              <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="shadow overflow-hidden sm:rounded-lg">
                          <table  class="min-w-full text-sm text-gray-400">
                              <thead class="bg-gray-800 text-xs uppercase font-medium">
                                  <tr style="background-color:black;" >
                                      <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
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
                              </thead>
                              <tbody class="bg-gray-800">
                                  @php
                                  $i = ($linked->currentPage() - 1) * $linked->perPage();
                                  @endphp
                                  @foreach($linked as $appointment)
                                      <tr style="background-color: white;" align="left">
                                          <td style="padding: 5px; color: black;"><strong>{{++$i}}</strong></td>
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
                                          <td> 
                                              <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('edit_customer',$appointment->survey_id)}}">Edit</a>
                                          </td>  
                                          {{-- @if(Auth::user()->role == "Admin Manager" || Auth::user()->role == "Service Engineer")
                                                <td>
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Edit{{$appointment->radio_id}}">Edit</a>
                                                </td> 
                                            @endif --}}
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          {{ $linked->links('user.customPagination') }}
          <!-- Component End  -->
      <div>

      @foreach($linked as $client)
      @include('user.delivery_engineer.customers.edit')
      @endforeach
      {{-- @foreach ($linked as $client)
            @include('user.support.customers.subscriptionStatus.service-edit')
      @endforeach --}}
      <!-- Beginning of required script for Modal -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
      <!-- Beginning of required script for Modal -->

    @endif
  </body>
</html>
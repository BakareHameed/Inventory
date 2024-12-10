<!DOCTYPE html>
<html lang="en">
  @include('user.service_engr.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    
    @include('user.service_engr.header')

    <div align="center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">
          Links Ready For Deployment
        </h1>
        </div>
    </div>

      <div class="container pb-3 "  align="center" style="padding:0px">
        <div class="row ml-3">
            <div class="col-sm-3 col-lg-3 mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                        <div class="col-auto">
                                          {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                                        </div>
                                </div>
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
        </div>

        <div  class="flex  items-center justify-center w-screen bg-gray-900 py-0" >
            <div class="flex mt-0">
                <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table  class="min-w-full text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                  <tr style="background-color:black;" align="Center" >
                                    <th style="padding:10px; font-size: 20px; color: white ;">Survey ID</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Update</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                    $i = ($appointments->currentPage() - 1) * $appointments->perPage();
                                    @endphp --}}
                                    @foreach($appointments as $appointment)
                                      <tr style="background-color: white;" align="center">
                                        <td style="padding: 10px; color: black;">{{$appointment->id}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
                                        <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>
                                        <td>
                                          <a style="padding: 5px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Update{{$appointment->id}}">Update</a>
                                        </td>  
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ $appointments->links('user.customPagination') }} --}}
            <!-- Component End  -->
        <div>
      <div>

      @foreach ($appointments as $client)
        @include('user.service_engr.Link.update')
      @endforeach
  </body>
  <!-- Beginning  of required script for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Beginning of required script for Modal -->
</html>



<!DOCTYPE html>
<html lang="en">
  @include('user.support.head')

  <body>
      <!-- Back to top button -->
      <div class="back-to-top"></div>
      
      @include('user.support.header')

      <div align="Center" style="padding:0px">
          <div class="col-lg-6 py-3 wow fadeInUp text-center" >
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                <strong>{{$pop}}</strong> Active Clients from
                {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
                To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
            </h1>
          </div>
      </div>
  
      <div class="container pb-3" align="text-center" style="padding-top: 5px;">
          <div class="row ml-3">
              <div class="col-sm-2 col-sm-2 mb-1 ml-3">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($clients)}}</div>
                                    <div class="col-auto">
                                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-2 col-sm-2  mb-1 ml-3">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Page Count</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$PageCount}} </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-2 col-sm-2  mb-1 ml-3">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Subscribed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$active}} </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-2 col-sm-2  mb-1 ml-3">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Non-Subscribed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$inactive}} </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-2 col-sm-2  mb-1 ml-3">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Terminated</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suspended}} </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

      <div >
          <div class="flex flex-col items-center justify-center w-screen bg-gray-900 py-2" style="margin-left:5rem">
              <div class="flex flex-col mt-0">
                  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="shadow overflow-hidden sm:rounded-lg">
                              <table  class="min-w-full text-sm text-gray-400">
                                  <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;" >
                                      <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
                                    </tr>
                                  </thead>
                                  <tbody class="bg-gray-800">
                                      @php
                                      $i = ($total->currentPage() - 1) * $total->perPage();
                                      @endphp
                                      @foreach($clients as $client)
                                        <tr style="background-color: white;" >
                                          <td>{{$loop->iteration}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->clients}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->contact_person_name}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->phone}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->customer_email}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->service_plan}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->service_type}}</td>
                                          <td style="padding: 10px; color: black;">{{$client->download_bandwidth}}{{$client->unit}}</td>
                                          @if($client->status=='Active')
                                            <td style="padding: 5px; color: black;  background-color: #8febab">{{$client->status}}</td>
                                          @elseif($client->status=='Inactive')
                                            <td style="padding: 5px; color: black;  background-color: yellow">{{$client->status}}</td>
                                          @else
                                            <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$client->status}}</td>
                                          @endif
                                          <td style="padding: 10px; color: black;">{{$client->pop}}</td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          {{ $total->links('user.customPagination') }}
          <!-- Component End  -->
      <div>

      <!-- Beginning of required script for Modal -->
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
      <!-- Beginning of required script for Modal -->

      {{-- Script for Picking the status and POP selectedd to send to historical form --}}
          <script type="text/javascript">
              function statusCheck() {
                      var state = document.forms["SortForm"]["status"].value;
                      console.log(state);
                      $("input[name='status']").val(state); // set gate id in input field  
              }
          </script>
          <script type="text/javascript">
              function popCheck() {
                      var choice = document.forms["SortForm"]["pop"].value;
                      console.log(choice);
                      $("input[name='pop']").val(choice); // set gate id in input field  
              }
          </script>
      {{-- End of Script for Picking the status and POP selectedd to send to historical form --}}
  </body>
</html>
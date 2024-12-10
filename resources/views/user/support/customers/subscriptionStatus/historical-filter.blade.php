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
                All @if($status !== null)<strong> {{$status}} </strong> @endif Clients
                @if($QueriedPOP !== null) in <strong> {{$QueriedPOP}} </strong> @endif
                From {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
                To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
            </h1>
        </div>
    </div>
 
    <form class="main-form" action="{{url('history-client-subscription-status')}}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="container col-xl-12  pl-0 text-center">
            <h2>Get Clients Between:</h2>
            <div class="row flex ">
                <div class="form-group  col-sm-6">
                    <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                    <input required ="background-color:white" type="date" class="form-control" name="dateS"   aria-describedby="emailHelp" name="muverName">
                    <input hidden type="text" class="form-control" name="pop"  aria-describedby="emailHelp">
                </div>

                <div class="form-group col-sm-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                    <input required style="background-color:white"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                    <input hidden type="text" class="form-control" name="status"  aria-describedby="emailHelp">
                </div>
            </div>  
            <button class="btn btn-outline-success" type="submit">Get</button>
        </div>   
    </form> 
    
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
        <form name="SortForm" class="main-form" action="{{url('client-subscription-status-filter')}}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6 mb-0">
                    <h1 class="inv-title-1">Sort by POP</h1>
                    <select onchange="popCheck();" name="pop" class="form-group" >
                            <option value="">--- select POP---</option>
                            @foreach($pop_name as $pops)
                                <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
                            @endforeach
                    </select>
                    <input hidden type="text" class="form-control" name="dateS" value="{{ request()->get('dateS') }}" aria-describedby="emailHelp">
                </div>
                <div class="col-sm-6 text-end mb-10">
                    <h1 class="inv-title-1">Sort by Status</h1>
                    <select onchange="statusCheck();" name="status" class="form-group" >
                        <option value="">---Client Status---</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Suspended</option>
                    </select>
                    <input hidden type="text" class="form-control" name="dateE" value="{{ request()->get('dateE') }}"  aria-describedby="emailHelp">
                </div>
            </div>
            <button class="btn btn-outline-success mt-2" type="submit">Go</button>
         </form>
    </div>

    <div class="container pb-3 " align="text-center" style="padding-top: 5px;">
        <div class="row ">
            <div class="col-sm-3 col-lg-3 mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total {{$status}}</div>
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

    <div class="flex  items-center justify-right w-screen bg-gray-900 py-0" >
        <div class="flex mt-0">
            <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table  class="min-w-full text-sm text-gray-400">
                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;" >
                                    <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                    {{-- <th style="padding:10px; font-size: 20px; color: white ;">ID</th> --}}
                                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                                    {{-- <th style="padding:10px; font-size: 20px; color: white ;">Email</th> --}}
                                    <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr style="background-color: white;" align="left">
                                        {{-- <td style="padding: 5px; color: black;"><strong>{{++$i}}</strong></td> --}}
                                        <td style="padding: 5px; color: blue;"><strong>{{$loop->iteration}}</strong></td>
                                        {{-- <td style="padding: 10px; color: black;">{{$client->survey_id}}</td> --}}
                                        <td style="padding: 10px; color: black;">{{$client->clients}}</td>
                                        <td style="padding: 10px; color: black;">{{$client->contact_person_name}}</td>
                                        <td style="padding: 10px; color: black;">{{$client->phone}}</td>
                                        {{-- <td style="padding: 10px; color: black;">{{$client->customer_email}}</td> --}}
                                        <td style="padding: 10px; color: black;">{{$client->address}}</td>
                                        <td style="padding: 10px; color: black;">{{$client->service_plan}}</td>
                                        <td style="padding: 10px; color: black;">{{$client->service_type}}</td>
                                        <td style="padding: 10px; color: black;">{{$client->avg_speed}}{{$client->unit}}</td>
                                        @if($client->status=='Active')
                                            <td style="padding: 5px; color: black;  background-color: #8febab"><strong>{{$client->status}}</strong></td>
                                        @elseif($client->status=='Inactive')
                                            <td style="padding: 5px; color: black;  background-color: yellow"><strong>{{$client->status}}</strong></td>
                                        @else
                                            <td style="padding: 5px; color: black;  background-color: #fc6d6d "><strong>{{$client->status}}</strong></td>
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
        {{-- {{ $appointments->links('user.customPagination') }} --}}
        <!-- Component End  -->
    <div>
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

  
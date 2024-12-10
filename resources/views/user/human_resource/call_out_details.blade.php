<!DOCTYPE html>
<html lang="en">
  @include('user.human_resource.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.human_resource.header')
 
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <span>  
          <h2>Get call out:</h2>
          <form class="main-form" action="{{url('call_out_reporting_HR',$id)}}" method="GET" enctype="multipart/form-data">
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
                  <button class="btn btn-outline-success" type="submit">Get</button>
              </div>   
          </form>
      </span>
    </div>

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
            <h1 class="text-center" style="text-align:center;font-size:30px">
            {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}     Call-Out Details for {{$marketer}}</h1>
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

    <div style="margin-left:700px">
      <div class="col-sm-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:1.5rem">Filter By:</h1>
      </div>
      <form class="main-form" action="{{url('call_out_filter',$id)}}" method="GET" enctype="multipart/form-data">
        @csrf
        <select name="call_out_filter" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
          <option value="">---select Filter---</option>
          <option>Quotes</option>
          <option>Sales</option>
          <option>All</option>
        </select>
        <button class="btn btn-outline-success" type="submit">Filter</button>
      </form>
    </div>
  </div>

    <div align="center" style="padding-right:30px;padding-top:30px;margin-bottom:20px">
      <div  class="flex ml-3  items-center justify-center bg-gray-900 py-0" >
        <div class="flex mt-0">
            <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                    <div class="">
                        <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                              <tr style="background-color:black;">
                                <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Company</th>
                                <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Name</th>
                                <!-- <th style="padding:5px; font-size: 20px; color: white ;">Email</th> -->
                                <th style="padding:5px; font-size: 20px; color: white ;">Contact Number</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Location</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Any Quote?</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Quote Amount</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Any Sale?</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Sales Amount</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">MRC</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">OTC</th>
                                <th style="padding:5px; font-size: 20px; color: white ;">Comment</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($call_out as $call_outs)
                                <tr style="background-color: #fff;" align="left">
                                  <td>{{$loop->iteration}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->company_name}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->contact_name}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->contact_number}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->location}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->address}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->date}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->quote}}</td>
                                  <td style="padding: 3px; color: black;" >₦{{number_format($call_outs->quote_amount)}}</td>
                                  <td style="padding: 3px; color: black;">{{$call_outs->sales}}</td>
                                  <td style="padding: 3px; color: black;" >₦{{number_format($call_outs->sales_amount)}}</td>
                                  <td style="padding: 3px; color: black;" >{{$call_outs->service_plan}}</td>
                                  <td style="padding: 3px; color: black;" >{{$call_outs->service_type}}</td>
                                  <td style="padding: 3px; color: black;" >₦{{number_format($call_outs->MRC_sales)}}</td>
                                  <td style="padding: 3px; color: black;" >₦{{number_format($call_outs->OTC_sales)}}</td>
                                  <td style="padding: 3px; color: black;" >{{$call_outs->comment}}</td>
                                <tr>
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

    {{-- Generic Script --}}
    @include('user.human_resource.script')
  </body>
</html>
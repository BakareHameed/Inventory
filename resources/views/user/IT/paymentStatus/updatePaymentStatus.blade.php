<!DOCTYPE html>
<html lang="en">
  @include('user.IT.head')
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.IT.header')
 
  <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <h2 style="font-size:20px">Get All Between:</h2>
      <form class="main-form" action="{{url('all_tickets_query')}}" method="GET" enctype="multipart/form-data">

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
            All Unpaid Feasible Surveys
        </h1>
      </div>
  </div>


    <div class="container pb-3" align="text-center" style="padding-top: 5px;margin:15px">
        <div class="row ml-3">
            <div class="col-sm-3 col-lg-3 mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                  <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
            <table border=1 align='center' style= "margin-bottom: 50px;">
              

             
            </table>      	
        </div>
        <div style="margin-left:5rem" class="flex flex-col  items-center justify-center w-screen min-h-screen bg-gray-900 py-0">
          <div class="flex flex-col mt-0">
            <div class="-my-0 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full text-sm text-gray-400">
                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                      <tr style="background-color:black;">
                        <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Client</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Contact Person</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Email</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Assigned Engr.</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Feasibility</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Amount Paid</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Change Status</th>
                        <th style="padding:5px; font-size: 20px; color: white ;">Edit</th>
                      </tr>
                    </thead>
                    <tbody class="bg-gray-800">
                      @php
                          $i = ($clients->currentPage() - 1) * $clients->perPage();
                      @endphp

                      @foreach($clients as $client)
                        <tr style="background-color: white;" align="left">
                            <td style="padding: 2px; font-size: 15px; color: black;"><strong>{{++$i}}</strong></td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->id}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->clients}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->contact_person_name}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->customer_email}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->phone}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->address}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->date}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->service_plan}}</td>
                            <td style="padding: 2px; font-size: 15px; color: black;">{{$client->service_type}}</td>
                            @if ($client->third_assigned_engr !== null && $client->second_assigned_engr !== null && $client->first_assigned_engr !== null)
                              <td style="padding: 10px; color: black;">{{$client->third_assigned_engr}}</td>
                            @elseif ($client->third_assigned_engr == null && $client->second_assigned_engr !== null && $client->first_assigned_engr !== null )
                              <td style="padding: 10px; color: black;">{{$client->second_assigned_engr}}</td>
                            @else
                              <td style="padding: 10px; color: black;">{{$client->first_assigned_engr}}</td>
                            @endif
                            @if ($client->engr_name !== null && $client->latitude !== null  )
                              <td style="padding: 5px; color: black;">Feasible
                                <a class="btn btn-primary pt-1 pb-1 pr-1 pl-1" href="{{url('survey_report',$client->id)}}"> survey report</a>
                              </td>
                            @elseif ($client->engr_name !== null && $client->latitude == null  )
                              <td style="padding: 5px; color: black;">Not feasible
                                <a class="btn btn-primary pt-1 pb-1 pr-1 pl-1" href="{{url('survey_report',$client->id)}}"> survey report</a>
                              </td>
                            @else
                              <td style="padding: 10px; color: black;">NA</td>
                            @endif
                              <td style="padding: 2px; font-size: 15px; color: black;" >{{$client->status}}</td>
                              <td style="padding: 2px; font-size: 15px; color: black;" >₦{{number_format($client->amount_paid)}}</td>

                            @if ($client->engr_name == null )
                                <td style="padding: 2px; font-size: 15px; color: black;" >NA because feasibility is unknown</td>
                            @else
                              <td>
                                <a style="padding: 0px;margin-bottom:5px" class="btn btn-secondary" href="{{url('payment_confirmation_paid',$client->id)}}">paid</a><span>
                                <a style="padding: 0px;margin-bottom:5px" class="btn btn-danger" href="{{url('payment_confirmation_notpaid',$client->id)}}">Not paid</a></span>
                              </td>
                            @endif
                            <td style="padding: 5px; color: black;">
                                <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{url('edit_my_survey',$client->id)}}">Edit</a><span>
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
      <div>
    </div>
      {{ $clients->links('user.customPagination') }}
  <div>

  @include('user.IT.script')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
  @include('user.human_resource.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.human_resource.header')
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <span>
        <h2>Get All Clients :</h2>
        <form class="main-form" action="{{url('marketers_clients_HR_report',$id)}}" method="GET" enctype="multipart/form-data">
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
          Clients for {{$marketer}} from 
          {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
           To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
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
      </div>

      <div align="left" style="padding-right:30px;padding-top:30px">
        <div  class="flex ml-3 mb-5 items-center justify-center bg-gray-900 py-0" >
          <div class="flex mt-0">
              <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                  <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                      <div class="">
                          <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                              <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;">
                                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">S/N</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Client</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Person</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Email</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                                  <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($surveys as $appointment)
                                <tr style="background-color:#fff;" align="left">
                                  <td>{{$loop->iteration}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->clients}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->contact_person_name}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->customer_email}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->phone}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->service_plan}}</td>
                                  <td style="padding: 5px; color: black;">{{$appointment->service_type}}</td>
                                  @if($appointment->status=='Active')
                                    <td style="padding: 5px; color: black;  background-color: #8febab">{{$appointment->status}}</td>
                                  @elseif($appointment->status=='Inactive')
                                    <td style="padding: 5px; color: black;  background-color: yellow">{{$appointment->status}}</td>
                                  @else
                                    <td style="padding: 5px; color: black;  background-color: #fc6d6d ">{{$appointment->status}}</td>
                                  @endif
                                  <td style="padding: 5px; color: black;">{{$appointment->created_at}}</td>
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
    </div> 	
  </body>
</html>
{{-- Generic Script --}}
 @include('user.human_resource.script')


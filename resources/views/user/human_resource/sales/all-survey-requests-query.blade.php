<!DOCTYPE html>
<html lang="en">
  @include('user.human_resource.head')
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.human_resource.header')

  <div align="Center" style="padding:0px">
      <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:30px">
          All Surveys Raised from
          <b>
            {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
          </b>
          to
          <b>
            {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}} 
          </b>
        </h1>
      </div>
  </div>

  <div class="container" align="text-center" style="padding-top: 5px;">
    <div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2"  style="border-radius: 15px">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
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
      <div  class="flex ml-3  items-center justify-center bg-gray-900 py-0 pb-4" >
        <div class="flex mt-0">
            <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                    <div class="">
                        <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;">
                                    <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Personnel</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allSurveyRequest as  $survey)
                                    <tr style="background-color:#fff;" align="left">
                                        <td>{{$loop->iteration}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->name}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->clients}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->contact_person_name}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->phone}}</td>
                                        <td style="padding: 10px; color: black;">{{Carbon\Carbon::parse($survey[0]->date)->format('D, M j, Y')}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->service_plan}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey[0]->service_type}}</td>
                                        @if($survey[0]->download_bandwidth == null)
                                        <td style="padding: 10px; color: black;">{{$survey[0]->download_bandwidth}}</td>
                                        @else
                                        <td style="padding: 10px; color: black;">{{$survey[0]->download_bandwidth}}{{$survey[0]->unit}}</td> 
                                        @endif
                                        <td style="padding: 10px; color: black;">{{$survey[0]->feasibility}}</td>     
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

    {{-- Generic Script --}}
    @include('user.human_resource.script')
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

  <script src="http://10.0.0.244:8081/js/app.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Script for Multi-level dropdown list  -->
    <script>
      $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
          $(this).next('ul').toggle();
          e.stopPropagation();
          e.preventDefault();
        });
      });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
    <style>
        .dropdown-submenu {
          position: relative;
          background-color:white;
          color:black;
          font-size:18.5px;
        }
        .dropdown-submenu .dropdown-menu {
          position:absolute; top:50px; right:50px;
          background-color: #f0e9e9;
          color:#f2f7c6;
          font-size:18.5px;
        }
        .dropdown-item:hover{
          color:black
        }
        .dropdown-submenu :hover{
          color:black;
        }
    </style>
      <!-- End of Styling for multi-level dropdown -->     
            <style>
    thead {color: green;}
    tbody {color: blue;}
    tfoot {color: red;}
    table, th, td {
      border: 1px solid black;
    }
    </style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('admin.deployment.deploymentViewHeader')


 
<div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <h2 style="font-size:20px">Get Query:</h2>
    <form class="main-form" action="{{url('#')}}" method="GET" enctype="multipart/form-data">

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
          All Pending Surveys As at {{Carbon\Carbon::parse($currentDate)->format(' D, M j, Y')}} 
      </h1>
    </div>
</div>


    <div class="container" align="text-center" style="padding-top: 5px;margin:15px">
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">  {{$count}} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 py-3 wow fadeInUp text-center" style = "position:absolute;right:10%;">
          <h1 class="text-center" style="text-align:center;font-size:1.5rem">Filter By Engineer:</h1>
          <form class="main-form" action="{{url('engr_filter')}}" method="GET" enctype="multipart/form-data" >
                @csrf
                <select name="engr_name" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                    <option value="">---select Engineer---</option>
                    @foreach($engineers as $engineers)
                    <option value="{{$engineers->name}}" >{{$engineers->name}}</option>
                  @endforeach 
                    </select>
            <button class="btn btn-outline-success" type="submit">Filter</button>
          </form>
      </div>

        <div class="flex flex-col items-center justify-center w-screen  bg-gray-900 py-10">
            <div class="flex flex-col mt-6">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full text-sm text-gray-400" >
                      <thead class="bg-gray-800 text-xs uppercase font-medium">
                          <tr style="background-color:black;">
                            <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Client Name</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Contact Person Name</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                            <th style="padding:10px; font-size: 20px; color: white ;"> Assigned Engr</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Marketer</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Duration(Hrs) </th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Time Taken</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
                          </tr>
                      </thead>
                      <tbody class="bg-gray-800">
                          @php
                              $i = ($surveys->currentPage() - 1) * $surveys->perPage();
                          @endphp
                          @foreach($surveys as $survey)
                              <tr style="background-color: white;">
                                  <td style="padding: 10px; color: blue;">{{++$i}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->survey_id}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->clients}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->contact_person_name}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->date}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->service_plan}}</td>
                                  <td style="padding: 10px; color: black;">{{$survey->service_type}}</td>
                                  @if($survey->download_bandwidth == null)
                                    <td style="padding: 10px; color: black;">{{$survey->download_bandwidth}}</td>
                                  @else
                                     <td style="padding: 10px; color: black;">{{$survey->download_bandwidth}}{{$survey->unit}}</td> 
                                  @endif

                                  @if ($survey->third_assigned_engr !== null && $survey->second_assigned_engr !== null && $survey->first_assigned_engr !== null)
                                    <td style="padding: 10px; color: black;">{{$survey->third_assigned_engr}}</td>
                                  @elseif ($survey->third_assigned_engr == null && $survey->second_assigned_engr !== null && $survey->first_assigned_engr !== null )
                                    <td style="padding: 10px; color: black;">{{$survey->second_assigned_engr}}</td>
                                  @else
                                    <td style="padding: 10px; color: black;">{{$survey->first_assigned_engr}}</td>
                                  @endif

                                  @if($survey->feasibility!=null)
                                    <td style="padding: 10px; color: black;">{{$survey->feasibility}}</td>
                                  @else
                                    <td style="padding: 10px; color: black;"><strong><em>No report yet</em></strong></td>
                                  @endif
                                    <td style="padding: 10px; color: black;">{{$survey->name}}</td>
                                  @if($survey->duration_hours === null)
                                    <td style="padding: 10px; color: black;">{{$survey->duration_hours}}</td>
                                  @else
                                    <td style="padding: 10px; color: black;">{{$survey->duration_hours}} Hours</td>
                                  @endif
                                  <td style="padding: 10px; color: black;">{{$survey->duration_human}}</td>
                                  <td><a class="btn btn-primary" href="{{url('delivery_survey_report',$survey->survey_id)}}">view</a></td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                {{ $surveys->links('user.customPagination') }}
                <!-- <span class="text-yellow" style="color:blue">{{$surveys->links()}}</span> -->
                
              </div>
          </div>
          <!-- Component End  -->
        </div>
    <div>
</div>


<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
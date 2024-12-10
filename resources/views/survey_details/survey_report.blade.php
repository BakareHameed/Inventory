<!DOCTYPE html> 
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Syscodes Network Services</title>
  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <script src="http://10.0.0.244:8081/js/app.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <style>
    .city {
      color: black;
      border: 0.5px solid grey;
      margin: 20px;
      padding: 20px;
    }
    .city td{
      color: black;
      border: 0.5px solid grey;
      margin: 2px;
    }
  </style>
</head>

<!-- Back to top button -->
<div class="back-to-top"></div>
<header>
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 text-sm">
          <div class="site-info">
            <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
            <span class="divider">|</span>
            <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
          </div>
        </div>
        <div class="col-sm-4 text-right text-sm">
          <div class="social-mini-button">
            <a href="#"><span class="mai-logo-facebook-f"></span></a>
            <a href="#"><span class="mai-logo-twitter"></span></a>
            <a href="#"><span class="mai-logo-dribbble"></span></a>
            <a href="#"><span class="mai-logo-instagram"></span></a>
          </div>
        </div>
      </div> <!-- .row -->
    </div> <!-- .container -->
  </div> <!-- .topbar -->

  <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network</a>

      <div class="collapse navbar-collapse" id="navbarSupport">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
          <a class="dropdown-item" href="{{url('all_customers')}}">
          <button type="button" class="btn btn-outline-secondary">All Customers
          </button>
          </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{url('all_survey_report')}}">
            <button type="button" class="btn btn-outline-warning">All Survey Report </button>

            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('assigned_survey')}}">
            <button type="button" class="btn btn-outline-info">  Assigned appointment Survey </button>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('delivery_table')}}">
            <button type="button" class="btn btn-outline-primary">Pending Survey
            </button>
            </a>
          </li>
          <x-app-layout> 
          </x-app-layout>
      </div> <!-- .navbar-collapse -->
    </div> <!-- .container -->
  </nav>
</header>
  
<body>
    <center>
      <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Comprehensive Survey Report
          </h2>
      </div>
    </center>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                    <div class="text-xl">
                        Comprehensive Survey Report for
                        <span class="text-yellow-600">{{ $appointment->client }}, with ID:
                        @if($appointment->customer_id == null)
                            {{ $appointment->id }}
                        @else
                            {{$appointment->customer_id}}
                        @endif
                        </span>
                        located at 
                        <span class="text-yellow-600">{{ $appointment->address }}</span> carried out by Engineer 
                        <span class="text-blue-600">{{$appointment->engr_name }}</span>
                    </div>

                    @if ($appointment->engr_name != null && $appointment->latitude != null)
                        <div class="mt-8">
                            <div class="grid grid-cols-3 gap-8">
                                <div>
                                    <div class="font-bold">Latitude</div>
                                    <div class="pt-3">{{ $appointment->latitude }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Longitude</div>
                                    <div class="pt-3">{{$appointment->longitude }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Remote Latitude</div>
                                    <div class="pt-3">{{ $appointment->rem_latitude }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Remote Longitude</div>
                                    <div class="pt-3">{{$appointment->rem_longitude }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Building Height</div>
                                    <div class="pt-3">{{ $appointment->building_height }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Suitable Pole Location</div>
                                    <div class="pt-3">{{ $appointment->suitable_loc }}</div>
                                </div>
                                <div>
                                <div class="font-bold">Distance from Pop:</div>
                                <div class="pt-3">  {{ $appointment->distance_from_pop }}</div>
                                </div>
                                <div>
                                <div class="font-bold">Line of Site?</div>
                                <div class="pt-3">  {{ $appointment->LoS }}</div>
                                </div>
                                <div>
                                <div class="font-bold">Casting?</div>
                                <div class="pt-3">  {{ $appointment->required_casting }}</div>
                                </div>
                                <div>
                                    <div class="font-bold">Base Stations</div>
                                    <div class="pt-3">{{ $appointment->base_stations }}</div>
                                </div>
                            </div>
                            <div class="pt-3 modal-header"></div>
                            <label for="" style="text-align:left"><strong>Tools/Materials Required </strong></label>
                            <div class="p-12 grid grid-cols-6">
                                <table class="border-collapse city border table-auto w-full get-company ">
                                    <tr>
                                        <th style="color:black;">S/N</th>
                                    </tr>
                                    @foreach($array_materials as $items) 
                                        <tr>
                                            <td style="color:blue;">{{ $loop->iteration }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <table class="border-collapse border city table-auto w-full get-company">
                                    <tr>
                                        <th style="color:black;">Materials Needed</th>
                                    </tr>
                                    @foreach($array_materials as $items) 
                                        <tr>
                                            <td style="color:black;">{{ $items }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <table class="border-collapse city border table-auto w-full get-company">
                                    <tr>
                                        <th style="color:black;">Quantity</th>
                                    </tr>
                                    @foreach($array_quantity as $qty) 
                                        <tr>
                                            <td style="color:black;">{{ $qty }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            </div>
                            @php
                                $cablesum =  $appointment->vert_cable + $appointment->hori_cable + $appointment->exce_cable + $appointment->add_cable;
                            @endphp
                            <div class="pt-3">
                                    <div class="font-bold">Cable length breakdown:</div>
                                    <span class="pt-3 mr-3"><label><strong>Vertical Length:</strong> {{ $appointment->vert_cable }}m</label></span>
                                    <span class="pt-3 mr-3"><label><strong>Horizontal Length:</strong> {{ $appointment->hori_cable }}m</label></span>
                                    <span class="pt-3 mr-3"><label><strong>Excess Length:</strong> {{ $appointment->exce_cable }}m</label></span>
                                    <span class="pt-3 mr-3"><label><strong>Others:</strong> {{ $appointment->add_cable }}m</label></span><br>
                                    <span class="pt-3 mr-3"><label><strong>Total Length:</strong> <span style="color:blue;font-size:large"><strong>{{$cablesum}}m<strong></span></label></span>
                                </div>
                            </div>
                        </div>

                            <div class="pt-2"></div>
                            <div class="pt-2 card col-12">
                            <div class=""><strong>IT Rooom: Power/Environment </strong></div>
                                <table class="city col-md-6">
                                  <thead>
                                      <tr >
                                          <th class="ml-5 text-center" style="float:center">Power Information</th>
                                          <div class="hr"></div>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td style="color:black;">Primary source voltage</td>
                                          <td><strong>L-N</strong> = {{ $appointment->LN }}   <strong>L-E</strong> = {{ $appointment->LE }} <strong>E-N</strong> = {{ $appointment->EN }}</td>
                                      </tr>

                                      <tr>
                                          <td style="color:black;">Secondary source voltage</td>
                                          <td>{{ $appointment->sec_src_volt }}  </td>
                                      </tr>

                                      <tr>
                                          <td style="color:black;">UPS Availability</td>
                                          <td>{{ $appointment->ups }} </td>
                                      </tr>

                                      <tr>
                                          <td style="color:black;">UPS power rating/current load (%)</td>
                                          <td>{{ $appointment->ups_power }} </td>
                                      </tr>

                                      <tr>
                                          <td style="color:black;">Power Extension</td>
                                          <td>{{ $appointment->power_ext }}</td>
                                      </tr>

                                      <tr>
                                          <td style="color:black;">Conducive Environment</td>
                                          <td>{{ $appointment->env }}</td>
                                      </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pt-2 card col-12">
                            <div class="mt-8 ml-4">
                                <div class="font-bold">Additional Info:</div>
                                <div class="pt-3">{{ $appointment->additional_info }}</div>
                            </div>

                            @if($appointment->pole_img != null)
                                <div class="mt-6">
                                    <div class="font-bold pt-3 ml-4">Suitable Pole Location Image(s):</div>
                                    <div class="row pt-3 gx- ml-4"> 
                                        @foreach(explode('|' ,$appointment->pole_img) as $image)
                                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: fit-content;max-height:fit-content">
                                                <div class="row ">
                                                    <img src="{{ asset('image/survey_images/pole_location/'. $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($appointment->survey_img != null)
                                <div class="mt-6">
                                    <div class="font-bold ml-4">Image Before Casting:</div>
                                    <div class="row pt-3 gx-5 ml-4"> 
                                        @foreach(explode('|' ,$appointment->survey_img) as $image)
                                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                                <div class="row ml-3">
                                                    <img src="{{ asset('image/survey_images/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="mt-8">
                            <div class="font-bold">Reason:</div>
                            <div class="pt-3">{{ $appointment->additional_info }}</div>
                        </div>
                        @if($appointment->survey_img != null)
                            <div class="mt-6">
                                <div class="font-bold">Pictoral Proof:</div>
                                <div class="row pt-3 gx-5"> 
                                    @foreach(explode('|' ,$appointment->survey_img) as $image)
                                        <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                            <div class="row ">
                                                <img src="{{ asset('image/non_feasible_images/proof/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                @if(Auth::user()->role === "Delivery Engineer")
                    <div>
                        <div class="mt-8">
                            <div class="font-bold">Send Comment To Marketer:</div>
                            <div class="pt-3"> <a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('commentview',$appointment->id)}}">comment</a></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

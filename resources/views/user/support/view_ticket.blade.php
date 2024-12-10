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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}">

        <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function() {
                let commonId = ".datepicker";

                $( commonId ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0,
                });
            });
        </script>

    <style>
      thead {color: black;}
      tbody {color: black;}
      tfoot {color: red;}
      table, th, td {
        border: 1px solid black;
      }
    </style>
    </head>
<body>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  @include('user.support.header')

<body>
@foreach($tickets as $tickets)

    <div style="margin: 20px;margin-bottom:0px">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
            Report on Field Support(<span class="text-gray-600">Ticket ID- {{ $tickets->ticket_id }} </span>)
        </h2>
    </div>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                    <div class="text-xl">
                        A comprehensive <strong><em> field support report</em></strong> for <span class="text-yellow-600">{{ $tickets->client_name }}
                        </span>
                        located at 
                        <span class="text-yellow-600">{{ $tickets->client_address }}</span>, raised on  <span class="text-yellow-600">{{Carbon\Carbon::parse($tickets->created_at)->format('D, M j, Y g:i A')}}</span>, carried out by Engineer 
                        <span class="text-blue-600">{{$tickets->car_out_by }}</span> and reported on {{Carbon\Carbon::parse($tickets->submitted_at)->format('D, M j, Y g:i A')}}.
                    </div>
                    <div class="mt-8">
                        <div class="grid grid-cols-6 gap-8">
                            <div>
                                <div class="font-bold">Fault</div>
                                <div class="pt-3">{{ $tickets->fault }}</div>
                            </div>
                            <div>
                                <div class="font-bold">Fault Type</div>
                                <div class="pt-3">{{$tickets->fault_type }}</div>
                            </div>
                            <div>
                                <div class="font-bold">Fault Level</div>
                                <div class="pt-3">{{ $tickets->fault_level }}</div>
                            </div>
                            
                           
                            <div>
                                <div class="font-bold">1st Assigned Engr:</div>
                                <div class="pt-3">  {{ $tickets->first_engr }}</div>
                            </div>
                            @if($tickets->second_engr != null)
                                <div>
                                    <div class="font-bold">Second Assigned engineer:</div>
                                    <div class="pt-3">{{ $tickets->second_engr }}</div>
                                </div>
                            @endif
                        </div>
                    </div>


                            <div class="p-12 grid grid-cols-2" style="margin-top: 20px;">
                                <table class="border-collapse border table-auto w-full get-company">
                                    <tr>
                                        <th>Things Checked</th>
                                        <th>Status Report</th>
                                        <th>Parameter</th>
                                    </tr>

                                        <tr>
                                            <td>Signal Strength(Rx/Tx)</td>
                                            <td>{{ $tickets->signal_strength }}</td>
                                            <td>{{ $tickets->RX }}/{{ $tickets->TX }}</td>
                                        </tr>
                                        <tr>
                                            <td>Chain Balance</td>
                                            <td>{{ $tickets->chain_balance }}</td>
                                            <td>{{ $tickets->chain_param }}</td>
                                        </tr>
                                        <tr>
                                            <td>Client's LAN</td>
                                            <td>{{ $tickets->client_LAN }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Pole status</td>
                                            <td>{{ $tickets->pole_status }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Power status</td>
                                            <td>{{ $tickets->power_status }}</td>
                                            <td>{{ $tickets->power_param }}</td>
                                        </tr>
                                        <tr>
                                            <td>RF status</td>
                                            <td>{{ $tickets->RF_status }}</td>
                                            <td>{{ $tickets->RF_param }}</td>
                                        </tr>
                                </table>
                            </div>
                            
                            <div class="mt-8">
                                <div class="font-bold">RCA:</div>
                                <div class="pt-3">{{ $tickets->RCA }}</div>
                            </div>

                            <div class="mt-8">
                                <div class="font-bold">Resolution:</div>
                                <div class="pt-3">{{ $tickets->Resolution }}</div>
                            </div>
                            @if($tickets->field_image != null)
                                <div class="mt-8">
                                    <div class="font-bold">Image:</div>
                                    <div class="row pt-3 gx-5"> 
                                        @foreach(explode('|' ,$tickets->field_image) as $image)
                                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="width: fit-content;max-height:fit-content;">
                                                <div class="row ">
                                                    <img src="{{ asset('image/field_support/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                </div>
                                            </div>
                                        
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if($tickets->additional != null)
                                <div class="mt-8">
                                    <div class="font-bold">Additional Comment:</div>
                                    <div class="pt-3">{{ $tickets->additional }}</div> 
                                </div>
                            @endif
                   
                        </div>
                        @if($tickets->status != "Closed" && (Auth::user()->role ==="Service Support Analyst" || Auth::user()->role ==="Service Support Engineer"))
                            <div>
                                <div class="mt-8">
                                    <div class="font-bold">Send Mail To Client:</div>
                                    <div class="pt-3"> <a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('close_ticket',$tickets->ticket_id)}}">Send Mail</a></div>
                                </div>
                            </div>
                        @endif
            </div>
        </div>
    </div>
@endforeach


<!DOCTYPE html>
<html lang="en">
@include('user.support.head')
<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.support.header')
    
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
        <h2 style="font-size:20px">Get All Between:</h2>
        <form class="main-form" action="{{route('all.tickets.query')}}" method="GET" enctype="multipart/form-data">
        @csrf
                <div class="container">
                <div class="row">
                    <div class="form-group name1 col-md-6">
                        <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                        <input style="background-color:white;cursor: pointer;" type="date" 
                        class="form-control border-gray-300 rounded-md shadow-md"
                        name="dateS">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                        <input style="background-color:white;cursor: pointer;" type="date" 
                        class="form-control border-gray-300 rounded-md shadow-md" name="dateE">
                    </div>
                </div>  
                <button class="btn btn-outline-success" type="submit">Get</button>
            </div>   
        </form>
    </div>

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">
            All Tickets Raised from 
            <b>{{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}</b> to 
            <b>{{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}</b> 
        </h1>
        </div>
    </div>

    <div class="container" align="text-center" style="padding-top: 5px;margin:15px">
        <div class="row">
            <div class="col-xl-3 col-lg-4  mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="flex flex-col items-center justify-center w-screen sm-h-screen bg-gray-900 py-0">
            <div class="flex flex-col mt-2 ">
                <div class="-my-1 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div align="right">    
                            <span>
                                <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger" href="{{url('erp_cust_ticket')}}" > Client Tickets</a>
                            </span>
                            <span>
                                <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger" href="{{route('my.dailyHandover')}}" > My Handover</a>
                            </span>
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;">
                                        <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Phone</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Fault</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Level</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Details</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Raised on</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Assigned To</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Report</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800">
                                    @php
                                        $i = ($tickets->currentPage() - 1) * $tickets->perPage();
                                    @endphp
                                    @foreach($tickets as $ticket)
                                    <tr style="background-color: white;" align="left">
                                        <td style="padding: 5px; color: black;">{{++$i}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->client_name}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->client_phone}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->client_email}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->client_address}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->fault}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->fault_type}}</td>
                                        <td style="padding: 5px; color: black;">{{$ticket->fault_level}}</td>
                                        <td style="padding: 0px; color: black;">{{$ticket->fault_details}}</td>
                                        <td style="padding: 5px; color: black; background-color: #85FFBD; background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><strong>{{$ticket->status}}</strong></td>
                                        <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->start_time)->format('D, M j, Y g:i A')}}</td>
                                        <td style="padding: 5px; color: black; background-color:green"><strong><span style="font-size:20px">{{$ticket->status}}</span> <br><span style="color:white">{{Carbon\Carbon::parse($ticket->end_time)->format('D, M j, Y g:i A')}}</span></strong></td>
                                        <td style="padding: 3px; color: black;" >
                                            <strong> Submitted-</strong> {{Carbon\Carbon::parse($ticket->submitted_at)->format('D, M j, Y g:i A')}}-<em><strong> By-</strong></em><strong><em> {{$ticket->car_out_by}}</em></strong> 
                                            <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary" href="{{url('ticket_report',$ticket->ticket_id)}}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $tickets->links('user.customPagination') }}
                </div>
            </div>
            <!-- Component End  -->
        <div>
    <div>
</div>

<!-- Script for laravel sweet alert when deleting record -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script type="text/javascript">
  
      $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to cancel this ticket?`,
                text: "If you cancel this ticket, it will not be seen by the engineer.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            ;
        });
  </script>

<!-- Script for laravel sweet alert when deleting record -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
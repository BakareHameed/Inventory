<!DOCTYPE html>
<html lang="en">
    @include('user.delivery_engineer.head')
    <body>
    
      <!-- Back to top button -->
      <div class="back-to-top"></div>
      @include('user.support.header')
    
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
            @if($count>0)
                <h1 class="text-center" style="text-align:center;font-size:2rem">
                    All My Raised Tickets Search Results  for <strong>{{$search}}</strong>
                </h1>
            @else
                <h1 class="text-center" style="text-align:center;font-size:2rem">
                    No Tickets Search Results  for <strong>{{$search}}</strong>
                    on My Raised Ticket
                </h1>
            @endif
        </div>
    </div>

  
    <div class="container pb-3 "  align="left" style="padding:0px">
        <div class="row ml-3">
            <div class="col-sm-3 col-lg-3 mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div align="right">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
            @endif
        </div>

        <div style="margin-left:90vw" class="flex ml-4 items-center justify-center w-screen bg-gray-900 py-0" >
            <div class="flex mt-0 ml-4">
                <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table  class="min-w-full text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;">
                                        <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Phone</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Fault</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Type</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Level</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Details</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Raised on</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Assigned on</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Action/Report</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Delete</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = ($tickets->currentPage() - 1) * $tickets->perPage();
                                @endphp
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr style="background-color: white;" align="left">
                                            <td style="padding: 5px; color: black;"><strong>{{++$i}}</strong></td>
                                            <td style="padding: 5px; color: black;">{{$ticket->client_name}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->client_phone}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->client_email}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->client_address}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->fault}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->fault_type}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->fault_level}}</td>
                                            <td style="padding: 5px; color: black;">{{$ticket->fault_details}}</td>
                                            @if($ticket->status =='Open')
                                                <td style="padding: 5px; color: black; background-color: #85FFBD; background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><strong>{{$ticket->status}}</strong></td>
                                                <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}</td>
                                                <td style="padding: 5px; color: black;">Not Yet Assigned
                                                    <button id="btn+{{ $ticket->ticket_id }}" onclick="show_engr('{{ $ticket->ticket_id }}');" class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form"  style="padding: 2px;margin-bottom:2; color:white;background-color:darkviolet" >Assign Engr</button>
                                                    
                                                    <form class="main-form"  action="{{url('assign_engineer',['ticket_id'=>$ticket->ticket_id])}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                                                        <div class="col-12 col-lg-6 py-2 Assign_engr" style="display:none" id="{{$ticket->ticket_id}}">
                                                            <select required name="first_engr_id" >
                                                                <option value="">--- Assign Engineer ---</option>
                                                                @foreach($engineers as $engineer)
                                                                    <option value="{{$engineer->id}}"  id="first_engr_id" >{{$engineer->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select required name="purpose" >
                                                                <option value="">--- Assignment Purpose ---</option>
                                                                <option>Maintenance</option>
                                                                <option>Deployment</option>
                                                                <option>Retrieval</option>
                                                                <option>Survey</option>
                                                            </select>
                                                            <select required name="resolution" >
                                                                <option value="">--- Resolution Type ---</option>
                                                                <option>Field</option>
                                                                <option>Remote</option>
                                                            </select>
                                                            
                                                            <button type="submit" class="btn btn-primary" style="background-color:#68edc5; padding:0%">Submit</button>
                                                        </div>
                                                        
                                                    </form>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->u_status == 'Active' && (Auth::user()->role == 'Service Support Engineer' || Auth::user()->role == 'Service Support Analyst' || 
                                                        Auth::user()->role == 'Admin Manager'))
                                                        <form  method="POST" enctype="multipart/form-data" action="{{ route('delete.ticket',$ticket->ticket_id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a style="padding:10px; color: black; margin-top:3px" class="btn btn-xs btn-danger btn-flat show_confirm">
                                                            Delete
                                                            </a>
                                                        </form> 
                                                    @endif
                                                </td>
                                            @elseif($ticket->status =='In Progress' || $ticket->status =='Assigned' || $ticket->status =='Reassigned' )
                                                <td style="padding: 5px; color: black; background-color: #FBAB7E;background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);"><strong>{{$ticket->status}}</strong></td>
                                                <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}</td>
                                                <td style="padding: 5px; color: black;">
                                                {{Carbon\Carbon::parse($ticket->assigned_time)->format('D, M j, Y g:i A')}}--to--<strong style="color:brown;">{{ $ticket->first_engr}}</strong>
                                                </td>
                                                <td style="padding: 5px; color: black;" >
                                                    <span><strong><em>No report yet</em></strong></span>
                                                    <a style="padding: 10pxpx;margin-bottom:5px;background-color:darkviolet" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#Reassign{{$ticket->ticket_id}}">
                                                        Reassign
                                                    </a>
                                                </td>
                                            @elseif($ticket->status =='Done')
                                                <td style="padding: 5px; color: black; background-color:#68edc5"><strong>{{$ticket->status}}</strong></td>
                                                <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}</td>
                                                <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->assigned_time)->format('D, M j, Y g:i A')}}</td>
                                                <td style="padding: 3px; color: black;" >
                                                    <strong> Submitted-</strong> {{Carbon\Carbon::parse($ticket->submitted_at)->format('D, M j, Y g:i A')}}-<em><strong> By-</strong></em><strong><em> {{$ticket->car_out_by}}</em></strong> 
                                                    <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary" href="{{url('ticket_report',$ticket->ticket_id)}}">
                                                        View
                                                    </a>
                                                </td>
                                            @elseif($ticket->status =='Closed')
                                                <td style="padding: 5px; color: black; background-color:Grey"><strong>{{$ticket->status}}</strong></td>
                                                <td style="padding: 5px; color: black;">
                                                    {{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}
                                                    -<em><strong> By-</strong></em><strong><em style="color:blue"> {{$ticket->raised_by}}</em>
                                                </td>
                                                <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->assigned_time)->format('D, M j, Y g:i A')}}</td>
                                                <td style="padding: 3px; color: black;" >
                                                    <strong> Submitted-</strong> {{Carbon\Carbon::parse($ticket->submitted_at)->format('D, M j, Y g:i A')}}-<em><strong> By-</strong></em><strong><em> {{$ticket->car_out_by}}</em></strong> 
                                                    <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary" href="{{url('ticket_report',$ticket->ticket_id)}}">
                                                        View
                                                    </a>
                                                </td>
                                            @endif
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
    <div class="pt-2 pb-5">
        {{ $tickets->links('user.customPagination') }}
    </div>

    @foreach($tickets as $ticket)
        @include('user.support.ticket-assignment.reassign')
    @endforeach
  </body>
  <!-- Beginning  of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Beginning of required script for Modal -->

    <!-- Script for laravel sweet alert when deleting record -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <script type="text/javascript">
      
          $('.show_confirm').click(function(event) {
              var form =  $(this).closest("form");
              var name = $(this).data("name");
              event.preventDefault();
              swal({
                  title: `Are you sure you want to delete this handover record?`,
                  text: "If you delete this, it will be gone forever.",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                  form.submit();
                  }
              });
          });
      
      </script>
    <!-- Script for laravel sweet alert when deleting record -->
</html>



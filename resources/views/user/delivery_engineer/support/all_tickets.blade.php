<!DOCTYPE html>
<html lang="en">
@include('user.delivery_engineer.head')
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
          All Tickets
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
              </tr>

              @php
                  $i = ($tickets->currentPage() - 1) * $tickets->perPage();
              @endphp
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
                      <td style="padding: 5px; color: black;">{{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}</td>
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
            </table>      	
        </div>
        {{ $tickets->links('user.customPagination') }}
    <div>
</div>

@foreach($tickets as $ticket)
  @include('user.support.ticket-assignment.reassign')
@endforeach

<!-- Beginning of required script for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- Beginning of required script for Modal -->

<script type="text/javascript">
  function show_engr(ticket_id){
    console.log('ticket_id' + ticket_id);
    var form = document.getElementById(ticket_id);
    
    if (form.style.display === 'none') {
      console.log('display' + ticket_id);
        form.style.display = 'block';
    } else {
      console.log('none' + ticket_id);
        form.style.display = 'none';
    }

  }
  const btn = document.getElementsById('btn');

  $(".btn").addEventListener('click', () => {
    const form = document.getElementsById('Assign_engr');

    if (form.style.display === 'none') {
        // 👇️ this SHOWS the form
        form.style.display = 'block';
    } else {
        // 👇️ this HIDES the form
        form.style.display = 'none';
    }
    });

</script>
<!-- <script>
function test(){
  $('#myModal').modal('toggle');
  $('#rowValue').empty().append($("#inputID").val());
  }
</script> -->
@include('user.delivery_engineer.genericScripts')
</body>
</html>
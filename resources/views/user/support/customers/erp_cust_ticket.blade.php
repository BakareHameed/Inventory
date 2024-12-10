<!DOCTYPE html>
<html lang="en">
@include('user.support.head')
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.support.header')

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">
            ALL Clients 
        </h1>
        </div>
    </div>
    </div>
      @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{$message}}</strong>
      @endif
    </div>
    
    <div class="container" align="left" >
        <div class="row">
            <div class="col-sm-2 col-sm-2  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
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
            </div>
        </div>
 
<div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-10">
	<div class="flex flex-col mt-6">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div align="right">    
                    <span>
                        <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger" href="{{ route('my.dailyHandover')}}" >My Handover</a>
                    </span>
                    <span>
                        <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="{{ route('support.dailHandover.add')}}" >All Handove</a>
                    </span>
                </div>
				<div class="shadow overflow-hidden sm:rounded-lg">
					<table class="min-w-full text-sm text-gray-400">
						<thead class="bg-gray-800 text-xs uppercase font-medium">
                            <tr style="background-color:black;">
                                <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Client_ID</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Phone</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Plan</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                            </tr>
						</thead>
						<tbody class="bg-gray-800">
                        {{-- @php
                            $i = ($clients->currentPage() - 1) * $clients->perPage();
                        @endphp --}}
                        @foreach($clients as $client)
                            <tr style="background-color: white;" align="left">
                                <td style="padding: 5px; color: blue;"><strong>{{$loop->iteration}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->id}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->clients}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->phone}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->customer_email}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->address}}</strong></td>
                                <td style="padding: 5px; color: black;"><strong>{{$client->service_type}}</strong></td>
                                @if($client->status=='Active')
                                    <td style="padding: 5px; color: black;  background-color: #8febab"><strong>{{$client->status}}</strong></td>
                                @elseif($client->status=='Inactive')
                                    <td style="padding: 5px; color: black;  background-color: yellow"><strong>{{$client->status}}</strong></td>
                                @else
                                    <td style="padding: 5px; color: black;  background-color: #fc6d6d "><strong>{{$client->status}}</strong></td>
                                @endif
                                <td>
                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Edit{{$client->id}}">Edit</a>
                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#RaiseTicket{{$client->id}}">Raise</a>
                                    {{-- <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{url('erp_client_incident_ticket',$client->id)}}">Raise</a><span> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                       
                    </div>
                </div>
                {{ $clients->links('user.customPagination') }}
            </div>
        </div>
        <!-- Component End  -->
    </div>
    <div>
</div>


    @foreach($clients as $client)
        @include('user.delivery_engineer.customers.edit')
    @endforeach

    @foreach($clients as $client)
        @include('user.support.erp_ticket_form')
    @endforeach

    <!-- Beginning of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Beginning of required script for Modal -->

</body>
</html>
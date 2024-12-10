<!DOCTYPE html>
<html lang="en">
@include('user.support.head')
    <body>
        @include('sweetalert::alert')
        <!-- Back to top button -->
        <div class="back-to-top"></div>
        @include('user.support.header')

        <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
            <h2 style="font-size:20px">Get All Between:</h2>
            <form class="main-form" action="{{route('all.dailyHandover.query')}}" method="GET" enctype="multipart/form-data">
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
        
        <div align="center" style="padding:0px">
            <div class="col-md-3 py-3 wow fadeInUp text-center" >
                <h1 class="text-center" style="text-align:center;font-size:2rem">
                  Daily Handover For <b>{{Carbon\Carbon::parse($today)->format('D, M j, Y')}}</b>
                </h1>
            </div>
        </div>

        <div align="center"  >
            @if ($errors->has('findings'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('findings') }}</strong>
                </span>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
            @endif
        </div>


        <div class="container pb-0"  align="left" style="margin-left:5vw">
            <div class="row">
                <div class="col-lg-6 ">
                    <div class="col-lg-6 col-md-3 ">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-left">
                                    <div class="">
                                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div  class="flex  items-center justify-center bg-gray-900 py-0" >
                <div class="flex mt-0">
                    <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                        <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                            <div class="">
                                <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                    <div align="right">    
                                         
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger" href="{{url('erp_cust_ticket')}}" > Client Tickets</a>
                                        </span>
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-success" href="{{ route('my.dailyHandover')}}" >My Handover</a>
                                        </span> 
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info" href="#" data-bs-toggle="modal" data-bs-target="#sendDailyHandover">Send Handover</a>
                                            {{-- <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-warning" href="#" data-bs-toggle="modal" data-bs-target="#DailyHandover">Add</a> --}}
                                        </span>
                                    </div>
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                        <tr style="background-color:black;" >
                                            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Clients</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Issues</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Start Time</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Last Mile Update</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Support's Findings</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Resolution(RCA)</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">End Time</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Radio IP</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">POP</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Resolved By</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Comment</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = ($dailyHandovers->currentPage() - 1) * $dailyHandovers->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach($dailyHandovers as $dailyHandover)
                                            <tr style="background-color: white;" >
                                                <td>{{++$i}}</td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->clients }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->issue }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{Carbon\Carbon::parse( $dailyHandover->start_time)->format('D, M j, Y g:i A')}}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->last_mile_update }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->findings }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->resolution }}</strong></td>
                                                <td style="padding: 3px; color: black;">
                                                    @if($dailyHandover->end_time !==null)
                                                        <strong>{{Carbon\Carbon::parse( $dailyHandover->end_time)->format('D, M j, Y g:i A')}}</strong>
                                                    @endif
                                                </td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->radio_IP }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->pop }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->resolved_by }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->status }}</strong></td>
                                                <td style="padding: 3px; color: black;"><strong>{{ $dailyHandover->comment }}</strong></td>
                                                <td style="padding: 3px; color: black;"> 
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#EdidDailyHandover{{$dailyHandover->id}}">Edit</a>
                                                    @if((Auth::user()->role == 'Service Support Engineer'  && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Service Support Analyst')
                                                        && $dailyHandover->status == 'Pending')
                                                        <form method="POST" action="{{ route('handover.delete',$dailyHandover->id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a style="padding:3px; color: black;" class="btn btn-xs btn-danger btn-flat show_confirm">
                                                            Delete
                                                            </a>
                                                        </form> 
                                                    @endif
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
        </div>
        <div class="pt-2 pb-5">
            {{ $dailyHandovers->links('user.customPagination') }}
        </div>

        {{-- Client Handover form --}}
        @include('user.support.dailyHandover.alternate-send')
        
        @foreach($dailyHandovers as $handover)
            @include('user.support.dailyHandover.edit')
        @endforeach


        {{-- For Adding Handover --}}
        @foreach($dailyHandovers as $handover)
            @include('user.support.dailyHandover.form')
        @endforeach

    </body>
    <!-- Beginning  of required script for Modal -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Beginning of required script for Modal -->

    {{-- Script for Autofilling Input Field --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#clients').change(function (){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                var id = $(this).val();
                if(id != '')
                {
                    var _token = $('input[name="_token"]').val();
                }
                $.ajax({
                    type: "GET",
                    url:"/client/autocomplete/Form/"+id,
                    dataType:'json',
                    success:function(data)
                    { 
                        //to get current date
                        const today = new Date();
                        const yyyy = today.getFullYear();
                        let mm = today.getMonth() + 1; // Months start at 0!
                        let dd = today.getDate();
                        if (dd < 10) dd = '0' + dd; //to en
                        if (mm < 10) mm = '0' + mm;
                        day = yyyy  + '-' + mm + '-' + dd; //In dd/mm/yyyy format
                        
                        //Get Client's data
                        radio_ip = data.AP+"/"+data.SM;
                        pop=data.pop;

                        //auto fill into form
                        $('#radio_ip').val(radio_ip); 
                        $('#pop').val(pop); 
                        $('#day').val(day); 
                        // $('#end_day').val(day);
                        console.log(day);
                    }

                })
            });
        });
    </script>
    {{----Script for Displaying resolved if Status Is Resolved----}}
    <script type="text/javascript">
        function statusChange(id,that)
        {
            updateDiv = document.getElementById('resolved'+id);
            if(that.value ==="Resolved")
            {
                updateDiv.style.display = "block";
            }
            else
            {
                updateDiv.style.display = "none";
            }
            // if()

        }
    </script>

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



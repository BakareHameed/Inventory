<!DOCTYPE html>
<html lang="en">
@include('user.finance.head')

<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')

    @if ($clients)
        <div align="Center" style="padding:0px">
            <div class="col-lg-6 py-3 wow fadeInUp text-center">
                <h1 style="font-size: 32px" class="text-center">
                    Search result for <strong>{{ $search }}</strong>
                </h1>
            </div>
        </div>
        <div align="center">
            @if ($errors->has('findings'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('findings') }}</strong>
                </span>
            @endif
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert"><strong>Success:</strong>{{ Session::get('message') }}
                </div>
            @endif
        </div>

        <div class="row container ml-3">
            <div class="col-xl-3 col-lg-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    <a href="" style="text-decoration: none">
                                        Count
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $count }}
                                </div>
                            </div>
                            <div class="col-auto">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div align="center" style="margin-left:5vw;padding-top:30px">
            <div class="flex ml-3  items-center justify-center bg-gray-900 py-0">
                <div class="flex mt-0">
                    <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                        <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                            <div class="">
                                <table class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                        <tr style="background-color:black;">
                                            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Client</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Contact Person</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Email</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                                            {{-- <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th> --}}
                                            <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Avg. Speed</th>
                                            {{-- <th style="padding:5px; font-size: 20px; color: white ;">Bandwidth</th> --}}
                                            {{-- <th style="padding:5px; font-size: 20px; color: white ;">Deployed Date</th> --}}
                                            <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">POP</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Subscription Date
                                            </th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = ($clients->currentPage() - 1) * $clients->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr style="background-color: white;" align="left">
                                                <td>{{ ++$i }}</td>
                                                <td style="padding: 5px; color: black;">{{ $client->id }}</td>
                                                <td style="padding: 5px; color: black;">{{ $client->clients }}</td>
                                                <td style="padding: 5px; color: black;">
                                                    {{ $client->contact_person_name }}</td>
                                                <td style="padding: 5px; color: black;">{{ $client->customer_email }}
                                                </td>
                                                <td style="padding: 5px; color: black;">{{ $client->phone }}</td>
                                                <td style="padding: 5px; color: black;">{{ $client->address }}</td>
                                                {{-- <td style="padding: 5px; color: black;">{{$client->service_plan}}</td> --}}
                                                <td style="padding: 5px; color: black;">{{ $client->service_type }}
                                                </td>
                                                <td style="padding: 10px; color: black;">
                                                    {{ $client->avg_speed }}{{ $client->unit }}</td>
                                                {{-- <td style="padding: 10px; color: black;">{{$client->download_bandwidth}}{{$client->unit}}</td> --}}
                                                {{-- <td style="padding: 5px; color: black;">{{$client->created_at}}</td> --}}
                                                @if ($client->status == 'Active')
                                                    <td style="padding: 5px; color: black;  background-color: #8febab">
                                                        {{ $client->status }}</td>
                                                @elseif($client->status == 'Inactive')
                                                    <td style="padding: 5px; color: black;  background-color: yellow">
                                                        {{ $client->status }}</td>
                                                @else
                                                    <td style="padding: 5px; color: black;  background-color: #fc6d6d ">
                                                        {{ $client->status }}</td>
                                                @endif
                                                <td style="padding: 5px; color: black;">{{ $client->pop }}</td>
                                                <td style="padding: 5px; color: black;">
                                                    {{ Carbon\Carbon::parse($client->activation_deactivation_date)->format('D, M j, Y g:i A') }}
                                                </td>

                                                <td style="padding: 5px; color: black;">
                                                    <a style="padding: 10px;margin-bottom:8px" class="btn btn-info"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Activate{{ $client->id }}">Activate</a>
                                                    <a style="padding: 3px;margin-bottom:5px" class="btn btn-danger"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Deactivate{{ $client->id }}">Deactivate</a>
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
        @foreach ($clients as $client)
            @include('user.finance.client-sub.deactivate')
        @endforeach

        @foreach ($clients as $client)
            @include('user.finance.client-sub.activate')
        @endforeach

        @include('user.finance.general-scripts')

    @endif
</body>

</html>

<script>
    // Get today's date
    var today = new Date().toISOString().split('T')[0];
    // Set the value of the date input field to today's date
    document.getElementById("billingDate").value = today;
</script>

@extends('user.networkOps.index')
@section('content')
    <div class="section">
        <div align="Center" style="padding:0px">
            <div class="col-lg-6 py-3 wow fadeInUp text-center">
                <h1 class="text-center" style="text-align:center; font-size:30px">Links Ready For Integration</h1>
            </div>
        </div>
        <div class="flex  items-center justify-center w-screen bg-gray-900 py-0">
            <div class="flex mt-0">
                <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="">
                            <table class="shadow overflow-hidden sm:rounded-lg min-w-full text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;" align="Center">
                                        <th style="padding:10px; font-size: 20px; color: white ;">Survey ID</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Integrate</th>
                                    </tr>
                                </thead>
                                {{-- @php
                                $i = ($totalPOPs->currentPage() - 1) * $totalPOPs->perPage();
                            @endphp --}}
                                <tbody>
                                    @foreach ($appointments as $client)
                                        <tr style="background-color: #fff;">
                                            <td style="padding: 10px; color: black;">{{ $client->id }}</td>
                                            <td style="padding: 10px; color: black;">{{ $client->clients }}</td>
                                            <td style="padding: 10px; color: black;">{{ $client->phone }}</td>
                                            <td style="padding: 10px; color: black;">{{ $client->address }}</td>
                                            <td style="padding: 10px; color: black;">{{ $client->service_plan }}</td>
                                            <td style="padding: 10px; color: black;">{{ $client->service_type }}</td>
                                            <td style="padding: 10px; color: black;">
                                                {{ $client->download_bandwidth }}{{ $client->unit }}</td>
                                            <td>
                                                <a style="padding: 10px;margin-bottom:5px" class="btn btn-primary"
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target="#Integrate{{ $client->id }}">Integrate</a>
                                            </td>
                                            {{-- <td>
                                            <a style="padding: 5px;margin-bottom:5px" class="btn btn-secondary" href="{{url('integrate',$client->id)}}">Integrate</a>
                                        </td> --}}
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

    @foreach ($appointments as $data)
        @include('user.networkOps.integrate.fresh')
    @endforeach
@endsection

<!DOCTYPE html>
<html lang="en">
@include('user.human_resource.head')

<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.human_resource.header')

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:30px">
                {{ $title }} from
                <b>
                    {{ Carbon\Carbon::parse($dateS)->format('D, M j, Y') }} To
                    {{ Carbon\Carbon::parse($dateE)->format('D, M j, Y') }}
                </b>
            </h1>
        </div>
    </div>

    <div class="container" align="text-center" style="padding-top: 5px;">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }} </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₦ {{ number_format($value) }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> MRC</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦ {{ number_format($MRC) }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> OTC</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> ₦ {{ number_format($OTC) }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div align="left" style="padding-right:30px;padding-top:30px">
            <div class="flex ml-3  items-center justify-center bg-gray-900 py-0 pb-4">
                <div class="flex mt-0">
                    <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                        <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                            <div class="">
                                <table class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                        <tr style="background-color:black;">
                                            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Sent By</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Company</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Contact Name</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Type</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Sum Total</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">MRC</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">OTC</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">MRC Sales</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">OTC Sales</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr style="background-color: #fff;" align="left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="padding: 3px; color: black;">{{ $detail->name }}</td>
                                                <td style="padding: 3px; color: black;">{{ $detail->company_name }}</td>
                                                <td style="padding: 3px; color: black;">{{ $detail->contact_name }}
                                                </td>
                                                <td style="padding: 3px; color: black;">{{ $detail->service_type }}
                                                </td>
                                                <td style="padding: 3px; color: black;">{{ $detail->address }}</td>
                                                <td style="padding: 3px; color: black;">{{ $detail->date }}</td>
                                                <td style="padding: 3px; color: black;">
                                                    ₦{{ number_format($detail->quote_amount) }}</td>
                                                <td style="padding: 3px; color: black;">
                                                    ₦{{ number_format($detail->MRC) }}</td>
                                                <td style="padding: 3px; color: black;">
                                                    ₦{{ number_format($detail->OTC) }}</td>
                                                <td style="padding: 3px; color: black;">
                                                    ₦{{ number_format($detail->MRC_sales) }}</td>
                                                <td style="padding: 3px; color: black;">
                                                    ₦{{ number_format($detail->OTC_sales) }}</td>
                                                <td style="padding: 3px; color: black;">{{ $detail->comment }}</td>
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
    </div>

    {{-- Generic Script --}}
    @include('user.human_resource.script')
</body>

</html>

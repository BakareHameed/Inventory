@extends('user.human_resource.index')
@section('page')
    <div class="container text-center text-black mt-3">
        <h1 style="font-size:25px">Sales Performance Metrics</h1>
    </div>
    <div class="container mb-2 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Monthly Sales Data For {{ $year }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    {{-- <th>Email</th> --}}
                                    <th>January</th>
                                    <th>February</th>
                                    <th>March</th>
                                    <th>April</th>
                                    <th>May</th>
                                    <th>June</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>September</th>
                                    <th>October</th>
                                    <th>November</th>
                                    <th>December</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlySales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->name }}</td>
                                        <td> ₦ {{ number_format($sale->January) }}</td>
                                        <td>₦ {{ number_format($sale->February) }}</td>
                                        <td>₦ {{ number_format($sale->March) }}</td>
                                        <td>₦ {{ number_format($sale->April) }}</td>
                                        <td>₦ {{ number_format($sale->May) }}</td>
                                        <td>₦ {{ number_format($sale->June) }}</td>
                                        <td>₦ {{ number_format($sale->July) }}</td>
                                        <td>₦ {{ number_format($sale->August) }}</td>
                                        <td>₦ {{ number_format($sale->September) }}</td>
                                        <td>₦ {{ number_format($sale->October) }}</td>
                                        <td>₦ {{ number_format($sale->November) }}</td>
                                        <td>₦ {{ number_format($sale->December) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-2 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sales Summary Data For {{ $year }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sales Peronnell</th>
                                    <th>Total Sales</th>
                                    <th>Average Sales</th>
                                    <th>Max Sale Month</th>
                                    <th>Zero Sales Month</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $userData)
                                    <tr>
                                        <td>{{ $userData['name'] }}</td>
                                        <td>₦ {{ number_format($userData['total_sales']) }}</td>
                                        <td>₦ {{ number_format($userData['average_sales']) }}</td>
                                        <td>₦
                                            {{ number_format($userData['max_sale_amount']) }} in
                                            {{ $userData['max_sale_month'] }}
                                        </td>
                                        <td>{{ $userData['zero_sales_month'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.human_resource.sales-performance.script')

    <div class="container">
        <div class="row">
            @foreach ($chartData as $userData)
                <div class="col-md-12">
                    {{-- <div id="chart-container-{{ $userData['user_id'] }}" style="width: 100%; height: 400px;"></div> --}}

                    <div id="chart-container-{{ $userData['user_id'] }}" style="width: 100%; height: 400px;"></div>
                    <div id="tooltip"
                        style="position: absolute; background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: none;">
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                {{-- <div id="chart-container-{{ $userData['user_id'] }}" style="width: 100%; height: 400px;"></div> --}}

                <div id="team_chart" style="width: 100%; height: 400px;"></div>
                <div id="tooltip"
                    style="position: absolute; background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: none;">
                </div>

            </div>
        </div>
    </div>

    <div class="container mb-2 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Collective Team Performance Data For {{ $year }}</div>
                    <div class="card-body">
                        <div id="piechart" style="width: 100%; height: 400px;"></div>
                        <div id="tooltip"
                            style="position: absolute; background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Additional HTML or scripts as needed -->

<!DOCTYPE html>
<html lang="en">
@include('user.human_resource.head')

<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.human_resource.header')
    @include('sweetalert::alert')

    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
        <span>
            <h2>Get Report:</h2>
            <form class="main-form" action="{{ url('sales_personnel_reporting_HR') }}" method="GET"
                enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="form-group name1 col-md-6">
                            <label for="exampleInputEmail1" class="formText">From:*</label>
                            <input type="date" class="form-control rounded-md border-gray-100 shadow-sm"
                                name="dateS" aria-describedby="emailHelp" name="muverName">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText">To:*</label>
                            <input type="date" class="form-control rounded-md border-gray-100 shadow-sm"
                                name="dateE" aria-describedby="emailHelp" name="muverPhone">
                        </div>
                    </div>
                    <button class="btn btn-outline-success" type="submit">Get</button>
                </div>

            </form>
        </span>
    </div>

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:30px">Sales Metrics Table for
                {{ Carbon\Carbon::parse($currentMonth)->format('D, M j, Y') }}
            </h1>
        </div>
    </div>
    <div class="container" style="padding-top: 5px;">
        <div class="row ml-2">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-lg-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    <a href="{{ route('quotations.sent') }}" style="text-decoration: none">
                                        Sent Quotations
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Total Sent = {{ $quoteSent }} <br>
                                    Sum = ₦ {{ number_format($quoteSentSum) }} <br>
                                    MRC = ₦ {{ number_format($quoteSentMRC) }} <br>
                                    OTC = ₦ {{ number_format($quoteSentOTC) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    <a href="{{ route('quotations.pending') }}" style="text-decoration: none">
                                        Pending Quotations
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Total Pending = {{ $quotePending }} <br>
                                    Sum = ₦ {{ number_format($quotePendingSum) }} <br>
                                    MRC = ₦ {{ number_format($quotePendingMRC) }} <br>
                                    OTC = ₦ {{ number_format($quotePendingOTC) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    <a href="{{ route('sales.made') }}" style="text-decoration: none">
                                        Sales Made
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Total Sales = {{ $salesMade }} <br>
                                    Sum = ₦ {{ number_format($salesMadeSum) }} <br>
                                    MRC = ₦ {{ number_format($salesMadeMRC) }} <br>
                                    OTC = ₦ {{ number_format($salesMadeOTC) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    <a href="{{ route('hr.sales.survey.requests') }}" style="text-decoration: none">
                                        Survey Request
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Total Sales = {{ $surveySummary }} <br>
                                    {{-- Sum =  ₦  {{ number_format($salesMadeSum) }} <br>
                      MRC =  ₦  {{ number_format($salesMadeMRC) }} <br>
                      OTC = ₦   {{ number_format($salesMadeOTC) }} --}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div align="center" style="padding-right:30px;padding-top:30px">
            <div class="flex ml-3  items-center justify-center bg-gray-900 py-0">
                <div class="flex mt-0">
                    <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                        <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                            <div class="">
                                <table class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                        <tr style="background-color:black;">
                                            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Account Owner</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">
                                                Call-Outs</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">No. Of Quotes Sent
                                            </th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">No. Of Sales Made
                                            </th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Total Quotes Amount
                                            </th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Total Sales Amount
                                            </th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Total MRC</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Total OTC</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Target</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Surveys</th>
                                            <th style="padding:5px; font-size: 20px; color: white ;">Clients</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marketers as $key => $marketer)
                                            <tr style="background-color: #fff;" align="left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="padding: 5px; color: black;;text-align:center">
                                                    {{ $marketer->unique('name')->pluck('name')->implode('') }}
                                                </td>
                                                <td style="padding: 3px; color: black;text-align:center">
                                                    {{ $marketer->unique('call_out')->pluck('call_out')->implode(' ') }}
                                                    <a class="btn btn-primary" style="background: purple"
                                                        href="{{ url('call_out_info_HR', ['id' => $marketer->unique('id')->pluck('id')->implode('')]) }}">Details</a>
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    {{ $marketer->unique('quote')->pluck('quote')->implode('') }} <br>
                                                    <a class="btn btn-primary" style="background: purple"
                                                        href="{{ route('quote.per.marketer', ['id' => $marketer->unique('id')->pluck('id')->implode('')]) }}">View</a>
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    {{ $marketer->unique('sales')->pluck('sales')->implode('') }} <br>
                                                    <a class="btn btn-primary" style="background: purple"
                                                        href="{{ route('sales.per.marketer', ['id' => $marketer->unique('id')->pluck('id')->implode('')]) }}">View</a>
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    ₦
                                                    {{ $marketer->unique('quote_amount')->pluck('quote_amount')->implode('') }}
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    ₦
                                                    {{ $marketer->unique('sales_amount')->pluck('sales_amount')->implode('') }}
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    ₦ {{ $marketer->unique('MRC')->pluck('MRC')->implode('') }}
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    ₦ {{ $marketer->unique('OTC')->pluck('OTC')->implode('') }}
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    ₦ {{ $marketer->unique('target')->pluck('target')->implode('') }}
                                                    <a class="btn btn-info" style="background: purple" class="btn"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#salesTargetForm{{ $marketer->unique('id')->pluck('id')->implode('') }}">
                                                        Target
                                                    </a>
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    {{ $marketer->unique('surveys')->pluck('surveys')->implode('') }}
                                                    <a class="btn btn-info" style="background: purple"
                                                        href="{{ route('marketer.survey.details', ['id' => $marketer->unique('id')->pluck('id')->implode('')]) }}">
                                                        Survey
                                                    </a>
                                                </td>
                                                <td style="padding: 3px; color: black;;text-align:center">
                                                    {{ $marketer->unique('clients')->pluck('clients')->implode('') }}
                                                    <a class="btn btn-primary" style="background: brown"
                                                        href="{{ url('marketers_clients_HR', ['id' => $marketer->unique('id')->pluck('id')->implode('')]) }}">View</a>
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
        <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
            <div id="chart_div" style="width: 70rem; height: 41rem;"></div>
        </div>

        <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
            <div id="sales" style="width: 70rem; height: 41rem;"></div>
        </div>

        <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
            <div id="surveys" style="width: 70rem; height: 41rem;"></div>
        </div>
    </div>
    </div>
</body>

</html>

{{-- Actual Target Form  --}}
@foreach ($marketers as $personnell)
    @include('user.human_resource.sales-performance.form.actual-target')
@endforeach
{{-- Actual Target Form  --}}

{{-- Generic Script --}}
@include('user.human_resource.script')
<!-- For Column Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Account Manager', 'No. of Call-Outs', 'No. of Quotes', 'No. of Sales'],
            <?php echo $chartdata; ?>
        ]);

        var options = {
            chart: {
                title: 'Monthly Sales Metrics Graph',
                subtitle: 'Sales Performance',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
                x: {
                    0: {
                        side: 'bottom',
                        label: 'Month'
                    } // Top x-axis.
                }
            },
            bar: {
                groupWidth: "40%"
            },
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Account Manager', 'Call-Outs', 'Quote Amount', 'Sales Amount'],

            <?php echo $sales; ?>

        ]);

        var options = {
            chart: {
                title: 'Sales Performance',
                subtitle: 'Monthly Sales Metrics Graph',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
                x: {
                    0: {
                        side: 'bottom',
                        label: 'Account Managers'
                    } // Top x-axis.
                }
            },
            bar: {
                groupWidth: "40%"
            },
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('sales'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Account Owner', 'No. Surveys'],

            <?php echo $s_graph; ?>

        ]);


        var options = {
            chart: {
                title: 'Survey Performance Graph',
                subtitle: 'Monthly Surveys Done',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
                x: {
                    0: {
                        side: 'bottom',
                        label: 'Account Managers'
                    } // Top x-axis.
                }
            },
            bar: {
                groupWidth: "40%"
            },
        };

        // Instantiate and draw our chart, passing in some options.

        var chart = new google.charts.Bar(document.getElementById('surveys'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

{{-- Beginning of Numeric  --}}
<script>
    // Jquery Dependency
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }

        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "₦  " + left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "₦  " + input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>

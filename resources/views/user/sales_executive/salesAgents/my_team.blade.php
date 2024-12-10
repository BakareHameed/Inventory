<!DOCTYPE html>
<html lang="en">


@include('user.sales_executive.head')
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
    @include('user.sales_executive.header')

    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
        <span>
            
        <h2>Get call out:</h2>
        <form class="main-form" action="{{url('my_sales_team_reporting')}}" method="GET" enctype="multipart/form-data">
        @csrf
                <div class="container">
                <div class="row">
                    <div class="form-group name1 col-md-6">
                        <label for="exampleInputEmail1" class="formText">From:*</label>
                        <input  type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText">To:*</label>
                        <input   type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                    </div>
                </div>  
                <button class="btn btn-outline-success" type="submit">Get</button>
            </div>   
            
        </form>

    </span>
    </div>
    


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:30px">
        {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}} 
        Sales Agents Statistics
      </h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">

      <div class="row">
            
      <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
    
		<table border=1>
			<tr style="background-color:black;">
                <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Account Manager</th>
                <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Call-Outs</th>
                <!-- <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Surveys</th>       -->
                <th style="padding:5px; font-size: 20px; color: white ;">No. Of Quotes Sent</th>
                <th style="padding:5px; font-size: 20px; color: white ;">No. Of Sales Made</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Total Quotes Amount</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Total Sales Amount</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Total MRC</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Total OTC</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Call-Out Details</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Surveys</th>
                <th style="padding:5px; font-size: 20px; color: white ;">Clients</th>
            </tr>
      
			@foreach($salesAgent as $salesAgent)
			<tr style="background-color: skyblue;" align="left">
                <td>{{$loop->iteration}}</td>
                <td style="padding: 5px; color: black;">{{$salesAgent->name}}</td>
                <td style="padding: 3px; color: black;">{{$salesAgent->call_out}}</td>
                <td style="padding: 3px; color: black;">{{$salesAgent->quote}}</td>
                <td style="padding: 3px; color: black;">{{$salesAgent->sales}}</td>
                <td style="padding: 3px; color: black;" >₦{{number_format($salesAgent->quote_amount)}}</td>
                <td style="padding: 3px; color: black;" >₦{{number_format($salesAgent->sales_amount)}}</td>
                <td style="padding: 3px; color: black;" >₦{{number_format($salesAgent->MRC)}}</td>
                <td style="padding: 3px; color: black;" >₦{{number_format($salesAgent->OTC)}}</td>   
                <td style="padding: 3px; color: black;" >
                <a class="btn btn-primary" style ="Background-color:#630d34;font-family:Lorem ipsum dolor sit amet;font-size:20px" href="{{url('call_out_info_SA',$salesAgent->id)}}">Details</a>
                </td>
                <td style="padding: 3px; color: black;" >
                <a class="btn btn-info" style ="Background-color:#340d63;font-family:Lorem ipsum dolor sit amet;font-size:20px" href="{{url('Sales_Agent_surveys',$salesAgent->id)}}">View</a>
                </td>
                <td style="padding: 3px; color: black;" >
                <a class="btn btn-primary" style ="Background-color:#098555;font-family:Lorem ipsum dolor sit amet;font-size:20px"  href="{{url('marketers_clients_HR',$salesAgent->id)}}">View</a>
                </td>
            </tr>
			@endforeach

        <!-- //
                </table>      	
            </div>
                <body>
                <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
                <div id="chart_div" style="width: 70rem; height: 41rem;"></div>
                </div>
            </body>
            </body>
                
                
                    <body>
                <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
                <div id="sales" style="width: 70rem; height: 41rem;"></div>
                </div>
            </body>  
            
            <body>
                <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
                <div id="surveys" style="width: 70rem; height: 41rem;"></div>
                </div>
            </body>
        -->

      </div>

</body>
</html>
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<!-- @push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Account Manager', 'No. of Call-Outs', 'No. of Quotes', 'No. of Sales'],
            
            
          
        
            ]);


            var options = {
            chart: {
                title:  'Monthly Sales Metrics Graph',
                subtitle:'Monthly Sales Metrics Graph',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
                x: {
                0: { side: 'bottom', label: 'Account Managers'} // Top x-axis.
                }
            },
            bar: { groupWidth: "40%" },
            };

            // Instantiate and draw our chart, passing in some options.
        
            var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Manager', 'No. of Call-Outs', 'Quote Amount', 'Sales Amount'],
            
            
        
        ]);


        var options = {
            chart: {
            title: 'Sales Performance Graph',
            subtitle: 'Monthly Sales Performance',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
            x: {
                0: { side: 'bottom', label: 'Account Managers'} // Top x-axis.
            }
            },
            bar: { groupWidth: "40%" },
        };

            // Instantiate and draw our chart, passing in some options.

            var chart = new google.charts.Bar(document.getElementById('sales'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
            }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Account Owner', 'No. Surveys'],
            
          
        
        ]);


        var options = {
            chart: {
            title: 'Survey Performance Graph',
            subtitle: 'Monthly Surveys Done',
            },
            bar: 'vertical', // Required for Material Bar Charts.
            axes: {
            x: {
                0: { side: 'bottom', label: 'Account Managers'} // Top x-axis.
            }
            },
            bar: { groupWidth: "40%" },
        };

            // Instantiate and draw our chart, passing in some options.

            var chart = new google.charts.Bar(document.getElementById('surveys'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endpush -->
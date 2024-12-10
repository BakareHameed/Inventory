<!DOCTYPE html>
<html lang="en">
  @include('user.human_resource.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.human_resource.header')
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <span>
        <h2>Get Report:</h2>
        <form class="main-form" action="{{url('sales_personnel_reporting_HR')}}" method="GET" enctype="multipart/form-data">
          @csrf
            <div class="container">
              <div class="row">
                  <div class="form-group name1 col-md-6">
                      <label for="exampleInputEmail1" class="formText">From:*</label>
                      <input  type="date" class="form-control rounded-md border-gray-100 shadow-sm" name="dateS"  aria-describedby="emailHelp" name="muverName">
                  </div>

                  <div class="form-group name2 col-md-6">
                      <label for="exampleInputEmail1## Heading ##" class="formText">To:*</label>
                      <input   type="date" class="form-control rounded-md border-gray-100 shadow-sm" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                  </div>
              </div>  
              <button class="btn btn-outline-success" type="submit">Get</button>
            </div>   
        
        </form>
      </span>
    </div>

    <div align="Center" style="padding:0px">
      <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:30px">Sales Metrics Table  
          from 
          {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
            To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
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
                      <a href="{{ route('quotations.sent.reporting',['dateS'=>$dateS,'dateE'=>$dateE]) }}" style="text-decoration: none">
                        Sent Quotations
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      Total Sent = {{$quoteSent}} <br>
                      Sum =  ₦  {{ number_format($quoteSentSum) }} <br>
                      MRC =  ₦  {{ number_format($quoteSentMRC) }} <br>
                      OTC = ₦   {{ number_format($quoteSentOTC) }}
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
                      <a href="{{ route('quotations.pending.reporting',['dateS'=>$dateS,'dateE'=>$dateE]) }}" style="text-decoration: none">
                        Pending Quotations
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      Total Pending = {{$quotePending}} <br>
                      Sum =  ₦  {{ number_format($quotePendingSum) }} <br>
                      MRC =  ₦  {{ number_format($quotePendingMRC) }} <br>
                      OTC = ₦   {{ number_format($quotePendingOTC) }}
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
                      <a href="{{ route('sales.made.reporting',['dateS'=>$dateS,'dateE'=>$dateE]) }}" style="text-decoration: none">
                        Sales Made
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      Total Sales = {{$salesMade}} <br>
                      Sum =  ₦  {{ number_format($salesMadeSum) }} <br>
                      MRC =  ₦  {{ number_format($salesMadeMRC) }} <br>
                      OTC = ₦   {{ number_format($salesMadeOTC) }}
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
                      <a href="{{ route('hr.sales.survey.requests.query',['dateS'=>$dateS,'dateE'=>$dateE]) }}" style="text-decoration: none">
                        Survey Request
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      Total Sales = {{$surveySummary}} <br>
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


        <div align="left" style="padding-right:30px;padding-top:30px">
          <div  class="flex ml-3  items-center justify-center bg-gray-900 py-0" >
            <div class="flex mt-0">
                <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                    <div class="py-0 align-middle inline-block  sm:px-6 lg:px-8">
                        <div class="">
                            <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                  <tr style="background-color:black;">
                                    <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Account Owner</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Call-Outs</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">No. Of Quotes Sent</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">No. Of Sales Made</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Total Quotes Amount</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Total Sales Amount</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Total MRC</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Total OTC</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Surveys</th>
                                    <th style="padding:5px; font-size: 20px; color: white ;">Clients</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($marketers as $key=>$marketer)
                                    <tr style="background-color: #fff;"  align="left">
                                      <td>{{$loop->iteration}}</td>
                                      <td style="padding: 5px; color: black;;text-align:center">
                                        {{$marketer->unique('name') ->pluck('name')->implode('')}}
                                      </td>
                                      <td style="padding: 3px; color: black;text-align:center">
                                        {{$marketer->unique('call_out') ->pluck('call_out')->implode(' ')}}
                                        <a class="btn btn-primary" style="background: purple" href="{{url('call_out_reporting_HR',['id'=>$marketer->unique('id') ->pluck('id')->implode(''),'dateS'=>$dateS,'dateE'=>$dateE])}}">Details</a>
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center">
                                        {{$marketer->unique('quote') ->pluck('quote')->implode('')}} <br>
                                        <a class="btn btn-primary" style="background: purple" href="{{route('quote.per.marketer.reporting',['id'=>$marketer->unique('id') ->pluck('id')->implode(''),'dateS'=>$dateS,'dateE'=>$dateE])}}">View</a>
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center">
                                        {{$marketer->unique('sales') ->pluck('sales')->implode('')}} <br>
                                        <a class="btn btn-primary" style="background: purple" href="{{route('sales.per.marketer.reporting',['id'=>$marketer->unique('id') ->pluck('id')->implode(''),'dateS'=>$dateS,'dateE'=>$dateE])}}">View</a>
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        ₦ {{$marketer->unique('quote_amount') ->pluck('quote_amount')->implode('')}}
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        ₦ {{$marketer->unique('sales_amount') ->pluck('sales_amount')->implode('')}}
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        ₦ {{$marketer->unique('MRC') ->pluck('MRC')->implode('')}}
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        ₦ {{$marketer->unique('OTC') ->pluck('OTC')->implode('')}}
                                      </td>   
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        {{$marketer->unique('surveys') ->pluck('surveys')->implode('')}}
                                        <a class="btn btn-info" style="background: purple" href="{{route('marketer.survey.details.reporting',['id'=>$marketer->unique('id') ->pluck('id')->implode(''),'dateS'=>$dateS,'dateE'=>$dateE])}}">
                                          Survey
                                        </a>
                                      </td>
                                      <td style="padding: 3px; color: black;;text-align:center" >
                                        {{$marketer->unique('clients') ->pluck('clients')->implode('')}}
                                        <a class="btn btn-primary" style="background: brown" href="{{url('marketer.client.details.reporting',['id'=>$marketer->unique('id') ->pluck('id')->implode(''),'dateS'=>$dateS,'dateE'=>$dateE])}}">View</a>
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
 
{{-- Generic Script --}}
@include('user.human_resource.script')
<!-- For Column Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Account Manager', 'No. of Call-Outs', 'No. of Quotes', 'No. of Sales'],
      <?php echo $chartdata;?>
    ]);

    var options = {
      chart: {
        title: 
        'Monthly Sales Metrics Graph',
        subtitle: 'Sales Performance',
      },
      bar: 'vertical', // Required for Material Bar Charts.
      axes: {
        x: {
          0: { side: 'bottom', label: 'Month'} // Top x-axis.
        }
      },
      bar: { groupWidth: "40%" },
    };

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_div'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Account Manager', 'Call-Outs', 'Quote Amount', 'Sales Amount'],
      
      
      <?php echo $sales;?>
    
    ]);


    var options = {
      chart: {
        title: 'Sales Performance',
        subtitle: 'Monthly Sales Metrics Graph',
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
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Account Owner', 'No. Surveys'],
      
      <?php echo $s_graph;?>
    
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

 
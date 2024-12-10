<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">


     <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <style>
thead {color: green;}
tbody {color: blue;}
tfoot {color: red;}

table, th, td {
  border: 1px solid black;
}
</style>


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


<!-- Amount Charts -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Manager', 'No. of Call-Outs', 'Quote Amount', 'Sales Amount'],
         
          <?php echo $sales;?>
       
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





</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Engineers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>

            

            <li class="nav-item nav-settings d-none d-lg-block">

<div class="dropdown">
<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Other Info.
<span class="caret"></span></button>
<ul class="dropdown-menu">

<li class="dropdown-submenu">
<a class="test" href="#">Sales Report<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="{{url('sales_personnel')}}">Sales Metrics</a></li>
<!-- <li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li> -->

</ul>
</li>

<li class="dropdown-submenu">

<a class="test" href="#">Survey<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a class="dropdown-item"  href="{{url('delivery_table')}}">Pending Survey</a></li>
<li><a class="dropdown-item" href="{{url('assigned_survey')}}">Assigned Client Survey</a></li>
<li><a class="dropdown-item" href="{{url('all_survey_report')}}">All Survey Report</a></li>
<li><a class="dropdown-item" href="{{url('all_customers')}}">All Customers</a></li>
</ul>
</li>

<li class="dropdown-submenu">
<a class="test" href="#">Finance Details<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a class="dropdown-item"  href="{{url('pending_client')}}">Pending Client</a></li>
<li><a class="dropdown-item" href="{{url('new_sales')}}">New Sales</a></li>
<li><a class="dropdown-item" href="{{url('all_clients')}}">All Clients Information</a></li>
</ul>
</li>

<li class="dropdown-submenu">
<a class="test" href="#">Network Ops.<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="{{url('ready_integration')}}">Ready Integration</a></li>
    <li><a class="dropdown-item"  href="{{url('integrated_customers')}}">All Integrated Customers</a></li>
</ul>
</li>


<li class="dropdown-submenu">
<a class="test" href="#">Service<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="{{url('ready_links')}}">Links Ready for Deployment</a></li>
<li><a class="dropdown-item"  href="{{url('linked_customers')}}">All Deployed Links</a></li>

</ul>
</li>


<!-- <li><a tabindex="-1" href="#">CSS</a></li>
<li class="dropdown-submenu">
<a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a tabindex="-1" href="#">2nd level dropdown</a></li>
<li><a tabindex="-1" href="#">2nd level dropdown</a></li>
<li class="dropdown-submenu">
<a class="test" href="#">Another dropdown <span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="#">3rd level dropdown</a></li>
<li><a href="#">3rd level dropdown</a></li>
</ul>
</li>
</ul>
</li> -->


</ul>


                </ul>
              </div>
          </li>
            <x-app-layout> 
              





        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>


  <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
    <span>
        
    <h2>Get call out:</h2>
    <form class="main-form" action="{{url('sales_personnel_reporting')}}" method="GET" enctype="multipart/form-data">

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
        <h1 class="text-center" style="text-align:center;font-size:30px">MONTHLY SALES METRICS</h1>
    </div>
</div>

<div class="container" align="text-center" style="padding-top: 5px;">


@if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

<div class="row">
@foreach($surveys as $surveys) 
  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
    <div class="card"> 
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">

        
              <h1 style="font-size:20px" class="mb-0">
        
              {{$surveys->name}} 
      
              </h1>
      
              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="font-weight-normal" style="font-size:20px; color:blue">Total Surveys = {{$surveys->surveys}}</h6>
      </div>
    </div>
  </div>
@endforeach

      <div align="left" style="padding-left:30px;padding-top:30px;padding-bottom:30px">
    
		<table border=1>
			
			<tr style="background-color:black;">
				<th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
				<th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Account Manager</th>
        <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Call-Outs</th>
				<!-- <th style="padding:5px; font-size: 20px; color: white ;">Email</th> -->
        <th style="padding:5px; font-size: 20px; color: white ;">No. Of Quotes Sent</th>
        <th style="padding:5px; font-size: 20px; color: white ;">No. Of Sales Made</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Total Quotes Amount</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Total Sales Amount</th>
        <th style="padding:5px; font-size: 20px; color: white ;">Call-Out Details</th>
        
       

			@foreach($marketer as $marketers)

			<tr style="background-color: skyblue;" align="left">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 5px; color: black;">{{$marketers->name}}</td>
				<td style="padding: 3px; color: black;">{{$marketers->call_out}}</td>
        <td style="padding: 3px; color: black;">{{$marketers->quote}}</td>
        <td style="padding: 3px; color: black;">{{$marketers->sales}}</td>
			
        <td style="padding: 3px; color: black;" >₦{{number_format($marketers->quote_amount)}}</td>
 
        <td style="padding: 3px; color: black;" >₦{{number_format($marketers->sales_amount)}}</td>
     
      <td style="padding: 3px; color: black;" >
         <a class="btn btn-primary" href="{{url('call_out_info',$marketers->id)}}">Details</a>
        </td>
     
   
        
       
			@endforeach


		</table>      	
    </div>
		<body>
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


      </div>
</x-app-layout> 


      <script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

  

   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
  @include('user.sales_executive.head')
  <body>
    @include('sweetalert::alert')

    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.sales_executive.header')
    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
      <span>
        <h2 style="font-size:20px;font-weight:500" class="mt-3">Get Call-Out Between:</h2>
        <form class="main-form" action="{{url('call_out_report')}}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group name1 col-md-6">
                        <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                        <input style="background-color:white" type="date" class="form-control shadow-md border-gray-300 rounded-md" name="dateS"  aria-describedby="emailHelp" name="muverName">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                        <input style="background-color:white"  type="date" class="form-control  shadow-md border-gray-300 rounded-md" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
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
          My Call-Outs for  {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}} 
        </h1>
      </div>
    </div>

    <div class="container" align="text-center" style="padding-top: 5px;">
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-left">
                <div class="col mr-2">
                  <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total Count</div>
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
      <div align="center" class="container">
      <table >
        <thead>
          <tr style="background-color:black;">
            <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Company</th>
            <th style="padding:5px; font-size: 20px; color: white ;text-alignment:left">Contact Name</th>
            <!-- <th style="padding:5px; font-size: 20px; color: white ;">Email</th> -->
            <th style="padding:5px; font-size: 20px; color: white ;">Contact Number</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Location</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Any Quote?</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Quote Amount</th>
            <th style="padding:5px; font-size: 20px; color: white ;">MRC(quotes)</th>
            <th style="padding:5px; font-size: 20px; color: white ;">OTC(quotes)</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Any Sale?</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Sales Amount</th>
            <th style="padding:5px; font-size: 20px; color: white ;">MRC(sales)</th>
            <th style="padding:5px; font-size: 20px; color: white ;">OTC(sales)</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Comment</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Edit</th>
            <th style="padding:5px; font-size: 20px; color: white ;">Delete</th>
          </tr>
        </thead>
    
        @foreach($sales as $sale)
          <tbody>
            <tr style="background-color: white;" align="left">
              <td style="padding: 5px; color: black;">{{$loop->iteration}}</td>
              <td style="padding: 3px; color: black;">{{$sale->company_name}}</td>
              <td style="padding: 3px; color: black;">{{$sale->contact_name}}</td>
              <td style="padding: 3px; color: black;">{{$sale->contact_number}}</td>
              <td style="padding: 3px; color: black;">{{$sale->location}}</td>
              <td style="padding: 3px; color: black;">{{$sale->address}}</td>
              <td style="padding: 3px; color: black;">{{$sale->date}}</td>
              <td style="padding: 3px; color: black;">{{$sale->quote}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->quote_amount)}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->MRC)}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->OTC)}}</td>
              <td style="padding: 3px; color: black;">{{$sale->sales}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->sales_amount)}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->MRC_sales)}}</td>
              <td style="padding: 3px; color: black;" >₦{{number_format($sale->OTC_sales)}}</td>
              <td style="padding: 3px; color: black;" >{{$sale->comment}}</td>
              <td style="padding: 3px; color: black;" >
                <a style="padding: 10px 15px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#edit-CallOut{{$sale->id}}">Edit</a> 
              </td>
              <td style="padding: 3px; color: black;" >
                  <a style="padding: 10px;margin-bottom:5px" class="btn btn-danger" href="{{url('delete_call_out',$sale->id)}}">Delete</a><span>
              </td>
            </tr>
          </tbody>
        @endforeach
      </table>      	
    </div>

    @foreach($sales as $data)
      @include('user.sales_executive.call-outs.edit-form')
    @endforeach

    {{-- Generic Scripts Begins --}}
      <script src="{{asset('../assets/js/jquery-3.5.1.min.js')}}"></script>
      <script src="{{asset('../assets/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('../assets/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('../assets/vendor/wow/wow.min.js')}}"></script>
      <script src="{{asset('../assets/js/theme.js')}}"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Generic Scripts Begins --}}

    {{-- Show/Hide Form Scripts --}}
      <script type="text/javascript">
        function yesnoCheck(that,id) {
          if (that.value == "Yes") {
              document.getElementById("ifYes"+id).style.display = "block";
              document.getElementById("MTC_sales_Yes"+id).style.display = "block";
              document.getElementById("Service"+id).style.display = "block";
          } else {
              document.getElementById("ifYes"+id).style.display = "none";
              document.getElementById("MTC_sales_Yes"+id).style.display = "none";
              document.getElementById("Service"+id).style.display = "none";
          }
        }
      </script>
      
      <script type="text/javascript">
        function QuoteCheck(that,id) {
          if (that.value == "Yes") {
              document.getElementById("ifQuoteYes"+id).style.display = "block";
              document.getElementById("MTCYes"+id).style.display = "block";
          } else {
              document.getElementById("ifQuoteYes"+id).style.display = "none";
              document.getElementById("MTCYes"+id).style.display = "none";
          }
        }
      </script>
      
      <script type="text/javascript">
        function planCheck(that,id) {
          if (that.value == "Shared") {
              document.getElementById("Shared"+id).style.display = "block";
              document.getElementById("Dedicated"+id).style.display = "none";
          } 
          else if (that.value == "Dedicated") {
              document.getElementById("Dedicated"+id).style.display = "block";
              document.getElementById("Shared"+id).style.display = "none";
          }
          else {
                document.getElementById("Shared"+id).style.display = "none";
                document.getElementById("Dedicated"+id).style.display = "none";
          }
        }
      </script>
    {{-- Show/Hide Form Scripts --}}
  </body>
</html>
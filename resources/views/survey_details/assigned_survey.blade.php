<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

  <script src="http://10.0.0.244:8081/js/app.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
    <style>
      thead {color: black;}
      tbody {color: blue;}
      tfoot {color: red;}
      table, th, td {
        border: 1px solid black;
        border-radius: 2px;
      }
      .flex{
        margin-left:1%;
        margin-top: auto%;
        margin-right:4%;
      }
      
    </style>

    <!-- Css for autonumbering the dynamically added row in modal -->
    <style>
        #tb2 {
            counter-reset: rowNumber-1;
        }

        #tb2 tr {
            counter-increment: rowNumber;
        }

        #tb2 tr td:first-child::before {
            content: counter(rowNumber);

        }
    </style>
    <!-- End of auto numbering css -->
</head>
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  <!-- Delivery Header -->
   @include('user.delivery_engineer.header')
  <!-- Delivery Header -->

<!-- Modal for Form -->
  @foreach($appointments as $client)
      @include('survey_details.new_form')
  @endforeach

  @foreach($appointments as $client)
      @include('user.field_engineer.surveys.report_view')
  @endforeach
<!--End of Modal for Form -->
 
  <div align="Center" style="padding:0px">
      <div class="col-lg-6 py-3 wow fadeInUp text-center" >
      @if(Session::has('message'))
          <div class="col-12 col-sm-6 py-3 pt-4 alert alert-success" align="center" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
      @endif
          <h1 class="text-center" style="text-align:center;font-size:40px;" >Assigned Survey Table</h1>
      </div>
  </div>

  <div align="Center" style="padding-left:10px;padding-bottom:30px;margin:15px;">
		<table style="border-radius:10px;">
			<tr style="background-color:black;">
          <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Message</th>
          <th style="padding:10px; font-size: 20px; color: white ;"> Assigned Engr</th>
          <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
      </tr>
			@foreach($appointments as $appointment)
        <tr style="background-color: white;" align="center">
            <td style="padding: 10px; color: black;">{{$appointment->id}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->clients}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->contact_person_name}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->customer_email}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->phone}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->address}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->date}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->service_plan}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->service_type}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>
            <td style="padding: 10px; color: black;">{{$appointment->message}}</td>
            @if ($appointment->third_assigned_engr !== null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null)
              <td style="padding: 10px; color: black;">{{$appointment->third_assigned_engr}}</td>
            @elseif ($appointment->third_assigned_engr == null && $appointment->second_assigned_engr !== null && $appointment->first_assigned_engr !== null )
                <td style="padding: 10px; color: black;">{{$appointment->second_assigned_engr}}</td>
            @else
                <td style="padding: 10px; color: black;">{{$appointment->first_assigned_engr}}</td>
            @endif
            @if($appointment->engr_name != null)
              <td><a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#View{{$appointment->id}}">View Report</a></td>
            @else
              <td style="padding: 10px; color: black;">Yet to be reported</td>
            @endif
          </tr>
			@endforeach
		</table>   
  </div>
</body>
</html>

<!-- Beginning of all Scripts -->
  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- Beginning of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- End of required script for Modal -->

  <!-- Beginning of Scripts for adding and subtraction of rows -->
      <script type="text/javascript">

          $('.addRow').on('click',function(){
            
              addRow();
          });

          function addRow(){
              var tr = '<tr>'+
                          '<td></td>'+
                          '<td><input type="text" name="material[]" class="form-control"/></td>'+
                          '<td><input type="text" name="quantity[]" class="form-control"/></td>'+
                          '<th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>'+
                      '</tr>';
                  $('.materials').append(tr);
                  
          }
          $('.materials').on('click','.removeRow', function(){
                  $(this).parent().parent().remove();
                  findTotal();
          });
      </script>
  <!-- End of scripts for row addition -->

  <!-- Beginning of Script for Feasibility Check -->
    <script type="text/javascript">
        function feasibility(status,client_id){
          if(status == 0 ){
            document.getElementById( client_id).style.display = 'block';
            document.getElementById( "no_fease"+client_id).style.display = 'none';
          }
          else{
            document.getElementById( client_id).style.display = 'none';
            document.getElementById( "no_fease"+client_id).style.display = 'block';
          }
        }
    </script>

<script type="text/javascript">
    function Casting(that,client_id) {
        if((that.value === "Required"))
        {
            document.getElementById("Required"+client_id).style.display = "block";
        }
        else 
        {
            document.getElementById("Required"+client_id).style.display = "none";
        }
    }
</script>
        
  <!-- End of Script for Feasibility Check -->
<!-- End of all Script -->

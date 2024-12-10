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

  <!-- Script for Multi-level dropdown list  -->
  <script>
    $(document).ready(function() {
      $('.dropdown-submenu a.test').on("click", function(e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
      });
    });
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    .dropdown-submenu {
      position: relative;
      background-color: white;
      color: black;
      font-size: 18.5px;
    }

    .dropdown-submenu .dropdown-menu {
      position: absolute;
      top: 50px;
      right: 50px;
      background-color: #f0e9e9;
      color: #f2f7c6;
      font-size: 18.5px;
    }

    .dropdown-item:hover {
      color: black
    }

    .dropdown-submenu :hover {
      color: black;
    }
  </style>
  <!-- End of Styling for multi-level dropdown -->
  <style>
    thead {
      color: green;
    }

    tbody {
      color: blue;
    }

    tfoot {
      color: red;
    }

    table,
    th,
    td {
      border: 1px solid black;
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
  @include('user.field_engineer.header')
  <!-- Back to top button -->
  <div class="back-to-top"></div>


  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center">
      <h1 class="text-center" style="text-align:center;font-size:2rem">
        My Assigned Installations
      </h1>
    </div>
    @if(Session::has('message'))
    <div class="col-12 col-sm-6 py-3 pt-4 alert alert-success" align="center" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
    @endif
  </div>

  @foreach($installations as $client)
  @include('user.field_engineer.installation.job-completion-form')
  @endforeach

  @foreach($reports as $report)
  @include('user.field_engineer.installation.report-view')
  @endforeach


  <div class="container" align="left">
    <div class="row">
      <div class="col-sm-2 col-sm-2 w-screen mb-4 ml-4">
        <div class="card border-left-primary shadow h-100 pt-1 pb-0">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center justify-center w-screen bg-gray-900 py-0">
      <div class="flex flex-col mt-0">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm:rounded-lg">
              <table class="min-w-full text-sm text-gray-400">
                <thead class="bg-gray-800 text-xs uppercase font-medium">
                  <tr style="background-color:black;">
                    <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Contact Person</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Number</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Report</th>
                  </tr>
                </thead>
                <tbody class="bg-gray-800">
                  @php
                  $i = ($installations->currentPage() - 1) * $installations->perPage();
                  @endphp
                  @foreach($installations as $installations)
                  <tr style="background-color: white;" align="center">
                    <td style="padding: 10px; color: black;">{{++$i}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->id}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->clients}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->contact_person_name}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->customer_email}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->phone}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->address}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->service_plan}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->service_type}}</td>
                    <td style="padding: 10px; color: black;">{{$installations->download_bandwidth}}{{$installations->unit}}</td>
                    @if($installations->site_engr!==null)
                    <td>
                      <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#Raise{{$installations->id}}">Report</a>
                    </td>
                    @else
                    <td>
                      <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#View{{$installations->id}}">View</a>
                      <a style="padding: 5px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Edit{{$installations->id}}">Edit</a>
                    </td>
                    @endif
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
    <div>
    </div>


    <!-- Beginning of ALL script -->
    <!-- Generic scripts -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End of generic scripts -->

    <!-- Beginning of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- End of required script for Modal -->

    <!-- Beginning of Scripts for adding and subtraction of rows -->
    <script type="text/javascript">
      $('.addRow').on('click', function() {
        addRow();
      });

      function addRow() {
        var tr = '<tr>' +
          '<td></td>' +
          '<td><input required type="text" name="material[]" class="form-control"/></td>' +
          '<td><input required  type="text" name="qty[]" class="form-control"/></td>' +
          '<td><input required type="text" name="remark[]" class="form-control"/></td>' +
          '<th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>' +
          '</tr>';
        $('.materials').append(tr);
      }
      $('.materials').on('click', '.removeRow', function() {
        $(this).parent().parent().remove();
        findTotal();
      });
    </script>
    <!-- End of scripts for row addition -->

    <!-- Beginning of Script for Feasibility Check -->
    <script type="text/javascript">
      function feasibility(status, client_id) {
        if (status == 0) {
          document.getElementById(client_id).style.display = 'block';
          document.getElementById("no_fease" + client_id).style.display = 'none';
        } else {
          document.getElementById(client_id).style.display = 'none';
          document.getElementById("no_fease" + client_id).style.display = 'block';
        }
      }
    </script>

    <script type="text/javascript">
      function Casting(that, client_id) {
        if ((that.value === "Done")) {
          document.getElementById("Done" + client_id).style.display = "block";
        } else {
          document.getElementById("Done" + client_id).style.display = "none";
        }
      }
    </script>
    <!-- End of Script for Feasibility Check -->

    <!-- Beginning of script for calculation of cable length -->
    <script type="text/javascript">
      function calculate(id) {
        a = parseFloat(document.getElementById("vert_cable_length" + id).value);
        b = parseFloat(document.getElementById("horiz_cable_length" + id).value);
        c = parseFloat(document.getElementById("excess_cable_length" + id).value);
        d = parseFloat(document.getElementById("others" + id).value);
        total = document.getElementById("result" + id)
        if (isNaN(d)) d = 0;
        var sum = Number(a + b + c + d);

        total.value = sum + "m";

        console.log(sum);

      }
    </script>
    <!-- End of Script for  calculation of total cable required -->
</body>

</html>
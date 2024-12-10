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
                <a class="navbar-brand" href="{{ url('/') }}"><span class="text-primary">Syscodes</span>-Comms.</a>

                <form action="{{ url('search') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="doctors.html">Engineers</a>
                        </li>
                        <li class="nav-item">
                            <div class="btn-group" style="background-color: green; color: white;">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Work Order
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('my_assigned_survey') }}">My Surveys</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('my_field_support') }}">My Field Support
                                            Ticket</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"></a></li>
                                </ul>
                            </div>
                        </li>
                        <x-app-layout>
                        </x-app-layout>
                </div> <!-- .navbar-collapse -->
            </div> <!-- .container -->
        </nav>
    </header>



    <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
        <h2 style="font-size:20px">Get Tickets Between:</h2>
        <form class="main-form" action="{{ url('#') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group name1 col-md-6">
                        <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                        <input style="background-color:white" type="date" class="form-control" name="dateS"
                            aria-describedby="emailHelp" name="muverName">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                        <input style="background-color:white" type="date" class="form-control" name="dateE"
                            aria-describedby="emailHelp" name="muverPhone">
                    </div>
                </div>
                <button class="btn btn-outline-success" type="submit">Get</button>
            </div>
        </form>
    </div>


    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                My Work Orders
            </h1>
        </div>
    </div>


    <div class="container" align="text-center" style="padding-top: 5px;margin:15px">
        <div class="row">
            <div class="col-sm-3 col-sm-4  mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }} </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3 col-sm-4  mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Pending</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending }} </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div align="center" style="margin:15px;padding-top:30px">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong>{{ Session::get('message') }}
                </div>
            @endif
            <table border=1 align='center' style= "margin-bottom: 50px;">
                <tr style="background-color:black;">
                    <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                    <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Phone</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Fault</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Type</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Level</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Details</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Raised on</th>
                    <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                </tr>
                @foreach ($tickets as $ticket)
                    <tr style="background-color: white;" align="left">
                        <td style="padding: 5px; color: black;"><strong>{{ $loop->iteration }}</strong></td>
                        <td style="padding: 5px; color: black;">{{ $ticket->client_name }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->client_phone }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->client_email }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->client_address }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->fault }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->fault_type }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->fault_level }}</td>
                        <td style="padding: 5px; color: black;">{{ $ticket->fault_details }}</td>
                        @if ($ticket->status == 'In Progress' || $ticket->status == 'Open')
                            <td style="padding: 5px; color: black; background-color:darkgrey">
                                <strong>{{ $ticket->status }}</strong>
                            </td>
                            <td style="padding: 5px; color: black;">
                                {{ Carbon\Carbon::parse($ticket->start_time)->format('D, M j, Y g:i A') }}</td>
                            <td style="padding: 5px; color: black;">Not Report Yet</td>
                        @elseif($ticket->status == 'Assigned' || $ticket->status == 'Reassigned')
                            <td style="padding: 5px; color: black; background-color:goldenrod">
                                <strong>{{ $ticket->status }}</strong>
                            </td>
                            <td style="padding: 5px; color: black;">
                                {{ Carbon\Carbon::parse($ticket->start_time)->format('D, M j, Y g:i A') }}</td>
                            <td style="padding: 3px; color: black;">
                                <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary"
                                    href="{{ url('engr_ticket_report', $ticket->id) }}">Report</a><span>
                            </td>
                        @elseif($ticket->status == 'Done')
                            <td style="padding: 5px; color: black; background-color:#68edc5">
                                <strong>{{ $ticket->status }}</strong>
                            </td>
                            <td style="padding: 5px; color: black;">
                                {{ Carbon\Carbon::parse($ticket->start_time)->format('D, M j, Y g:i A') }}</td>
                            <td style="padding: 3px; color: black;">
                                Submitted-{{ Carbon\Carbon::parse($ticket->submitted_at)->format('D, M j, Y g:i A') }}
                                <span>By--- {{ $ticket->first_engr }}</span>

                                @if (Auth::user()->role == 'Service Support Engineer' ||
                                        Auth::user()->role == 'Service Support Analyst' ||
                                        Auth::user()->role == 'Delivery Engineer')
                                    <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-primary"
                                        href="{{ url('ticket_report', $ticket->ticket_id) }}">
                                        View
                                    </a>
                                @else
                                    <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-info"
                                        href="{{ url('view_field_report', $ticket->ticket_id) }}">
                                        View
                                    </a>
                                @endif
                                <span>
                            </td>
                        @elseif($ticket->status === 'Closed')
                            <td style="padding: 5px; color: black; background-color:greenyellow">
                                <strong>{{ $ticket->status }}</strong>
                            </td>
                            <td style="padding: 5px; color: black;">
                                {{ Carbon\Carbon::parse($ticket->start_time)->format('D, M j, Y g:i A') }}</td>
                            <td style="padding: 3px; color: black;">
                                <a style="padding: 10pxpx;margin-bottom:5px" class="btn btn-info"
                                    href="{{ url('view_field_report', $ticket->id) }}">View</a><span>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        <div>
        </div>
        @include('user.field_engineer.scripts')

</body>

</html>

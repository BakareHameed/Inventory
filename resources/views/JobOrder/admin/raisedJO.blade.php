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
        thead {
            color: black;
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
            border-radius: 2px;
        }

        .flex {
            margin-left: 1%;
            margin-top: auto%;
            margin-right: 4%;
        }
    </style>
</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.service_engr.header')

    <!-- Modal for Form -->
    @foreach($newClients as $client)
    @include('JobOrder.form')
    @endforeach

    @foreach($newClients as $client)
    @include('JobOrder.serviceOps.comment')
    @endforeach

    @foreach($newClients as $client)
    @include('JobOrder.admin.survey_report_view')
    @endforeach

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                All Pending Job Orders
            </h1>
        </div>
    </div>



    <div class="container" align="left">
        @if(Session::has('message'))
        <div class="col-lg-6 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-2 col-sm-2  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
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
    </div>
    </div>

    <div class="flex flex-col items-center justify-center w-screen bg-white-900 py-0">
        <div class="flex flex-col mt-1">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full text-sm text-gray-400">
                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;">
                                    <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Client_ID</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Phone</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Email</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Plan</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                @php
                                $i = ($newClients->currentPage() - 1) * $newClients->perPage();
                                @endphp
                                @foreach($newClients as $client)
                                <tr style="background-color: white;" align="left">
                                    <td style="padding: 5px; color: blue;"><strong>{{++$i}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->id}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->clients}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->phone}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->customer_email}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->address}}</strong></td>
                                    <td style="padding: 5px; color: black;"><strong>{{$client->service_type}}</strong></td>
                                    @if($client->reviewed_by !=null && $client->approved_by==null)
                                    <td style="padding: 5px; color: black;">
                                        <strong>{{$client->status}}-BY-<em style="color:blue">{{$client->reviewed_by}}<em></strong>
                                    </td>
                                    @elseif($client->reviewed_by !=null && $client->approved_by!=null)
                                    <td style="padding: 5px; color: black;">
                                        <strong>{{$client->status}}-BY-<em style="color:blue">{{$client->reviewed_by}}<em></strong>
                                    </td>
                                    @else
                                    <td style="padding: 5px; color: black;"><strong> Not yet Reviewed</strong></td>
                                    @endif
                                    <td style="padding: 5px; color: black;"><strong> Raised By-<em style="color:blue">
                                                {{$client->raised_by}}<em></strong>
                                        @if($client->edited_by !=null)
                                        <br> <span class="mt-2" style="color: Black;">Edited By-<em style="color:brown">
                                                {{$client->edited_by}}<em></strong></span>
                                        @endif
                                        <a style="padding: 5px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Surveys{{$client->id}}">View Survey</a>
                                        <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#View{{$client->id}}">View Job Order</a><span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                {{ $newClients->links('user.customPagination') }}
                <!-- {{$newClients->links()}} -->
            </div>
        </div>
        <!-- Component End  -->
    </div>
    <div>
    </div>

    <!-- Generic Scipts for all pages -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- End of Generic Scipts for all pages -->

    <!-- Beginning of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Beginning of required script for Modal -->

    <!-- Beginning of script for Approval Form by Admin Manager -->
    <script type="text/javascript">
        function approval_form(client_id) {
            console.log('approval' + client_id);
            var form = document.getElementById("approval" + client_id);
            if (form.style.display === 'none') {
                console.log('display' + client_id);
                form.style.display = 'block';
            } else {
                console.log('none' + client_id);
                form.style.display = 'none';
            }

        }
        const btn = document.getElementsById('btn');

        $(".btn").addEventListener('click', () => {
            const form = document.getElementsById('edit_form');

            if (form.style.display === 'none') {
                // 👇️ this SHOWS the form
                form.style.display = 'block';
            } else {
                // 👇️ this HIDES the form
                form.style.display = 'none';
            }
        });
    </script>
    <!-- End of Script For Approval form -->
</body>

</html>
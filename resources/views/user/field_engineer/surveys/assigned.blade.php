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

    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.field_engineer.header')

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                My Assigned Survey
            </h1>
        </div>
        @if (Session::has('message'))
            <div class="col-12 col-sm-6 py-3 pt-4 alert alert-success" align="center" role="alert">
                <strong>Success:</strong>{{ Session::get('message') }}
            </div>
        @endif
    </div>

    @foreach ($surveys as $client)
        {{-- for Field Engineers --}}
        @include('user.field_engineer.surveys.form')
        {{-- for Fibre Engineers --}}
        @include('user.field_engineer.surveys.fibre-form')
    @endforeach

    @foreach ($surveys as $client)
        @include('user.field_engineer.surveys.report_view')
    @endforeach

    <div class="container" align="left">
        <div class="row">
            <div class="col-sm-2 col-sm-2  mb-4">
                <div class="card border-left-primary shadow h-100 pt-1 pb-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }} </div>
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

    <div style="margin-left:5rem"
        class="flex flex-col  items-center justify-center w-screen min-h-screen bg-gray-900 py-0">
        <div class="flex flex-col mt-0">
            <div class="-my-0 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                    <th style="padding:10px; font-size: 20px; color: white ;">Date</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Plan</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Service Type</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Bandwidth</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Message</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Feasibility</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Survey Report</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                @php
                                    $i = ($surveys->currentPage() - 1) * $surveys->perPage();
                                @endphp
                                @foreach ($surveys as $survey)
                                    <tr style="background-color: white;" align="center">
                                        <td style="padding: 10px; color: black;">{{ ++$i }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->id }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->clients }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->contact_person_name }}
                                        </td>
                                        <td style="padding: 10px; color: black;">{{ $survey->customer_email }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->phone }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->address }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->date }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->service_plan }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->service_type }}</td>
                                        <td style="padding: 10px; color: black;">
                                            {{ $survey->download_bandwidth }}{{ $survey->unit }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->message }}</td>
                                        <td style="padding: 10px; color: black;">{{ $survey->feasibility }}</td>
                                        @if ($survey->engr_name === null)
                                            <td>
                                                @if (Auth::user()->role == 'Fibre Engineer')
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Fibre{{ $survey->id }}">Report</a>
                                                @else
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Raise{{ $survey->id }}">Report</a>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary"
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target="#View{{ $survey->id }}">View</a>
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
        {{ $surveys->links('user.customPagination') }}
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- End of required script for Modal -->

    <!-- Beginning of Scripts for adding and subtraction of rows -->
    <script type="text/javascript">
        $('.addRow').on('click', function() {
            addRow();
        });

        function addRow() {
            var tr = '<tr>' +
                '<td></td>' +
                '<td><input type="text" name="material[]" class="form-control"/></td>' +
                '<td><input type="text" name="quantity[]" class="form-control"/></td>' +
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
            var feasible = document.getElementById(client_id);
            var not_feasible = document.getElementById("no_fease" + client_id);
            var feasibleFibre = document.getElementById(client_id + "Fibre");
            var not_feasibleFibre = document.getElementById("no_fease" + client_id + "Fibre");
            console.log(feasible)

            if (status == 0) {
                console.log(status)
                feasible.style.display = 'block';
                not_feasible.style.display = 'none';

                // For Fibre Engineers
                feasibleFibre.style.display = 'block';
                not_feasibleFibre.style.display = 'none';
            } else {
                feasible.style.display = 'none';
                not_feasible.style.display = 'block';

                // For Fibre Engineers
                feasibleFibre.style.display = 'none';
                not_feasibleFibre.style.display = 'block';
            }
        }
    </script>

    <script type="text/javascript">
        function Casting(that, client_id) {
            if ((that.value === "Required")) {
                document.getElementById("Required" + client_id).style.display = "block";
            } else {
                document.getElementById("Required" + client_id).style.display = "none";
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
            // console.log(sum);
        }

        function sumCable(id) {
            c = parseFloat(document.getElementById("cable_length" + id).value);
            total = document.getElementById("length" + id);
            L = c + 0;
            total.value = L + "m";

            console.log(L);

        }
    </script>
    <!-- End of Script for  calculation of total cable required -->

    <!-- Script for form Validation before submission -->
    <script type="text/javascript">
        function validateForm(id) {
            let feasible = document.getElementById('feas' + id);
            let Nfeasible = document.getElementById('nofeas' + id);
            if (!feasible.checked && !Nfeasible.checked) {
                alert("Feasibility can't be blank!!");
                return false
            }

            if (feasible.checked) {
                let reml = document.forms["surveyForm" + id]["rem_latitude"].value;
                let remlo = document.forms["surveyForm" + id]["rem_longitude"].value;
                let slat = document.forms["surveyForm" + id]["latitude"].value;
                let slong = document.forms["surveyForm" + id]["longitude"].value;
                let buildH = document.forms["surveyForm" + id]["building_height"].value;
                let popD = document.forms["surveyForm" + id]["distance_from_pop"].value;
                let los = document.forms["surveyForm" + id]["los"].value;
                let suitP = document.forms["surveyForm" + id]["suitable_loc"].value;
                let polImg = document.forms["surveyForm" + id]["pole_image[]"].value;
                let reqCast = document.forms["surveyForm" + id]["required_casting"].value;
                let castImg = document.forms["surveyForm" + id]["image[]"].value;
                let baseStation = document.forms["surveyForm" + id]["base_stations[]"].value;
                let liveNeut = document.forms["surveyForm" + id]["LN"].value;
                let liveEarth = document.forms["surveyForm" + id]["LE"].value;
                let EarthNeut = document.forms["surveyForm" + id]["EN"].value;
                let secSrcVolt = document.forms["surveyForm" + id]["sec_src_volt"].value;
                let ups = document.forms["surveyForm" + id]["ups"].value;
                let upsPower = document.forms["surveyForm" + id]["ups_power"].value;
                let powerExt = document.forms["surveyForm" + id]["power_ext"].value;
                let condusiveEnv = document.forms["surveyForm" + id]["env"].value;

                if (reml == "") {
                    alert("Remote latitude field can't be empty!!");

                    return false;
                }

                if (remlo == "") {
                    alert("Remote longitude field can't be empty!!");
                    return false;
                }

                if (slat == "") {
                    alert("Site latitude field can't be empty!!");
                    return false;
                }

                if (slong == "") {
                    alert("Site longitude field can't be empty!!");
                    return false;
                }

                if (buildH == "") {
                    alert("Building height field can't be empty!!");
                    return false;
                }

                if (popD == "") {
                    alert("POP distance field can't be empty!!");
                    return false;
                }

                if (los == "") {
                    alert("Line of sight field can't be empty!!");
                    return false;
                }

                if (suitP == "") {
                    alert("Suitable pole field can't be empty!!");
                    return false;
                }

                if (polImg == "") {
                    alert("Please provide picture for suitable pole location!!");
                    return false;
                }

                if (reqCast == "") {
                    alert("Casting Requirement field can't be empty!!");
                    return false;
                }

                if (reqCast == "Required" && castImg == "") {
                    alert("Please provide picture for casting requirement!!");
                    return false;
                }

                if (baseStation == "") {
                    alert("Base station field can't be empty!!");
                    return false;
                }

                if (liveNeut == "") {
                    alert("Live to Neutral field can't be empty!!");
                    return false;
                }

                if (liveEarth == "") {
                    alert("Live to Earth field can't be empty!!");
                    return false;
                }
                if (EarthNeut == "") {
                    alert("Earthen to Neutral field can't be empty!!");
                    return false;
                }

                if (secSrcVolt == "") {
                    alert("Please specify if Secondary Source Voltage is present!!");
                    return false;
                }

                if (ups == "") {
                    alert("ups Availability field can't be empty!!");
                    return false;
                }

                if (upsPower == "") {
                    alert("Current Load field can't be empty!!");
                    return false;
                }

                if (powerExt == "") {
                    alert("Power Extension field can't be empty!!");
                    return false;
                }

                if (condusiveEnv == "") {
                    alert("Please clarify if Environment is conducive or not!!");
                    return false;
                }
            }

            if (Nfeasible.checked) {
                let reason = document.forms["surveyForm" + id]["reason"].value;
                let non_feasibility_proof = document.forms["surveyForm" + id]["non_feasibility_proof"].value;
                if (reason == "") {
                    alert("State Reason for non feasibility please.");
                    return false;
                }

                if (non_feasibility_proof == "") {
                    alert("Provide pictoral evidence for non feasibility.");
                    return false;
                }
            }

        }
    </script>
    <!-- End of Script for form Validation before submission  -->

    @include('user.field_engineer.surveys.fibre-validation')
</body>

</html>

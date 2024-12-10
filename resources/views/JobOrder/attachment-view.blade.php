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
    @if(Auth::user()->role==="Delivery Engineer")
    @include('user.delivery_engineer.header')
    @elseif(Auth::user()->role==="Service Engineer")
    @include('user.service_engr.header')
    @elseif(Auth::user()->role==="Field Engineer"|| Auth::user()->role==="Fiber Engineer"|| Auth::user()->role==="Admin Manager")
    @include('user.field_engineer.header')
    @endif
    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                Job Completion Attachment for {{$client}}
            </h1>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-white-900 py-10">
        <div class="flex flex-col mt-1">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <iframe height="800" width="1200" src="/image/installations/SLAs/{{$data->attachment}}"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Component End  -->
    </div>
    <div>
    </div>

    <!-- Generic Scripts -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- End of Geneeric Scripts -->
</body>

</html>
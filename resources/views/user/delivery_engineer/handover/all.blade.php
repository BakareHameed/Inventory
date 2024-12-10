<!DOCTYPE html>
<html lang="en">

@include('user.delivery_engineer.head')

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.delivery_engineer.header')

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                All Handovers
            </h1>
        </div>
        @if (Session::has('message'))
            <div class="col-12 col-sm-6 py-3 pt-4 alert alert-success" align="center" role="alert">
                <strong>Success:</strong>{{ Session::get('message') }}
            </div>
        @endif
    </div>

    {{-- @foreach ($Handover as $client)
        @include('user.delivery_engineer.handover.form')
    @endforeach --}}

    {{-- @foreach ($Handover as $client)
        @include('user.delivery_engineer.handover.link')
    @endforeach --}}

    {{-- @foreach ($Handover as $client)
        @include('user.delivery_engineer.handover.report-view')
    @endforeach --}}

    <div class="container" style="padding-top: 5px;">
        <div class="row ml-2">
            <div class="col-xl-3 col-md-4 mb-4">
                <div class="card border-left-primary  shadow h-100 py-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                    Total
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $count }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="flex flex-col items-center justify-center w-screen  bg-gray-900 py-0">
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
                                    <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                @php
                                    $i = ($all->currentPage() - 1) * $all->perPage();
                                @endphp
                                @foreach ($Handover as $Handovers)
                                    <tr style="background-color: white;" align="center">
                                        <td style="padding: 10px; color: black;">{{ ++$i }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->id }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->clients }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->contact_person_name }}
                                        </td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->customer_email }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->phone }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->address }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->date }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->service_plan }}</td>
                                        <td style="padding: 10px; color: black;">{{ $Handovers->service_type }}</td>
                                        <td style="padding: 10px; color: black;">
                                            {{ $Handovers->download_bandwidth }}{{ $Handovers->unit }}</td>
                                        <td style="padding: 10px; color: black;">
                                            @if ($Handovers->service_type == 'Accepted')
                                                <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary"
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target="#Link{{ $Handovers->id }}">Link</a>
                                            @else
                                                @if ($Handovers->filled_by === null)
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-info"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Handover{{ $Handovers->id }}">Form</a>
                                                @else
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-info"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Edit{{ $Handovers->id }}">Edit</a>
                                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-success"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#HOreport{{ $Handovers->id }}">View</a>
                                                @endif
                                            @endif
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
    <div>
    </div>


</body>
<!-- Beginning of ALL script -->
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




<script src="http://10.0.0.244:8081/js/app.js" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
<!-- Script for Multi-level dropdown list  -->

</html>

<!DOCTYPE html>
<html lang="en">
@include('user.service_engr.head')
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

<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.service_engr.header')

    <div align="center" style="padding:0px">
        <div class="col-md-3 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                All Base Stations
            </h1>
        </div>
    </div>

    <div align="center">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert"><strong>Success:</strong>{{ Session::get('message') }}</div>
        @endif
    </div>

    <div class="container pb-0" align="left" style="margin-left:5vw">
        <div class="row">
            <div class="col-lg-6 mb-1">
                <div class="col-lg-3 col-sm-3 mb-1">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-left">
                                <div class="">
                                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total No. of
                                        POPs</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex  items-center justify-center w-screen bg-gray-900 py-0">
        <div class="flex mt-0">
            <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="">
                        <table class="shadow overflow-hidden sm:rounded-lg min-w-full text-sm text-gray-400">
                            <div align="right">
                                <span>
                                    <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info"
                                        href="#" data-bs-toggle="modal" data-bs-target="#Create">New POP</a>
                                </span>
                                <span>
                                    <a style="padding: 10px;margin-bottom:5px;background:purple"
                                        class="btn btn-outline-danger"
                                        href="{{ route('all.weekly.expenses') }}">Expenses</a>
                                </span>
                                <span>
                                    <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger"
                                        href="{{ route('all.POP.tickets') }}">POP Tickets</a>
                                </span>
                                <span>
                                    <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary"
                                        href="{{ route('POP.surveys.all') }}">Surveys</a>
                                </span>
                            </div>
                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                                <tr style="background-color:black;">
                                    <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Site ID</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Trunk IP</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Base/Cluster IP</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Longitude</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Latitude</th>
                                    <!-- <th style="padding:10px; font-size: 20px; color: white ;">POP Switch</th> -->
                                    <!-- <th style="padding:10px; font-size: 20px; color: white ;">POP Router</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Infrastructure Type</th> -->
                                    <th style="padding:10px; font-size: 20px; color: white ;">Tower Length</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Activated On</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Routine Check</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Edit</th>
                                    <!-- <th style="padding:10px; font-size: 20px; color: white ;">Deployment Status</th> -->
                                    <!-- <th style="padding:10px; font-size: 20px; color: white ;">Update Radio Parameters</th> -->
                                </tr>
                            </thead>
                            @php
                                $i = ($totalPOPs->currentPage() - 1) * $totalPOPs->perPage();
                            @endphp
                            <tbody>
                                @foreach ($pops as $pop)
                                    <tr style="background-color: white;">
                                        <td>{{ ++$i }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->POP_name }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->site_id }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->Trunk_IP }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->Base_Cluster_IP }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->Longitude }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->Latitude }}</td>
                                        <!-- <td style="padding: 10px; color: black;">{{ $pop->POP_switch }}</td> -->
                                        <!-- <td style="padding: 10px; color: black;">{{ $pop->POP_router }}</td>
                                                <td style="padding: 10px; color: black;">{{ $pop->Infrastructure_Type }}</td> -->
                                        <td style="padding: 10px; color: black;">{{ $pop->Tower_Pole_Length }}</td>
                                        <td style="padding: 10px; color: black;">{{ $pop->Activated_Date }}</td>
                                        <td>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-primary"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#routineCheck{{ $pop->id }}">
                                                Report
                                            </a>
                                        </td>
                                        <td>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-primary"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#Edit{{ $pop->id }}">Edit</a>
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
    <div class="pt-2 pb-5">
        {{ $totalPOPs->links('user.customPagination') }}
    </div>

    {{-- Create POP form --}}
    @include('user.service_engr.POP.create')

    {{-- Edit POP Form --}}
    @foreach ($pops as $pop)
        @include('user.service_engr.POP.edit')
    @endforeach
    {{-- POP Routine Check Report Form --}}
    @foreach ($pops as $pop)
        @include('user.service_engr.POP.routine-check.form')
    @endforeach

    @include('user.service_engr.POP.survey.form')

</body>
<!-- Beginning  of required script for Modal -->
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
<!-- Beginning of required script for Modal -->

<!-- Beginning of Scripts for adding and subtraction of Trunk IP -->
<script type="text/javascript">
    function addRow(id) {
        var tr = '<tr>' +
            '<td></td>' +
            '<td><input required type="text" name="Trunk_IP[]" class="form-control"/></td>' +
            '<th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>' +
            '</tr>';
        $('.item').append(tr);

    }
    $('.item').on('click', '.removeRow', function() {
        $(this).parent().parent().remove();
        console.log(id)
        findTotal(this, id);
    });
</script>
<!-- End of scripts for row addition -->

<!-- Beginning of Scripts for adding and subtraction of Base Cluster IP -->
<script type="text/javascript">
    function addBaseCluser(id) {
        var tr = '<tr>' +
            '<td></td>' +
            '<td><input required type="text" name="Base_Cluster_IP[]" class="form-control"/></td>' +
            '<th style="text-align:center"><a href="#" class="btn btn-danger deleteRow">-</a></th>' +
            '</tr>';
        $('.baseCluster').append(tr);

    }
    $('.baseCluster').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
        findTotal(this, id);
    });
</script>
<!-- End of scripts for row addition -->

</html>

<!DOCTYPE html>
<html lang="en">
@include('user.support.head')

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @if (Auth::user()->role == 'Service Engineer')
        @include('user.service_engr.header')
    @else
        @include('user.support.header')
    @endif

    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center">
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                Raise POP Tickets
            </h1>
        </div>
    </div>

    @if (Session::has('message'))
        <div style="align-content: center" class="col-lg-6 ml-4 py-3 alert alert-success" role="alert">
            <strong>Success:</strong>{{ Session::get('message') }}
        </div>
    @endif
    <div class="container" align="left">
        <div class="row">
            <div class="col-sm-2 col-sm-2  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
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

    <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-10">
        <div class="flex flex-col mt-6">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div align="right">
                            <span>
                                <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info"
                                    href="{{ route('all.POP.tickets') }}">POP Tickets</a>
                            </span>
                            {{-- <span>
                  <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#POPSurveyReport">Report</a>
              </span> --}}
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full text-sm text-gray-400">
                                <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;">
                                        <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">POP</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">
                                            Site ID</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Trunk IP</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Base Cluster IP</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Longitude</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Latitude</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Tower_Pole_Length</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800">
                                    @php
                                        $i = ($pop->currentPage() - 1) * $pop->perPage();
                                    @endphp
                                    @foreach ($pop as $pops)
                                        <tr style="background-color: white;" align="left">
                                            <td style="padding: 10px; color: black;">
                                                <strong>{{ ++$i }}</strong>
                                            </td>
                                            <td style="padding: 10px; color: black;">{{ $pops->id }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->POP_name }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->site_id }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->Trunk_IP }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->Base_Cluster_IP }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->Longitude }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->Latitude }}</td>
                                            <td style="padding: 10px; color: black;">{{ $pops->Tower_Pole_Length }}
                                            </td>
                                            <td style="padding: 5px; color: black;">
                                                <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary"
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target="#Raise{{ $pops->id }}">Raise</a><span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    {{ $pop->links('user.customPagination') }}
                </div>
            </div>
            <!-- Component End  -->
        </div>
        <div>
        </div>

        @foreach ($pop as $pops)
            @include('user.support.POP.form')
        @endforeach
        <script>
            function faultOwner(id) {
                var fault_owner = document.querySelector('#fault_owner'+id).value;
                var syscodes = document.getElementById("syscodes" + id);
                // console.log(fault_owner);as
                if (fault_owner == "Syscodes") {
                    syscodes.style.display = "block";
                console.log(syscodes);

                } else {
                    syscodes.style.display = "none";
                }
            }
        </script>
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

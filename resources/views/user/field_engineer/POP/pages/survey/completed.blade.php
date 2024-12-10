<!DOCTYPE html>
<html lang="en">
    @include('user.field_engineer.head')
    <body>
        <!-- Back to top button -->
        <div class="back-to-top"></div>
        @include('user.field_engineer.header')

        <div align="Center" style="padding:0px">
            <div class="col-lg-6 py-3 wow fadeInUp text-center" >
            <h1 class="text-center" style="text-align:center;font-size:2rem">
                All Completed POP Surveys
            </h1>
            </div>
        </div>

        <div align="Center">
            @if(Session::has('message'))
                <div style="align-content: center" class="col-lg-6 ml-4 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
            @endif
        </div>

        <div class="container pb-0"  align="left" style="padding:0px">
            <div class="row ml-3">
                <div class="col-sm-3 col-sm-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-sm-3  ">
                    <div class="card border-left-primary shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Page Count</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$PageCount}} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col items-center justify-center w-screen bg-gray-900 py-0">
            <div class="flex flex-col mt-3">
                <div class="-my-0 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div align="right">    
                                <span>
                                    <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info"href="{{route('engr.pending.pop.survey')}}" >Pending</a>
                                </span>
                                {{-- <span>
                                    <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#POPSurveyForm">Survey</a>
                                </span> --}}
                            </div>
                            <div class="shadow overflow-hidden sm:rounded-lg">
                                <table  class="min-w-full text-sm text-gray-400">
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                      <tr style="background-color:black;">
                                        <th style="padding:10px; font-size: 20px; color: white ;">ID</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">POP Name</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Address</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Latitude</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Longitude</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Date Raised</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Message</th>
                                        <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = ($popSurveys->currentPage() - 1) * $popSurveys->perPage();
                                        @endphp
                                        @foreach($popSurveys as $survey)
                                        <tr style="background-color: white;" align="center">
                                            <td style="padding: 10px; color: black;">{{$survey->id}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->POP_name}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->address}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->Latitude}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->Longitude}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->created_at}}</td>
                                            <td style="padding: 10px; color: black;">{{$survey->message}}</td>
                                            <td>
                                              <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#editPOPSurveyReport{{$survey->id}}">View</a>
                                            </td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{ $popSurveys->links('user.customPagination') }}
                    </div>
                </div>
                <!-- Component End  -->
            </div>
            <div>
        </div>

        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body> 
</html>

<!DOCTYPE html>
<html lang="en">
  @include('user.service_engr.head')

  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    
    @include('user.service_engr.header')

    <div align="center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem">
            All POP Surveys
        </h1>
        </div>
    </div>

    <div align="Center">
        @if(Session::has('message'))
            <div style="align-content: center" class="col-lg-6 ml-4 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
        @endif
    </div>
    
      <div class="container pb-2 " align="text-center">
        <div class="row">
            <div class="col-md-3  mb-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} </div>
                                        <div class="col-auto">
                                          {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

        <div class="flex  items-center justify-right w-screen bg-gray-900 py-0" >
            <div class="flex mt-0">
                <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div align="right">    
                          <span>
                              <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info" href="#" data-bs-toggle="modal" data-bs-target="#POPSurveyForm">New Survey</a>
                          </span>
                          <span>
                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="{{ route('all.pops')}}" >All POPs</a>
                          </span>
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
                                    <th style="padding:10px; font-size: 20px; color: white ;">1st Assigned Engr</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">2nd Assigned Engr</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                    <th style="padding:10px; font-size: 20px; color: white ;">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                    $i = ($surveys->currentPage() - 1) * $surveys->perPage();
                                    @endphp --}}
                                    @foreach($popSurveys as $survey)
                                    <tr style="background-color: white;" align="center">
                                        <td style="padding: 10px; color: black;">{{$survey->id}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->POP_name}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->address}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->Latitude}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->Longitude}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->created_at}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->message}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->first_engr}}</td>
                                        <td style="padding: 10px; color: black;">{{$survey->sec_engr}}</td>
                                        <td>
                                          <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#editPOPSurveyReport{{$survey->id}}">View</a>
                                        </td>
                                        <td style="padding: 5px; color: white;">
                                          <form method="POST" action="{{ url('delete_survey',$survey->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a style="padding: 5px; color: black;" class="btn btn-xs btn-danger btn-flat show_confirm" href="{{url('delete-POP-survey',$survey->id)}}">
                                              Delete<i class="fa fa-trash"  style="font-size:20px;color:rgb(53, 48, 48)"></i>
                                            </a>
                                          </form>        
                                          {{-- <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#POPSurveyReport{{$survey->id}}">Report</a> --}}
                                        </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ $surveys->links('user.customPagination') }} --}}
            <!-- Component End  -->
        <div>
      <div>
      {{-- @foreach ($popSurveys as $client)
        @include('survey_details.suspend-survey')
      @endforeach --}}
      @include('user.service_engr.POP.survey.form')

     

</body>
  <!-- Beginning  of required script for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- Beginning of required script for Modal -->

<!-- Script for laravel sweet alert when deleting record -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script type="text/javascript">
  
      $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                form.submit();
              }
            });
        });
    
  </script>
<!-- Script for laravel sweet alert when deleting record -->





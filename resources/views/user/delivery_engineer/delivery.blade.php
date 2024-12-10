<!DOCTYPE html>
<html lang="en">
@include('user.delivery_engineer.head')

  <body>
      <!-- Back to top button -->
      <div class="back-to-top"></div>
      
      @include('user.delivery_engineer.header')

      <div align="center" style="padding:0px">
          <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:2rem">
              All Survey Requests
          </h1>
          </div>
      </div>
  
        <div class="container pb-3 " align="text-center">
          <div class="row ml-3">
              <div class="col-sm-3 col-lg-3 mb-1">
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

        <div align="center"  style="margin:15px; margin-left:30px;padding-top:30px">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
            @endif

            <div class="flex  items-center justify-right w-screen bg-gray-900 py-0" >
              <div class="flex mt-0">
                  <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                      <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="shadow overflow-hidden sm:rounded-lg">
                              <table  class="min-w-full text-sm text-gray-400">
                                  <thead class="bg-gray-800 text-xs uppercase font-medium">
                                    <tr style="background-color:black;">
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
                                      <th style="padding:10px; font-size: 20px; color: white ;">First Assigned Engr</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Second Assigned Engr</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Third Assigned Engr</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                                      <th style="padding:10px; font-size: 20px; color: white ;">Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      {{-- @php
                                      $i = ($appointments->currentPage() - 1) * $appointments->perPage();
                                      @endphp --}}
                                      @foreach($appointments as $appointment)
                                      <tr style="background-color: white;" align="center">
                                          <td style="padding:3px; color: black;">{{$appointment->id}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->clients}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->contact_person_name}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->customer_email}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->phone}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->address}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->created_at}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->service_plan}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->service_type}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->download_bandwidth}}{{$appointment->unit}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->message}}</td>
                                          <td style="padding:3px; color: black;">
                                            {{$appointment->first_assigned_engr}}
                                            @if($appointment->first_assigned_engr == null)
                                                <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" style="background-color: purple" href="#" data-bs-toggle="modal" data-bs-target="#clientSurveyForm{{$appointment->id}}">Report</a>
                                            @endif
                                          </td>
                                          <td style="padding:3px; color: black;">{{$appointment->second_assigned_engr}}</td>
                                          <td style="padding:3px; color: black;">{{$appointment->third_assigned_engr}}</td>
                                          <td>
                                            <a style="padding:3px; color: black;" class="btn btn-primary mb-1" href="{{url('assign_engr_form',$appointment->id)}}">
                                                Assign<i class="fa fa-check"  style="font-size:20px;color:rgb(53, 48, 48)"></i>
                                            </a>
                                            
                                              @if($appointment->status =='Suspended')
                                                {{$appointment->status}}
                                                <a style="padding:3px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Suspend{{$appointment->id}}">
                                                  Unsuspend<i class="fa fa-pause"  style="font-size:20px;color:rgb(53, 48, 48)"></i>
                                                </a>
                                              @else
                                                <a style="padding:3px;margin-bottom:5px" class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#Suspend{{$appointment->id}}">
                                                  Suspend<i class="fa fa-pause"  style="font-size:20px;color:rgb(53, 48, 48)"></i>
                                                </a>
                                              @endif
                                            </td>
                                          <td style="padding:3px; color: white;">
                                            <form method="POST" action="{{ url('delete_survey',$appointment->id) }}">
                                              @csrf
                                              <input name="_method" type="hidden" value="DELETE">
                                              <a style="padding:3px; color: black;" class="btn btn-xs btn-danger btn-flat show_confirm" href="{{url('assign_engr_form',$appointment->id)}}">
                                                Delete<i class="fa fa-trash"  style="font-size:20px;color:rgb(53, 48, 48)"></i>
                                              </a>
                                            </form>        
                                          </td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              {{-- {{ $appointments->links('user.customPagination') }} --}}
              <!-- Component End  -->
          <div>
        </div>
          
        @foreach ($appointments as $client)
          @include('survey_details.suspend-survey')
        @endforeach

        @foreach ($appointments as $client)
          @include('user.delivery_engineer.surveys.form')
        @endforeach
  </body>

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
</html>

<!-- Beginning of ALL script -->
  <!-- Generic scripts -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- End of generic scripts -->
  
  <!-- Beginning of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- End of required script for Modal -->

  <!-- Beginning of Scripts for adding and subtraction of rows -->
      <script type="text/javascript">

          $('.addRow').on('click',function(){
              addRow();
          });

          function addRow(){
              var tr = '<tr>'+
                          '<td></td>'+
                          '<td><input type="text" name="material[]" class="form-control"/></td>'+
                          '<td><input type="text" name="quantity[]" class="form-control"/></td>'+
                          '<th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>'+
                      '</tr>';
                  $('.materials').append(tr);
          }
          $('.materials').on('click','.removeRow', function(){
                  $(this).parent().parent().remove();
                  findTotal();
          });
      </script>
  <!-- End of scripts for row addition -->

  <!-- Beginning of Script for Feasibility Check -->
    <script type="text/javascript">
        function feasibility(status,client_id){
          if(status == 0 ){
            document.getElementById( client_id).style.display = 'block';
            document.getElementById( "no_fease"+client_id).style.display = 'none';
          }
          else{
            document.getElementById( client_id).style.display = 'none';
            document.getElementById( "no_fease"+client_id).style.display = 'block';
          }
        }
    </script>

    <script type="text/javascript">
        function Casting(that,client_id) {
            if((that.value === "Required"))
            {
                document.getElementById("Required"+client_id).style.display = "block";
            }
            else 
            {
                document.getElementById("Required"+client_id).style.display = "none";
            }
        }
    </script>
  <!-- End of Script for Feasibility Check -->

  <!-- Beginning of script for calculation of cable length -->
    <script type="text/javascript">
        function calculate(id){
          a= parseFloat(document.getElementById("vert_cable_length"+id).value);
          b= parseFloat(document.getElementById("horiz_cable_length"+id).value);
          c= parseFloat(document.getElementById("excess_cable_length"+id).value);
          d= parseFloat(document.getElementById("others"+id).value);
        total = document.getElementById("result"+id)
          if (isNaN(d)) d = 0;
          var sum=Number(a+b+c+d);

          total.value = sum+"m";

          console.log(sum);

        }
    </script>
  <!-- End of Script for  calculation of total cable required -->

  <!-- Script for form Validation before submission -->
    <script type="text/javascript">
        function validateForm(id) {
          let feasible = document.getElementById( 'feas'+id);
          let Nfeasible = document.getElementById( 'nofeas'+id);
          if(!feasible.checked && !Nfeasible.checked)
          {
            alert("Feasibility can't be blank!!");
            return false
          }

          if(feasible.checked) 
          {
            let reml = document.forms["surveyForm"+id]["rem_latitude"].value;
            let remlo = document.forms["surveyForm"+id]["rem_longitude"].value;
            let slat = document.forms["surveyForm"+id]["latitude"].value;
            let slong= document.forms["surveyForm"+id]["longitude"].value;
            let buildH = document.forms["surveyForm"+id]["building_height"].value;
            let popD = document.forms["surveyForm"+id]["distance_from_pop"].value;
            let los = document.forms["surveyForm"+id]["los"].value;
            let suitP = document.forms["surveyForm"+id]["suitable_loc"].value;
            let polImg = document.forms["surveyForm"+id]["pole_image[]"].value;
            let reqCast = document.forms["surveyForm"+id]["required_casting"].value;
            let castImg = document.forms["surveyForm"+id]["image[]"].value;
            let baseStation = document.forms["surveyForm"+id]["base_stations[]"].value;
            let liveNeut = document.forms["surveyForm"+id]["LN"].value;
            let liveEarth = document.forms["surveyForm"+id]["LE"].value;
            let EarthNeut = document.forms["surveyForm"+id]["EN"].value;
            let secSrcVolt = document.forms["surveyForm"+id]["sec_src_volt"].value;
            let ups = document.forms["surveyForm"+id]["ups"].value;
            let upsPower = document.forms["surveyForm"+id]["ups_power"].value;
            let powerExt = document.forms["surveyForm"+id]["power_ext"].value;
            let condusiveEnv = document.forms["surveyForm"+id]["env"].value;
          
            if(reml=="")
            {
              alert("Remote latitude field can't be empty!!");
              
              return false;
            }
        
            if(remlo=="")
            {
              alert("Remote longitude field can't be empty!!");
              return false;
            }

            if(slat=="")
            {
              alert("Site latitude field can't be empty!!");
              return false;
            }

            if(slong=="")
            {
              alert("Site longitude field can't be empty!!");
              return false;
            }

            if(buildH=="")
            {
              alert("Building height field can't be empty!!");
              return false;
            }

            if(popD=="")
            {
              alert("POP distance field can't be empty!!");
              return false;
            }

            if(los=="")
            {
              alert("Line of sight field can't be empty!!");
              return false;
            }

            if(suitP=="")
            {
              alert("Suitable pole field can't be empty!!");
              return false;
            }

            if(polImg=="")
            {
              alert("Please provide picture for suitable pole location!!");
              return false;
            }

            if(reqCast=="")
            {
              alert("Casting Requirement field can't be empty!!");
              return false;
            }

            if(reqCast=="Required" && castImg=="")
            {
              alert("Please provide picture for casting requirement!!");
              return false;
            }

            if(baseStation=="")
            {
              alert("Base station field can't be empty!!");
              return false;
            }

            if(liveNeut=="")
            {
              alert("Live to Neutral field can't be empty!!");
              return false;
            }

            if(liveEarth=="")
            {
              alert("Live to Earth field can't be empty!!");
              return false;
            }
            if(EarthNeut=="")
            {
              alert("Earthen to Neutral field can't be empty!!");
              return false;
            }

            if(secSrcVolt=="")
            {
              alert("Please specify if Secondary Source Voltage is present!!");
              return false;
            }

            if(ups=="")
            {
              alert("ups Availability field can't be empty!!");
              return false;
            }

            if(upsPower=="")
            {
              alert("Current Load field can't be empty!!");
              return false;
            }

            if(powerExt=="")
            {
              alert("Power Extension field can't be empty!!");
              return false;
            }
            
            if(condusiveEnv=="")
            {
              alert("Please clarify if Environment is conducive or not!!");
              return false;
            }
          }

          if(Nfeasible.checked)
          { 
            let reason = document.forms["surveyForm"+id]["reason"].value;
            let non_feasibility_proof = document.forms["surveyForm"+id]["non_feasibility_proof"].value;
            if(reason == "")
            {
              alert("State Reason for non feasibility please.");
              return false;
            }

            if(non_feasibility_proof == "")
            {
              alert("Provide pictoral evidence for non feasibility.");
              return false;
            }
          }

        }
    </script>
  <!-- End of Script for form Validation before submission  -->
{{-- End of all Scripts --}}
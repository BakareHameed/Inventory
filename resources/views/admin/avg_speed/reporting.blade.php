<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->


    
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')

      <!-- partial -->
    
      @include('admin.navbar')
        <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
    <div class="main-panel">
          <div class="content-wrapper" style="background-color:#39d8e3">
            <div class="row">
              <div class="col-12 grid-margin stretch-card" >
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">

                       <div class="col-6 col-xl-6 col-xl-12 pl-0 text-center">
                        <span>
                          
                        <h2>Get Statistical Up Until:</h2>
                        <form class="main-form" action="{{url('avg_speed_reporting')}}" method="GET" enctype="multipart/form-data">

                          @csrf
                               <div class="container">
                                <div class="row">
                                    <div class="form-group name1 col-md-6">
                                        <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                                        <input style="background-color:white;color:black" type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                                    </div>

                                    <div class="form-group name2 col-md-6">
                                        <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                                        <input style="background-color:white;color:black"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                                    </div>
                                </div>  
                                <button class="btn btn-outline-success" type="submit">Get</button>
                            </div>   
                        
                        </form>

                      </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <div align="Center" style="padding:20px">
            <div class="col-lg-6 py-3 wow fadeInUp text-center" >
                <h1 class="text-center" style="text-align:center;font-size:2rem; color:black">
                  <strong>Active Clients Average Capacity From {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
                To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}</strong>
               </h1>
            </div>
          </div>

<!-- Total Average Speed -->

            <div class="row">

            <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{number_format($total_bandwidth)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                                Mbps
                        <a  href="{{url('access-bandwidth-query-view',['dateE'=>$dateE,'dateS'=>$dateS])}}">
                          <div class="icon icon-box-success ">
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                     </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Access Bandwidth</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{number_format($total_customers)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <a href="{{url('All_active_clients_reporting',['dateE'=>$dateE,'dateS'=>$dateS])}}">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>     
                     </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Total Customers</h6>
                  </div>
                </div>
              </div>



              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card"> 
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h1 style="font-size:50px" class="mb-0">{{number_format($total_avg_speed)}}</h1>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>  
                            Mbps
                      <div class="col-3">
                        <!-- <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div> -->
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px; text: yellow;">Total Average Speed</h6>
                  </div>
                </div>
              </div>

                 <!-- customers less than 2mbps-->
                 <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{number_format($half_customers)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <a href="{{url('speed_less_than_two_reporting',['dateE'=>$dateE,'dateS'=>$dateS])}}">
                        <div class= "icon icon-box-success" >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a> 
                     </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Customers with speed less than 2mbps</h6>
                  </div>
                </div>
              </div>

       <!-- customers greater than 2mbps but less than 10mbps-->
              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{number_format($deca_customers)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <a href="{{url('speed_btw_two_ten_reporting',['dateE'=>$dateE,'dateS'=>$dateS])}}">
                        <div class= "icon icon-box-success" >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a> 
                     </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Customers with speed between 2mbps-10mbps</h6>
                  </div>
                </div>
              </div>
              
          <!-- customers greater than 10mbps-->
              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{number_format($duodeca_customers)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <a href="{{url('speed_btw_greater_than_ten_reporting',['dateE'=>$dateE,'dateS'=>$dateS])}}">
                        <div class= "icon icon-box-success" >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>    
                     </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Customers with speed of 10mbps and above</h6>
                  </div>
                </div>
              </div>

              <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
            </div>
          </div>
        </div>
          
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
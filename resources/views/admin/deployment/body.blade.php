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
                        <form class="main-form" action="{{url('Deployment_reporting')}}" method="GET" enctype="multipart/form-data">

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


        <div align="Center" style="padding:0px">
          <div class="col-lg-6 py-3 wow fadeInUp text-center" >
            <h1 class="text-center" style="text-align:center;font-size:2rem; color:black">
               <strong> Survey Statistics As At {{Carbon\Carbon::parse($Currentdate)->format(' D, j F,Y')}} </strong>
            </h1>
          </div>
        </div>


            <div class="row">

            <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$this_months_surveys}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-raised-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Surveys Raised This Month</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$surveys_done_this_month}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-done-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Surveys Carried Out This Month</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$this_months_feasible_surveys}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-feasible-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">No. of Feasible Surveys for This Month</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$this_months_not_feasible_surveys}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-Notfeasible-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">No of Surveys not Feasible for This Month</h6>
                  </div>
                </div>
              </div>

              
              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$this_months_installations}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-installations')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">No Installation done for This Month</h6>
                  </div>
                </div>
              </div>



            <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$pending_surveys_this_month}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('current-month-pending-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">This month's surveys still pending</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$pending_surveys}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('all-pending-surveys')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Total Pending Surveys</h6>
                  </div>
                </div>
              </div>
              
              
             <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$paid_survey}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('all-pending-installations')}}">
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Total Paid Pending Installations</h6>
                  </div>
                </div>
              </div>
         
              <!-- <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">₦{{number_format($income)}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:25px">Total Amount Paid for Pending Installations</h6>
                  </div>
                </div>
              </div> -->
              
              </div>
              </div>
          

            

              <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="font-size:20px">Surveys & Installation Statistics for Each Engineer in {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </th>
                            <th style="font-size:20px"> S/N </th>
                            <th style="font-size:20px"> Engineer Name </th>
                            <th style="font-size:20px"> Surveys Done </th>
                            <th style="font-size:20px">Feasible</th>
                            <th style="font-size:20px">Not Feasible</th>
                            <th style="font-size:20px">Installations</th>
                            </tr>
                        </thead>

                        @foreach($surveys as $survey)
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td style="font-size:20px">{{$loop->iteration}}</td>
                            <td style="font-size:20px">{{$survey->engr_name}}</td>
                            <td style="font-size:20px">{{$survey->surveys}}</td>
                            <td style="font-size:20px"> {{$survey->feasible}}</td>
                            <td style="font-size:20px"> {{$survey->not_feasible}}</td>
                            <td style="font-size:20px">{{$survey->installation}}</td>
                          </tr>

                          @endforeach
                        </div>
                        </div>
                        </div>
                        </div>
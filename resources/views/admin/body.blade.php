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
                        <form class="main-form" action="{{url('md_dashboard')}}" method="GET" enctype="multipart/form-data">

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


            <div class="row">

            <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$total_customers}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('All_connected_customers')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Total Connected Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card"> 
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h1 style="font-size:50px" class="mb-0">{{$active_customers}}</h1>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('All_active_customers')}}">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Total Active Customers</h6>
                  </div>
                </div>
              </div>
              
              
              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$corporate}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a  href="{{url('All_active_corporate_customers')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Corporate Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$wired_corporate}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a  href="{{url('All_active_wired_corporate_clients')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Wired Corporate Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$wireless_corporate}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a  href="{{url('All_active_wireless_corporate_clients')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Wireless Corporate Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$shared}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('All_active_Prepaid_customers')}}">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Pre-Paid Customers</h6>
                  </div>
                </div>
              </div>

          
              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$dedicated}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('active_Dedicated_clients')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Post Paid Customers</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$corporate_SME}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a href="{{url('Active_sme')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active SME Customers</h6>
                  </div>
                </div>
              </div>



              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$home}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('active_Home_clients')}}">
                        <div class="icon icon-box-success " >
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Active Retail Customers</h6>
                  </div>
                </div>
              </div>




              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_customers}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('Inactive_customers')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Total Inactive Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_corporate}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('Inactive_corporate_customers')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Inactive Corporate Customers</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_shared}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('Inactive_Prepaid_customers')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Inactive Pre-Paid Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_dedicated}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('inactive_Dedicated_clients')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Inactive Post Paid Customers</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_corporate_SME}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('Inactive_sme')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Inactive SME Customers</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$inactive_home}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('inactive_Home_clients')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                       </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Inactive Retail Customers</h6>
                  </div>
                </div>
              </div>


              <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px">{{$suspended_customers}}</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <a  href="{{url('All_suspended_customers')}}">
                        <div class= "icon icon-box-danger" >
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Total Suspended Customers</h6>
                  </div>
                </div>
              </div>

           

              <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="font-size:20px">Last Ten Surveys Created</h4>
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
                            <th style="font-size:20px"> Survey ID </th>
                            <th style="font-size:20px"> Client Name </th>
                            <th style="font-size:20px">Service Plan</th>
                            <th style="font-size:20px"> Service Type</th>
                            <th style="font-size:20px"> Bandwidth</th>
                            <th style="font-size:20px"> Date Created</th>
                            <th style="font-size:20px"> Payment Status </th>
                            <th style="font-size:20px">Deployment Status </th>
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
                            <td style="font-size:20px">{{$survey->id}}</td>
                            <td style="font-size:20px">{{$survey->clients}}</td>
                            <td style="font-size:20px">{{$survey->service_plan}}</td>
                            <td style="font-size:20px"> {{$survey->service_type}}</td>
                            <td style="font-size:20px"> {{$survey->download_bandwidth}} {{$survey->unit}}</td>
                            <td style="font-size:20px"> {{$survey->created_at}}</td>
                         
                            <td style="font-size:20px"> {{$survey->status}} </td>
                            <td>
                              <div class="badge badge-outline-success" style="font-size:20px">{{$survey->deployment_status}}</div>
                            </td>
                          </tr>

                          @endforeach
                        </div>
                        </div>
                        </div>
                        </div>
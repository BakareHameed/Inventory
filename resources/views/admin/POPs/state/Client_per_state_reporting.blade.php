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
                        <form class="main-form" action="{{url('active_clients_per_state_reporting')}}" method="GET" enctype="multipart/form-data">

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
                  <h2 class="text-center" style="text-align:center;font-size:2rem; color: Black; font-family:sans-serif">
                    <strong> Total Number of Active Customers Per State from 
                            {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
                            To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
                    </strong>
                </h2>
              </div>
            </div>
            <div class="row">
          
            @foreach($state as $p_state)
         
            <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0" style="font-size:50px"> {{count($p_state)}}</h3>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <div class="d-flex align-items-center align-self-start">
                          <h6 class="mb-0 font-weight-normal" style="font-size:30px; color: Grey"> {{$p_state->unique('location')->pluck('location')->implode(', ')}} State </h6>
                          <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{url('active_clients_per_state_reporting_view',['state'=>$p_state->unique('location')->pluck('location')->implode(', '),$dateE,$dateS] )}}" >
                          <div class="icon icon-box-success " >
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal" style="font-size:30px">Region: {{$p_state->unique('Region')->pluck('Region')->implode(', ')}} </h6>
                  </div>
                </div>
              </div>

              @endforeach
            



             
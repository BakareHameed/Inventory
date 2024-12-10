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
               <strong> All Pending Engineers Assignments As At {{Carbon\Carbon::parse($Currentdate)->format(' D, j F,Y')}} </strong>
            </h1>
          </div>
        </div>


            <div class="row">

            @foreach($EngrAssNotdone as $engr)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0" style="font-size:50px">{{count($engr)}}</h3>
                              <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>
                          <div class="col-3">
                          <a href="{{ url('engr-assgt-view',['id'=>$engr->unique('first_engr_id')->pluck('first_engr_id')->implode('')])}}" >
                            
                            <div class="icon icon-box-success " >
                              <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                          </a>
                          </a>
                          </div>
                        </div>
                        <h6 class="text-muted font-weight-normal" style="font-size:30px">{{$engr->unique('first_engr')->pluck('first_engr')->implode(', ')}}</h6>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>
              </div>
          
              <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title" style="font-size:20px">Tickets Statistics for Each Engineer in {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}</h4>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="font-size:20px"> S/N </th>
                              <th style="font-size:20px"> Engineer</th>
                              <th style="font-size:20px"> Tickets Assigned</th>
                              <th style="font-size:20px">Pending</th>
                              <th style="font-size:20px">Reported</th>
                              <th style="font-size:20px">Closed</th>
                              <th style="font-size:20px">View</th>
                            </tr>
                          </thead>
                          @foreach($allEngrAss as $allEngrAss)
                              <tbody>
                                <tr>
                                  <td style="font-size:20px;">{{$loop->iteration}}</td>
                                  <td style="font-size:20px;">{{$allEngrAss->unique('first_engr')->pluck('first_engr')->implode(' ')}} </td>
                                  <td style="font-size:20px;">{{$allEngrAss->unique('asgts')->pluck('asgts')->implode('')}}</td>
                                  <td style="font-size:20px;">{{$allEngrAss->unique('pending')->pluck('pending')->implode('')}}</td>
                                  <td style="font-size:20px;">{{$allEngrAss->unique('done')->pluck('done')->implode('')}}</td>
                                  <td style="font-size:20px;">{{$allEngrAss->unique('closed')->pluck('closed')->implode('')}}</td>
                                  <td style="font-size:0px;">
                                      <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{ url('engr-assgt-view',['id'=>$allEngrAss->unique('first_engr_id')->pluck('first_engr_id')->implode('')])}}">view</a><span>
                                  </td>
                                </tr>
                              </tbody>
                          @endforeach
                        
                        </table>
                      </div>

                      <div class ="pt-5">
                        <h4 class="card-title" style="font-size:20px">Remote Resolution Tickets Statistics By Each Personnel in {{Carbon\Carbon::parse($Currentdate)->format(' F,Y')}}</h4>
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="font-size:20px"> S/N </th>
                              <th style="font-size:20px"> Personnel</th>
                              <th style="font-size:20px"> Tickets Assigned</th>
                              <th style="font-size:20px">Pending</th>
                              <th style="font-size:20px">Reported</th>
                              <th style="font-size:20px">Closed</th>
                              <th style="font-size:20px">View</th>
                              </tr>
                          </thead>

                            @foreach($allSupportAss as $allSupportAss)
                              <tbody>
                                <tr>
                                  <td style="font-size:20px">{{$loop->iteration}}</td>
                                  <td style="font-size:20px">{{$allSupportAss->first_engr}} </td>
                                  <td style="font-size:20px">{{$allSupportAss->asgts}}</td>
                                  <td style="font-size:20px">{{$allSupportAss->pending}}</td>
                                  <td style="font-size:20px">{{$allSupportAss->done}} </td>
                                  <td style="font-size:20px">{{$allSupportAss->closed}} </td>
                                  <td style="font-size:0px;">
                                      <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{ url('engr-assgt-view',['id'=>$allSupportAss->first_engr_id])}}">view</a><span>
                                  </td>
                                </tr>
                              </tbody>
                            @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>














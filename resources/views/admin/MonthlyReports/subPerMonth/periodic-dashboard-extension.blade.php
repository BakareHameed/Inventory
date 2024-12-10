<div class="main-panel">
    <div align="Center" style="padding:0px">
      <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center;font-size:2rem; color:black">
            <strong style="color: white"> Subscription For 12 months up till {{Carbon\Carbon::parse($dcm)->format('l, jS \\of F, Y h:i:s A')}} </strong>
        </h1>
      </div>
    </div>
  
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title" style="font-size:20px">
              Subscription Statistics as at {{Carbon\Carbon::parse($dcm)->format(' l, jS \\of F, Y h:i:s A')}}
              <span class="float-right">
                <select onchange="window.location.href=this.options[this.selectedIndex].value;" style="font-size:1.25rem;color:black;background-color:white" class="btn block w-full mt-2 mb-2 ml-3 mr-3 rounded-md border-gray-300 shadow-xl focus:border-indigo-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50 form-control">
                  <option>--- Select period ---</option>
                  @foreach ($periodicDate as $key => $result) 
                      <option value="{{route('dashboard.periodic',['mthN'=>$result['monthNumber'],'mth'=>$result['month'],'yr'=>$result['year']])}}">{{$result['month']}} {{$result['year']}}</option>
                  @endforeach
                </select>
              </span>
            </h4>
           
            <div class="table-responsive">
              <table class="table" border="1">
                <thead>
                  <col>
                  <colgroup span="2"></colgroup>
                  <colgroup span="2"></colgroup>
                  <tr>
                    <td rowspan="2" style="font-size:20px;font:bold" class="text-center">Months</td>
                    <th colspan="3" scope="colgroup" style="font-size:20px" class="text-center">Home Customers</th>
                    <th colspan="3" scope="colgroup" style="font-size:20px" class="text-center">SME Customers</th>
                    <th colspan="3" scope="colgroup" style="font-size:20px" class="text-center">Dedicated Customers</th>
                  </tr>
                  <tr>
                    <th scope="col" style="font-size:20px">Active</th>
                    <th scope="col" style="font-size:20px"> Inactive</th>
                    <th scope="col" style="font-size:20px">Suspended</th>
  
                    <th scope="col" style="font-size:20px">Active</th>
                    <th scope="col" style="font-size:20px"> Inactive</th>
                    <th scope="col" style="font-size:20px">Suspended</th>
  
                    <th scope="col" style="font-size:20px">Active</th>
                    <th scope="col" style="font-size:20px"> Inactive</th>
                    <th scope="col" style="font-size:20px">Suspended</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subscriptionArray as $key => $subscribers) 
                    @foreach($subscribers as $result) 
                      <tr>
                        <th scope="row" style="font-size:20px;">{{$result['monthName']}}</th>
                        <td style="font-size:20px;">{{$result['active_home']}}</td>
                        <td style="font-size:20px;">{{$result['inactive_home']}}</td>
                        <td style="font-size:20px;">{{$result['suspended_home']}}</td>
                        <td style="font-size:20px;">{{$result['active_sme']}}</td>
                        <td style="font-size:20px;">{{$result['inactive_sme']}}</td>
                        <td style="font-size:20px;">{{$result['suspended_sme']}}</td>
                        <td style="font-size:20px;">{{$result['active_dedicated']}}</td>
                        <td style="font-size:20px;">{{$result['inactive_dedicated']}}</td>
                        <td style="font-size:20px;">{{$result['suspended_dedicated']}}</td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-0">
          <div class="flex flex-col mt-0">
            <div class="-my-0 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-lg">
                  <table class="columns min-w-full text-sm text-gray-400">
                    <tr>
                      <td>  
                        <div id="Home" style="width: 70rem; height: 41rem;color: white ;background-color:white: 20px; margin:30px"></div>
                      </td>
                    <tr>
                      <td>  
                        <div id="SME" style="width: 70rem; height: 41rem;color: white ;background-color:white: 20px; margin:30px"></div>
                      </td>
                    </tr>
                    <tr>
                      <td>  
                        <div id="Dedicated" style="width: 70rem; height: 41rem;color: white ;background-color:white: 20px; margin:30px"></div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
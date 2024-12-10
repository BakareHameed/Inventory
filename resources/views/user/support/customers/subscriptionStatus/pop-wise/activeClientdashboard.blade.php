<!DOCTYPE html>
<html lang="en">
  @include('user.support.head')

  <body>
      <!-- Back to top button -->
      <div class="back-to-top"></div>
      @include('user.support.header')
      <div align="Center" style="padding:0px">

      <div align="Center" style="padding:0px">
          <div class="col-lg-6 py-3 wow fadeInUp text-center" >
          <h1 class="text-center" style="text-align:center;font-size:2rem">
              All Active Clients from
              {{Carbon\Carbon::parse($dateS)->format('D, M j, Y')}}
              To {{Carbon\Carbon::parse($dateE)->format('D, M j, Y')}}
          </h1>
          </div>
      </div>
   
      <form class="main-form" action="{{url('Clients_per_POP_reporting')}}" method="GET" enctype="multipart/form-data">
          @csrf
          <div class="container col-xl-12  pl-0 text-center">
              <h2>Get Clients Between:</h2>
              <div class="row flex ">
                  <div class="form-group  col-sm-6">
                      <label for="exampleInputEmail1" class="formText">Start Date:*</label>
                      <input required style="background-color:white" type="date" class="form-control" name="dateS"  aria-describedby="emailHelp" name="muverName">
                      <input hidden type="text" class="form-control" name="pop"  aria-describedby="emailHelp">
                  </div>
  
                  <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1## Heading ##" class="formText">End Date:*</label>
                      <input required style="background-color:white"  type="date" class="form-control" name="dateE"  aria-describedby="emailHelp" name="muverPhone">
                      <input hidden type="text" class="form-control" name="status"  aria-describedby="emailHelp">
                  </div>
              </div>  
              <button class="btn btn-outline-success" type="submit">Get</button>
          </div>   
      </form>

      <div class="row pt-2">
        @foreach($cust_per_pop as $client_per_pop)
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                      <a href="{{url('clients_per_pop_reporting_view',['pop'=>$client_per_pop->unique('pop')->pluck('pop')->implode(', '),'dateE'=>$dateE,'dateS'=>$dateS] )}}" >
                        {{$client_per_pop->unique('pop')->pluck('pop')->implode(', ')}}
                      </a>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($client_per_pop)}} </div>
                  </div>
              
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        @if($clients_without_POP > 0)
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-info text-uppercase mb-1"> clients Without POP Customers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$clients_without_POP}} </div>
                    </div>
                    <div class="col-3">
                      <a href="{{url('clients_per_pop_view',['pop'=>'Clients without'] )}}" >
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        @endif
      </div>
  </body>
</html>
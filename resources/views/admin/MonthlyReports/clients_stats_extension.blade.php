<div class="main-panel">
    <div class="content-wrapper" style="background-color:#39d8e3">
        <div class="row">
            <div class="col-6 grid-margin stretch-card" >
                <div class="card corona-gradient-card" >
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center" >
                            <span style ="margin:0.5rem">SME Customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            @foreach ($sme as $sme_client)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0" style="font-size:50px">{{$sme_client->count}} </h3>
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
                        
                        <h6 class="text-muted font-weight-normal" style="font-size:30px">{{$sme_client->month}} Customers</h6>
                    </div>
                    </div>
                </div> 
            @endforeach
        </div>

        <div class="row">
            <div class="col-6 grid-margin stretch-card" >
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center">
                            Home Customers
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            @foreach ($home as $home_client)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0" style="font-size:50px">{{$home_client->count}} </h3>
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
                        
                        <h6 class="text-muted font-weight-normal" style="font-size:30px">{{$home_client->month}} Customers</h6>
                    </div>
                    </div>
                </div> 
            @endforeach
        </div>

        <div class="row">
            <div class="col-6 grid-margin stretch-card" >
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center">
                           Dedicated Customers
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            @foreach ($dedicated as $dedicated_client)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0" style="font-size:50px">{{$dedicated_client->count}} </h3>
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
                        
                        <h6 class="text-muted font-weight-normal" style="font-size:30px">{{$dedicated_client->month}} Customers</h6>
                    </div>
                    </div>
                </div> 
            @endforeach
        </div>

    </div>
</div>
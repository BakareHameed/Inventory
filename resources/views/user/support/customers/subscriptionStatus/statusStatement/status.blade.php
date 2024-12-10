
@if($status != 'Suspended')
    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Subscribed</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$active}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Non-Subscribed</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$inactive}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Terminated</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suspended}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Dedicated</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suspendedDedicated}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">SME</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suspendedSME}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 col-sm-2  mb-1 ml-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Home</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suspendedHome}} </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
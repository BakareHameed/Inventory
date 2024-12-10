<div class="modal fade" id="Report{{$report->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$report->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Report{{$report->id}}Label"><span style="color:blue;align:right"><strong>Job Completion Report<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <div><strong>X</strong></div>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin: 20px;margin-bottom:0px">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                        Installation Report (<span class="text-gray-600">{{$report->customer_id}}</span>)
                    </h2>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                                <div class="text-xl">
                                    Job Completion Report for
                                    <span class="text-yellow-600">{{ $report->clients }}, with ID:
                                        @if($report->customer_id == null)
                                        {{ $report->id }}
                                        @else
                                        {{$report->customer_id}}
                                        @endif
                                    </span>
                                    located at
                                    <span class="text-yellow-600">{{ $report->address }}</span>

                                    @if ($report->engr_name != null)
                                    carried out by Engineer
                                    <span class="text-blue-600">{{$report->engr_name }}</span>
                                </div>

                                <div class="mt-8">
                                    <div class="grid grid-cols-3 gap-8">
                                        <div>
                                            <div class="font-bold">Scope of work:</div>
                                            <div class="pt-2">{{ $report->SoW }}</div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Pole Location:</div>
                                            <div class="pt-2">{{$report->pole_loc }}</div>
                                        </div>
                                        @if($report->casting=== "Done")
                                        <div>
                                            <div class="font-bold">Casting</div>
                                            <div class="pt-3">{{ $report->casting }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="pt-3 modal-header"></div>
                                    <label for="" style="text-align:left"><strong>Tools/Materials Installed </strong></label>
                                    <div class="p-12 grid grid-cols-6">
                                        <table class="border-collapse border table-auto get-company ">
                                            <tr>
                                                <th style="color:black;">S/N</th>
                                            </tr>
                                            @foreach(explode(',', $report->material) as $items)
                                            <tr>
                                                <td style="color:blue;">{{ $loop->iteration }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <table class="border-collapse border table-auto w-full get-company">
                                            <tr>
                                                <th style="color:black;">Materials Needed</th>
                                            </tr>
                                            @foreach(explode(',', $report->material) as $items)
                                            <tr>
                                                <td style="color:black;">{{ $items }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <table class="border-collapse border table-auto w-full get-company">
                                            <tr>
                                                <th style="color:black;">Quantity</th>
                                            </tr>
                                            @foreach(explode(',', $report->qty) as $qty)
                                            <tr>
                                                <td style="color:black;">{{ $qty }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <table class="border-collapse border table-auto w-full get-company">
                                            <tr>
                                                <th style="color:black;">Remark</th>
                                            </tr>
                                            @foreach(explode(',', $report->remark) as $rem)
                                            <tr>
                                                <td style="color:black;">{{ $rem }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 modal-header"></div>
                        <div class="pt-2"></div>
                        <div class="pt-2 card col-6">
                            <div class=""><strong>IT Rooom: Power/Environment </strong></div>
                            <table class="city">
                                <thead>
                                    <tr>
                                        <th class="ml-5 text-center" style="float:center">Power Information</th>
                                        <div class="hr"></div>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="color:black;">Primary source voltage</td>
                                        <td><strong style="color:black;">L-N</strong> = {{ $report->LN }}V <strong style="color:black;"> L-E</strong> = {{ $report->LE }}V <strong style="color:black;">E-N</strong> = {{ $report->EN }}V</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 ml-3">
                        <div class="font-bold">Activation Status:</div>
                        <div class="pt-3">{{ $report->activation_status }}</div>
                    </div>

                    <div class="mt-8 ml-3">
                        <div class="font-bold">Recommendation:</div>
                        <div class="pt-3">{{ $report->recommendation }}</div>
                    </div>


                    @if($report->pole_img != null)
                    <div class="mt-6">
                        Installation Pictures
                        <hr class="font-bold">
                        <div class="font-bold pt-3">Pole Location Image(s):</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->pole_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: fit-content;max-height:fit-content">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/pole_location/'. $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($report->cast_img != null)
                    <div class="mt-6">
                        <div class="font-bold">Image of Casting:</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->cast_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/casting/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($report->outdoor_img != null)
                    <div class="mt-6">
                        <div class="font-bold">Outdoor Image(s):</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->outdoor_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/outdoor/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($report->indoor_img != null)
                    <div class="mt-6">
                        <div class="font-bold">Indoor Image(s):</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->indoor_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/indoor/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($report->path_img != null)
                    <div class="mt-6">
                        <div class="font-bold">Image of Cable path:</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->path_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/path/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($report->power_img != null)
                    <div class="mt-6">
                        <div class="font-bold">Image of Power Source:</div>
                        <div class="row pt-3 gx-5">
                            @foreach(explode('|' ,$report->power_img) as $image)
                            <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                <div class="row ">
                                    <img src="{{ asset('image/installations/casting/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 ml-3 row col-6">
                        <div class="font-bold">Attachment:</div>
                        <span class="ml-2 mr-2"> <a href="{{ url('/job-completion-SLA',$report->attachment)}}" class="btn btn-success pt-2">Download pdf</a></span>
                        <span><a href="{{ url('/job-completion-Attachment-View',$report->installation_id)}}" class="btn btn-info pt-2">View</a></span>
                    </div>

                    @else
                    <div class="mt-8">
                        <div class="font-bold">Report Status:</div>
                        <div class="pt-3">No report yet</div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:purple;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
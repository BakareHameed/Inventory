<div class="modal fade" id="View{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$client->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                    <h1 class="modal-title fs-5" id="View{{$client->id}}Label"><span style="color:blue;align:right"><strong >Job Order Raised<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
                </div>
            <div class="modal-body">
                <div style="margin: 20px;margin-bottom:0px">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                        Comprehensive Survey Report (<span class="text-gray-600">{{$client->customer_id}}</span>)
                    </h2>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                                <div class="text-xl">
                                    Comprehensive Survey Report for
                                    <span class="text-yellow-600">{{ $client->clients }}, with ID:
                                    @if($client->customer_id == null)
                                        {{ $client->id }}
                                    @else
                                        {{$client->customer_id}}
                                    @endif
                                    </span>
                                    located at 
                                    <span class="text-yellow-600">{{ $client->address }}</span> carried out by Engineer 
                                    <span class="text-blue-600">{{$client->engr_name }}</span>
                                </div>

                                @if ($client->engr_name != null && $client->latitude != null)
                                    <div class="mt-8">
                                        <div class="grid grid-cols-3 gap-8">
                                            <div>
                                                <div class="font-bold">Latitude</div>
                                                <div class="pt-3">{{ $client->latitude }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Longitude</div>
                                                <div class="pt-3">{{$client->longitude }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Remote Latitude</div>
                                                <div class="pt-3">{{ $client->rem_latitude }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Remote Longitude</div>
                                                <div class="pt-3">{{$client->rem_longitude }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Building Height</div>
                                                <div class="pt-3">{{ $client->building_height }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Suitable Pole Location</div>
                                                <div class="pt-3">{{ $client->suitable_loc }}</div>
                                            </div>
                                            <div>
                                            <div class="font-bold">Distance from Pop:</div>
                                            <div class="pt-3">  {{ $client->distance_from_pop }}</div>
                                            </div>
                                            <div>
                                            <div class="font-bold">Line of Site?</div>
                                            <div class="pt-3">  {{ $client->LoS }}</div>
                                            </div>
                                            <div>
                                            <div class="font-bold">Casting?</div>
                                            <div class="pt-3">  {{ $client->required_casting }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Base Stations</div>
                                                <div class="pt-3">{{ $client->base_stations }}</div>
                                            </div>
                                        </div>
                                        <div class="pt-3 modal-header"></div>
                                        <label for="" style="text-align:left"><strong>Tools/Materials Required </strong></label>
                                        <div class="p-12 grid grid-cols-6">
                                            <table class="border-collapse border table-auto get-company ">
                                                <tr>
                                                    <th style="color:black;">S/N</th>
                                                </tr>
                                                @foreach(explode(',', $client->material) as $items) 
                                                    <tr>
                                                        <td style="color:blue;">{{ $loop->iteration }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <table class="border-collapse border table-auto w-full get-company">
                                                <tr>
                                                    <th style="color:black;">Materials Needed</th>
                                                </tr>
                                                @foreach(explode(',', $client->material) as $items) 
                                                    <tr>
                                                        <td style="color:black;">{{ $items }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <table class="border-collapse border table-auto w-full get-company">
                                                <tr>
                                                    <th style="color:black;">Quantity</th>
                                                </tr>
                                                @foreach(explode(',', $client->quantity) as $qty) 
                                                    <tr>
                                                        <td style="color:black;">{{ $qty }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        </div>
                                        @php
                                            $cablesum =  $client->vert_cable + $client->hori_cable + $client->exce_cable + $client->add_cable;
                                        @endphp
                                        <div class="pt-3">
                                                <div class="font-bold">Cable length breakdown:</div>
                                                <span class="pt-3 mr-3"><label><strong>Vertical Length:</strong> {{ $client->vert_cable }}m</label></span>
                                                <span class="pt-3 mr-3"><label><strong>Horizontal Length:</strong> {{ $client->hori_cable }}m</label></span>
                                                <span class="pt-3 mr-3"><label><strong>Excess Length:</strong> {{ $client->exce_cable }}m</label></span>
                                                <span class="pt-3 mr-3"><label><strong>Others:</strong> {{ $client->add_cable }}m</label></span><br>
                                                <span class="pt-3 mr-3"><label><strong>Total Length:</strong> <span style="color:blue;font-size:large"><strong>{{$cablesum}}m<strong></span></label></span>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="pt-2"></div>
                                        <div class="pt-2 card col-6">
                                        <div class=""><strong>IT Rooom: Power/Environment </strong></div>
                                            <table class="city">
                                            <thead>
                                                <tr >
                                                    <th class="ml-5 text-center" style="float:center">Power Information</th>
                                                    <div class="hr"></div>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color:black;">Primary source voltage</td>
                                                    <td><strong>L-N</strong> = {{ $client->LN }}   <strong>L-E</strong> = {{ $client->LE }} <strong>E-N</strong> = {{ $client->EN }}</td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black;">Secondary source voltage</td>
                                                    <td>{{ $client->sec_src_volt }}  </td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black;">UPS Availability</td>
                                                    <td>{{ $client->ups }} </td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black;">UPS power rating/current load (%)</td>
                                                    <td>{{ $client->ups_power }} </td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black;">Power Extension</td>
                                                    <td>{{ $client->power_ext }}</td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black;">Conducive Environment</td>
                                                    <td>{{ $client->env }}</td>
                                                </tr>
                                            </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mt-8">
                                        <div class="font-bold">Additional Info:</div>
                                        <div class="pt-3">{{ $client->additional_info }}</div>
                                    </div>

                                    @if($client->pole_img != null)
                                        <div class="mt-6">
                                            <div class="font-bold pt-3">Suitable Pole Location Image(s):</div>
                                            <div class="row pt-3 gx-5"> 
                                                @foreach(explode('|' ,$client->pole_img) as $image)
                                                    <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: fit-content;max-height:fit-content">
                                                        <div class="row ">
                                                            <img src="{{ asset('image/survey_images/pole_location/'. $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($client->survey_img != null)
                                        <div class="mt-6">
                                            <div class="font-bold">Image Before Casting:</div>
                                            <div class="row pt-3 gx-5"> 
                                                @foreach(explode('|' ,$client->survey_img) as $image)
                                                    <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                                        <div class="row ">
                                                            <img src="{{ asset('image/survey_images/' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                
                                @else
                                    <div class="mt-8">
                                        <div class="font-bold">Reason:</div>
                                        <div class="pt-3">{{ $client->additional_info }}</div>
                                    </div>
                                    @if($client->survey_img != null)
                                        <div class="mt-6">
                                            <div class="font-bold">Pictoral Proof:</div>
                                            <div class="row pt-3 gx-5"> 
                                                @foreach(explode('|' ,$client->survey_img) as $image)
                                                    <div class="card col-xl-4 col-mb-4 text-white bg-white mb-8 gx-5" style="max-width: 15rem">
                                                        <div class="row ">
                                                            <img src="{{ asset('image/non_feasible_images/proof' . $image) }}" class="w-30 mb-8 shadow-xl" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            @if(Auth::user()->role === "Delivery Engineer")
                                <div>
                                    <div class="mt-8">
                                        <div class="font-bold">Send Comment To Marketer:</div>
                                        <div class="pt-3"> <a class="btn btn-primary" style="padding: 10px; color: black;" href="{{url('commentview',$client->id)}}">comment</a></div>
                                    </div>

                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
 
        </div>
    </div>
</div>
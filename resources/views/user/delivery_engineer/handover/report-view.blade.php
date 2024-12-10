<div class="modal fade" id="HOreport{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$client->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="HOreport{{$client->id}}Label"><span style="color:blue;align:right"><strong>Technical Handover Report<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <div><strong>X</strong></div>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin: 20px;margin-bottom:0px">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                        Standard Link Quality Format (<span class="text-gray-600">{{$client->customer_id}}</span>)
                    </h2>
                </div>


                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div style="overflow-x:auto;" class="pl-4 ml-3 bg-white border-b border-gray-200">
                                <div class="mt-8  pl-4">
                                    <div class="grid">
                                        <div class="text-xl pb-3 pt-0">
                                            Technical Handover Report for
                                            <span class="text-yellow-600">{{ $client->clients }}, with ID:
                                                @if($client->customer_id == null)
                                                {{ $client->id }}
                                                @else
                                                {{$client->customer_id}}
                                                @endif
                                            </span>
                                            located at
                                            <span class="text-yellow-600">{{ $client->address }},</span> filled by
                                            <span class="text-blue-600">{{$client->filled_by }}</span>.
                                        </div>

                                        <div class="text-xl">
                                            <div class="font-bold"><u style="border-bottom: 2px double;">CLIENT'S DETAILS</u></div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="font-bold">
                                                <u> Connecting POP:</u>
                                                <span class="text-black-600 text-xl ml-3">{{ $client->pop }}</span>.
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">
                                                <u>AP IP Address:</u>
                                                <span class="text-black-600 text-xl ml-3">{{ $client->AP }}</span>.
                                            </div>

                                        </div>
                                        <div>
                                            <div class="font-bold">
                                                <u>SM IP Address:</u>
                                                <span class="text-black-900 text-xl ml-3">{{ $client->SM }}</span>.
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">
                                                <u>Internet IP Address:</u>
                                                <span class="text-black-900 text-xl ml-3">{{$client->internet_IP }}</span>
                                            </div>
                                            <div class="pt-3"></div>
                                        </div>
                                    </div>
                                    <div class="pt-3 modal-header"></div>
                                    <div class="pt-2 pl-0 pr-4 pb-3 mr-2 mt-2 mb-2">
                                        <label class="col-md-12 text-left"><strong><u style="border-bottom: 2px double;">Client's Checklist Handover</u></strong></label>
                                        <table class="city" width="70%">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="ml-5 text-center" style="float:center;color:black">RF Parameters</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="color:black;">S/N</th>
                                                    <th style="color:black;">Parameters</th>
                                                    <th style="color:black;">Range</th>
                                                    <th style="color:black;">Delivery Engineer's Feedback</th>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">1</td>
                                                    <td style="color:black;">Signal Strength</td>
                                                    <td style="color:black;">-(35-55dBM)</td>
                                                    <td style="color:black;">{{$client->signal_strength }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">2</td>
                                                    <td style="color:black;">Chain</td>
                                                    <td style="color:black;">(0-5)</td>
                                                    <td style="color:black;">{{$client->chain }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">3</td>
                                                    <td style="color:black;">Frequency</td>
                                                    <td style="color:black;">Unlicensed</td>
                                                    <td style="color:black;">{{$client->frequency }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">4</td>
                                                    <td style="color:black;">Duplex setting</td>
                                                    <td style="color:black;">100Mbps full</td>
                                                    <td style="color:black;">{{$client->duplex }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">5</td>
                                                    <td style="color:black;">Latency(AP-SM)</td>
                                                    <td style="color:black;">-5ms</td>
                                                    <td style="color:black;">{{$client->latency }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">6</td>
                                                    <td style="color:black;">RX/TX gap</td>
                                                    <td style="color:black;">-5dBm</td>
                                                    <td style="color:black;">{{$client->rx_tx_gap }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">7</td>
                                                    <td style="color:black;">RF capacity gap</td>
                                                    <td style="color:black;">-5dBm</td>
                                                    <td style="color:black;">{{$client->rf_cap_gap }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">8</td>
                                                    <td style="color:black;">Link/Internet capacity</td>
                                                    <td style="color:black;">100%</td>
                                                    <td style="color:black;">{{$client->internet_cap_radio }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="pt-2 pl-0 pr-4 pb-3 mr-2 mt-2 mb-2">
                                        <table class="city" width="70%">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="ml-5 text-center" style="float:center;color:black">Network Parameters</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="color:black;">S/N</th>
                                                    <th style="color:black;">Parameters</th>
                                                    <th style="color:black;">Range</th>
                                                    <th style="color:black;">Delivery Engineer's Feedback</th>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">1</td>
                                                    <td style="color:black;">Link/Internet Capacity</td>
                                                    <td style="color:black;">100%</td>
                                                    <td style="color:black;">{{$client->internet_cap_network }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">2</td>
                                                    <td style="color:black;">End-to-end RF latency</td>
                                                    <td style="color:black;">-(5-15 ms)</td>
                                                    <td style="color:black;">{{$client->end_to_end_latency }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">3</td>
                                                    <td style="color:black;">Packet loss</td>
                                                    <td style="color:black;">0</td>
                                                    <td style="color:black;">{{$client->packet_loss }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color:blue;">4</td>
                                                    <td style="color:black;">Fibre end-to-end latency</td>
                                                    <td style="color:black;">0-2ms</td>
                                                    <td style="color:black;">{{$client->fibre_latency }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="">
                                        <div class="pt-2">
                                            <label>Power Source:</label>
                                            <span>{{$client->power_src }}</span>
                                        </div>
                                        <div class="pt-2">
                                            <label>Power Protection:</label>
                                            <span>{{$client->power_protection }}</span>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <label>Cable Path:</label>
                                        <span class="text-md"> {{$client->cable_path }}</span>
                                    </div>
                                    <div class="pt-1">
                                        <label>Remark:</label>
                                        <div>{{$client->remark }}</div>
                                    </div>
                                    <div class="pt-3 modal-header"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<form class="form-group"
    action="{{ url('client-technical-handover-form', ['client' => $client->clients, 'id' => $client->id, 'surveyId' => $client->survey_id]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Handover{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="Handover{{ $client->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Handover{{ $client->id }}Label"><span
                            style="color:blue;text-align:right"><strong>Technical Handover Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                {{-- <div class="modal-body mt-3">
                    <strong><input style="color:white;font:20px bold;background-color:black;" type="text"
                            value="CLIENT DETAILS" readonly /></strong>
                    <div class="row mt-2 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Client's Name:</strong></label>
                            <input type="text" placeholder="Client's Name" value="{{ $client->clients }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Connecting POP:</strong></label>
                            <input type="text" disabled placeholder="Client's Project type"
                                value="{{ $client->pop }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>AP IP address:</strong></label>
                            <input type="text" value="{{ $client->AP }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>SM IP address:</strong></label>
                            <input type="text" required value="{{ $client->SM }}" disabled
                                placeholder="What's the scope of the job done?"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Internet IP Address:</strong></label>
                            <input type="text" required value="{{ $client->internet_IP }}" disabled
                                placeholder="Picture of outdoor cable or devices"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Service Plan:</strong></label>
                            <input type="text" value="{{ $client->service_plan }}"
                                placeholder="Picture of outdoor cable or devices"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        {{-- <div class="modal-body">
                            <div class="row mt-3">
                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                    style="font-size:20px;margin-left:10px;color:black"><strong>RF
                                        Parameters</strong></label>
                                <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                                </hr>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Signal Strength:</strong></label>
                                    <input required type="text" name="signal_strength"
                                        placeholder="Range: -(35-55dBm)"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Chain:</strong></label>
                                    <input required type="text" name="chain" placeholder="Range: (0-5)"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Frequency:</strong></label>
                                    <input required type="text" name="frequency"
                                        placeholder="Unlicensed frequency"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Duplex Setting:</strong></label>
                                    <input required type="text" name="duplex" placeholder="100 Mbps full"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Latency(AP-SM):</strong></label>
                                    <input required type="text" name="latency" placeholder="Range: -5ms"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>RX/TX gap:</strong></label>
                                    <input required type="text" name="rx_tx_gap" placeholder="Range: -5dBm"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>RF Capacity gap:</strong></label>
                                    <input required type="text" name="rf_cap_gap" placeholder="Range: -5dBm"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="form-group name2 col-md-4">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px"><strong>Link/Internet Capacity:</strong></label>
                                    <input required type="text" name="internet_cap_radio"
                                        placeholder="Range: 100%"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="row mt-3 ml-1 mr-1">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px;margin-left:12px;color:black"><strong>Network
                                            Parameters</strong></label>
                                    <hr style="border:1px solid black;" class="form-group name2 mt-0 col-md-12">
                                    </hr>

                                    <div class="form-group name2 col-md-6">
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Link/Internet Capacity:</strong></label>
                                        <input required type="text" name="internet_cap_network"
                                            placeholder="Range: 100%"
                                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>

                                    <div class="form-group name2 col-md-6">
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>End-to-end RF Latency:</strong></label>
                                        <input required type="text" name="end_to_end_latency"
                                            placeholder="Range: -(5-15)ms"
                                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>

                                    <div class="form-group name2 col-md-6">
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Packet Loss:</strong></label>
                                        <input required type="text" name="packet_loss" placeholder="Range: 0"
                                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>

                                    <div class="form-group name2 col-md-6">
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Fibre(End-to-end) latency:</strong></label>
                                        <input required type="text" name="fibre_latency"
                                            placeholder="Range: 100/5"
                                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
            </div>
            {{-- </div> --}}

            <div class="modal-body">
                <div class="row mt-0.5">
                    <div class="form-group name2 col-md-12">
                        <hr style="border:solid black;border-width:0.2px" class="form-group pt-0 mt-0 col-md-12">
                        </hr>
                        <div class="row">
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" style="font-size:20px"><strong>Power
                                        Source:</strong></label>
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>Inverter</strong></label>
                                <input type="checkbox" name="power_src[]" value="Inverter" />
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>PHCN</strong></label>
                                <input type="checkbox" name="power_src[]" value="PHCN" />
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>Generator</strong></label>
                                <input type="checkbox" name="power_src[]" value="Generator" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" style="font-size:20px"><strong>Power
                                        Protection:</strong></label>
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>Stabilizer</strong></label>
                                <input type="checkbox" name="power_protection[]" value="Stabilizer" />
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>UPS</strong></label>
                                <input type="checkbox" name="power_protection[]" value="UPS" />
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="power"
                                    style="font-size:20px"><strong>Inverter</strong></label>
                                <input type="checkbox" name="power_protection[]" value="Inverter" />
                            </div>
                        </div>
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Cable Path:</strong></label>
                            <input type="text" name="cable_path" placeholder="e.g conduit pipe, cieling,etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        <div class="form-group align-center col-md-6">
                            <label for="" class="remark" style="font-size:20px">Any Remark?</label>
                            <textarea name="remark" id="" cols="30" rows="4"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                                focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Place Your Remark here"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
            </div>
        </div>
    </div>
    </div>
</form>

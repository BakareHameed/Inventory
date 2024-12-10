{{-- <form class="form-group"
    action="{{ route('delivery.link.acceptability', ['installation_id' => $client->installation_id, 'surveyId' => $client->survey_id]) }}"
    method="POST" enctype="multipart/form-data"> --}}
<form class="form-group" action="{{ url('delivery.link.acceptability', ['surveyId' => $client->survey_id]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Link{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Link{{ $client->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Link{{ $client->id }}Label"><span
                            style="color:blue;text-align:right"><strong>Delivery Link Acceptance Form<strong></span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body mt-3">
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
                                style="font-size:20px"><strong>AP
                                    IP address:</strong></label>
                            <input type="text" value="{{ $client->AP }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>SM
                                    IP address:</strong></label>
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

                        <div class="modal-body">
                            <div class="row mt-3">
                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                    style="font-size:20px;margin-left:10px;color:black"><strong>Delivery Link
                                        Remark</strong></label>
                                <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                                </hr>
                                <div class="form-group align-center col-md-6">
                                    <label for="exampleInputEmail1## Heading ##" class="formText"
                                        style="font-size:20px;margin-left:10px;color:black"><strong>Is the link
                                            acceptable</strong></label>
                                    <select name="link_status" required
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option disabled selected>--- Select Link Status---</option>
                                        <option> Accepted </option>
                                        <option> Rejected </option>
                                    </select>
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
                </div>
                <div align = "center">
                    <button type="submit" class="btn btn-primary" style="background-color:purple; ">Submit</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color:grey;"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

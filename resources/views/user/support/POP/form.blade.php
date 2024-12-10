<form class="form-group" action="{{ url('pops-ticket-form-submit', ['id' => $pops->id]) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Raise{{ $pops->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Raise{{ $pops->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Raise{{ $pops->id }}Label"><span
                            style="color:blue;align:right"><strong>POPs Ticket Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong> ID: </strong></label>
                            <input type="number" name="id" value="{{ $pops->id }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP:</strong></label>
                            <input type="text" name="pop" placeholder="POP Name" value="{{ $pops->POP_name }}"
                                disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Longitude:</strong></label>
                            <input type="text" name="longitude" placeholder="Longitude"
                                value="{{ $pops->Longitude }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Latitude:</strong></label>
                            <input type="text" name="Latitude" placeholder="Latitude" value="{{ $pops->Latitude }}"
                                disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Address:</strong></label>
                            <input type="text" name="address" placeholder="Address of POP" required 
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Contact Person:</strong></label>
                            <input type="text" name="contact_person" placeholder="Contact person at the POP" required
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Phone:</strong></label>
                            <input type="number" name="contact_phone" placeholder="Contact person's phone" required
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Radio IP(AP/SM): </strong></label>
                            <input id="radio_ip" type="text" required name="radio_IP" placeholder="Enter Radio IP.."
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Start Time: </strong></label>
                            <input id="" type="time" required name="start_time"
                                placeholder="Enter Start Time"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Start Date: </strong></label>
                            <input id="day" type="date" required name="start_day" placeholder="Enter Date"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Fault:</strong></label>
                            <input type="text" name="fault" placeholder="What's the issue"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Purpose</strong></label>
                            <select required
                                name="purpose"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Purpose of visit ---</option>
                                <option>Maintenance</option>
                                <option>Retrieval</option>
                                <option>Deployment</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Fault Status</strong></label>
                            <select required
                                name="fault_level"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Fault Status ---</option>
                                <option>Norminal</option>
                                <option>Critical</option>
                                <option>Highly Critical</option>
                                <option>Catastrophic</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Fault Level</strong></label>
                            <select required
                                name="fault_type"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Fault Level ---</option>
                                <option value="1st">1st Level (Support)</option>
                                <option value="2nd">2nd Level (Service Operations)</option>
                                <option value="3rd">3rd Level (NOC)</option>
                                <option value="4th">4th Level (Core Network)</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Fault Owner:</strong></label>
                            <select required name="fault_owner" id="fault_owner{{ $pops->id }}"
                                onchange="faultOwner('{{ $pops->id }}')"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="" disabled>--- Select Fault Owner---</option>
                                <option>Syscodes</option>
                                <option>Airtel</option>
                                <option>MainOne</option>
                                <option>MTN</option>
                                <option>PAT</option>
                                <option>World Wide</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2" id="syscodes{{ $pops->id }}" style="display:none">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Assign Engineer</strong></label>
                            <select required
                                name="first_engr_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Assign Engineer ---</option>
                                @foreach ($engineers as $engineer)
                                    <option value="{{ $engineer->id }}" id="first_engr_id">{{ $engineer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Initiation type?</strong></label>
                            <select required name="initiation"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select Initiation Type ---</option>
                                <option>Reactive</option>
                                <option>Proactive</option>
                            </select>
                        </div>

                        <div class="col-12 py-2" data-wow-delay="300ms">
                            <label class="formText" style="font-size:20px"><strong>Details of Fault:</strong></label>
                            <textarea required name="fault_details" id="comment" rows="6"
                                placeholder="Specify the details  of the client's complaint"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </textarea>
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

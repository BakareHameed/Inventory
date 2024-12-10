<form class="main-form" action="{{url('reassign_engineer',['ticket_id'=>$ticket->ticket_id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Reassign{{$ticket->ticket_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Reassign{{$ticket->ticket_id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Reassign{{$ticket->ticket_id}}Label"><span style="color:blue;text-align:right"><strong>Ticket Reassignment Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's ID: </strong></label>
                            <input type="number" name="ID" placeholder="Client's ID on ERP" value="{{  $ticket->id }}" readonly required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
                            <input type="text" name="name" placeholder="Client's Name" value="{{  $ticket->client_name }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Email:</strong></label>
                            <input type="text" name="email" placeholder="Client's Email" value="{{  $ticket->client_email }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Phone No:</strong></label>
                            <input type="text" name="phone" placeholder="Client's Number" value="{{  $ticket->client_phone }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Address:</strong></label>
                            <input type="text" name="address" placeholder="Client's Address" value="{{  $ticket->client_address }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Account Manager</strong></label>
                            <select required name="acct_manager_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Account Manager ---</option>
                                @foreach($marketers as $marketer)
                                <option value="{{$marketer->id}}" id="acct_manager_id">{{$marketer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Resolution Type?</strong></label>
                            <select required name="resolution" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Fault Status ---</option>
                                <option>Remote</option>
                                <option>Field</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault:</strong></label>
                            <input type="text" name="fault" value="{{  $ticket->fault }}" placeholder="What's the issue" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Status</strong></label>
                            <select required name="fault_level" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Fault Status ---</option>
                                <option>Norminal</option>
                                <option>Critical</option>
                                <option>Highly Critical</option>
                                <option>Catastrophic</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Level</strong></label>
                            <select required name="fault_type" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Fault Level ---</option>
                                <option value="1st">1st Level (Support)</option>
                                <option value="2nd">2nd Level (Service Operations)</option>
                                <option value="3rd">3rd Level (NOC)</option>
                                <option value="4th">4th Level (Core Network)</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Previously Assigned to:</strong></label>
                            <input type="text" disabled placeholder="Previous Engineer" value="{{  $ticket->first_engr }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="text" hidden name="prev_engr_id" placeholder="Client's Email" value="{{  $ticket->first_engr_id }}" required class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="col-6 col-sm-6 py-2">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Reassign Engineer</strong></label>
                            <select required name="first_engr_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Reassign Engineer ---</option>
                                @foreach($engineers as $engineer)
                                <option value="{{$engineer->id}}" id="first_engr_id">{{$engineer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 py-2" data-wow-delay="300ms">
                            <label class="formText" style="font-size:20px"><strong>Reason for Reassignment:</strong></label>
                            <textarea required name="reason" rows="1" placeholder="Specify the details  of the client's complaint" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            {{ $ticket->reassignment_reason }}
                            </textarea>
                        </div>

                        <div class="col-12 py-2" data-wow-delay="300ms">
                            <label class="formText" style="font-size:20px"><strong>Details of Fault:</strong></label>
                            <textarea value="{{  $ticket->fault_details }}" required name="details" id="comment" rows="1" placeholder="Specify the details  of the client's complaint" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            {{ $ticket->fault_details }}
                            </textarea>
                        </div>



                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="form-group" action="{{url('change-survey-status',['survey_id'=>$client->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Suspend{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Suspend{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Suspend{{$client->id}}Label"><span style="color:blue;align:right"><strong >Change Survey Status<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's Name: </strong></label>
                        <input type="text"  value="{{$client->clients}}" disabled
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Contact Person:</strong></label>
                        <input type="text" readonly value="{{ old('contact_person_name', $client->contact_person_name) }}" placeholder="Contact Person Name"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Email:</strong></label>
                        <input type="text" disabled value="{{ old('customer_email', $client->customer_email) }}" placeholder="Customer Email"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Phone Number:</strong></label>
                        <input type="text" disabled value="{{ old('phone', $client->phone) }}" placeholder="Contact Number"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                  
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Address:</strong></label>
                        <input type="text" disabled value="{{ old('address', $client->address) }}" placeholder="Address"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Status:</strong></label>
                        <select name="status" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="">--- Change Survey Status ---</option>
                            <option value="Suspended">Suspend</option>
                            <option value="Not Paid">Unsuspend</option>
                        </select>
                    </div>

                    <div class="form-group name2 col-md-12">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Reason?</strong></label>
                        <textarea type="text" name="comment" placeholder="Why are you suspending this survey?" 
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            {{$client->additional_info }}
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
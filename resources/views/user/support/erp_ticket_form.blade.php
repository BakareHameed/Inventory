<form class="form-group" action="{{url('submit_field_support_form')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="RaiseTicket{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RaiseTicket{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="RaiseTicket{{$client->id}}Label"><span style="color:blue;align:right"><strong >Raise Client Ticket<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's ID: </strong></label>
                        <input type="number" name="ID"  placeholder="Client's ID on ERP" value="{{  $client->id }}" readonly  required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
                        <input type="text" name="name"  placeholder="Client's Name" value="{{  $client->clients }}" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Email:</strong></label>
                        <input type="text" name="email"  placeholder="Client's Email" value="{{  $client->customer_email }}" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Phone No:</strong></label>
                        <input type="text" name="phone"  placeholder="Client's Number" value="{{  $client->phone }}" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Address:</strong></label>
                        <input type="text" name="address"  placeholder="Client's Address" value="{{  $client->address }}" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Radio IP(AP/SM): </strong></label>
                        <input id="radio_ip" type="text" required name="radio_IP" placeholder="Enter ID of site..." value="{{  $client->AP }}/{{  $client->SM }}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP: </strong></label>
                        <input id="pop" type="text" required name="pop" placeholder="Enter ID of site..." value="{{  $client->pop }}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Time: </strong></label>
                        <input id="" type="time" required name="start_time" placeholder="Enter ID of site..." 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Date: </strong></label>
                        <input id="day" type="date" required name="start_day" placeholder="Enter Date" value="{{$today}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
                    <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Account Manager</strong></label>
                        <select required name="acct_manager_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">--- Account Manager ---</option>
                            @foreach($marketers as $marketer)
                                <option value="{{$marketer->id}}"  id="acct_manager_id" >{{$marketer->name}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault:</strong></label>
                        <input type="text" name="fault" placeholder="What's the issue"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
        
                    <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
                    <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Status</strong></label>
                        <select required name="fault_level"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">--- Fault Status ---</option>
                            <option>Norminal</option>
                            <option>Critical</option>
                            <option>Highly Critical</option>
                            <option>Catastrophic</option>
                        </select>
                    </div>
        
                    <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Level</strong></label>
                        <select required name="fault_type"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">--- Fault Level ---</option>
                            <option value="1st">1st Level (Support)</option>
                            <option value="2nd">2nd Level (Service Operations)</option>
                            <option value="3rd">3rd Level (NOC)</option>
                            <option value="4th">4th Level (Core Network)</option>
                        </select>
                    </div>

                    <div class="col-6 col-sm-6 py-2">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Initiation type?</strong></label>
                        <select required name="initiation" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                            <option value="">--- Select Initiation Type ---</option>
                            <option>Reactive</option>
                            <option>Proactive</option>
                        </select>
                    </div>
        
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <label class="formText" style="font-size:20px"><strong>Details of Fault:</strong></label>
                        <textarea required name="details" id="comment" rows="6" placeholder="Specify the details  of the client's complaint"
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
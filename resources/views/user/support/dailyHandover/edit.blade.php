<form id="HandoverEdit" class="form-group" action="{{route('support.dailyHandover.edit',['id'=>$handover->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="EdidDailyHandover{{$handover->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EdidDailyHandover{{$handover->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EdidDailyHandover{{$handover->id}}Label"><span style="color:blue;align:right"><strong >Edit/Update Daily Handover<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client: </strong></label>
                        <input  type="text" required name="clients" placeholder="Enter client name..." id="clients" value="{{$handover->clients}}" disabled
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Issue: </strong></label>
                        <input id="" type="text" required name="issue" placeholder="Enter ID of site..." value="{{$handover->issue}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Radio IP(AP/SM): </strong></label>
                        <input id="radio_ip" type="text" required name="radio_IP" placeholder="Enter ID of site..." value="{{$handover->radio_IP}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP: </strong></label>
                        <input id="pop" type="text" required name="pop" placeholder="Enter ID of site..." value="{{$handover->pop}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Time: </strong></label>
                        <input id="" type="time" required name="start_time" placeholder="Enter ID of site..." value="{{Carbon\Carbon::parse( $handover->start_time)->format('H:i:s')}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Date: </strong></label>
                        <input id="day" type="date" required name="start_day" placeholder="Enter Date" value="{{Carbon\Carbon::parse( $handover->start_time)->format('Y-m-d')}}"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Status: </strong></label>
                        <select  type="text" onchange="statusChange({{$handover->id}},this)" name="status" id="status" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option>{{$handover->status}}</option>
                            <option>Resolved</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="resolved{{$handover->id}}" style="display: none">
                <div class="modal-header">
                    <h3 class="modal-title fs-5"><span style="color:blue;align:right"><strong >Update Handover<strong></span></h3>
                </div>
                <div class="row mt-2">
                    <hr></hr>
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Support's Findings: </strong></label>
                        <input  type="text"  name="findings" placeholder="What did you observe?"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Resolution(RCA): </strong></label>
                        <input  type="text"  name="resolution" placeholder="How was it resolved?"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Resolved By: </strong></label>
                        <select  type="text"  name="resolved_by" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option selected disabled>---Who Resolved it?---</option>
                            @foreach($resolvedBy as $resolever)
                                <option value="{{$resolever->id}}">{{ $resolever->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>End Time: </strong></label>
                        <input id="end_time" type="time" name="end_time" placeholder="Enter ID of site..." 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>End Date: </strong></label>
                        <input type="date" id="end_day" name="end_day" placeholder="Enter Date" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>
            <div class="form-group name2 col-md-12">
                <label for="exampleInputEmail1## Heading ##" class="formText" align="center" style="font-size:20px"><strong>comment: </strong></label>
                <textarea  type="date" name="comment" placeholder="Do you have any comment?" rows="2" 
                class="txtarea form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $handover->comment}}</textarea>
            </div>
         
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="update" class="btn btn-primary" style="background-color:purple;">Update</button>
            </div>
            </div>
        </div>
    </div>
</form>
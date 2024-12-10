
<div class="modal fade" id="Details{{$ticket->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Details{{$ticket->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="Details{{$ticket->id}}Label"><span style="color:blue;align:right"><strong >POP Ticket Report<strong></span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
        </div>
        <div class="modal-body">
            <div style="margin: 20px;margin-bottom:0px">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                    Report on Field Support(<span class="text-gray-600">Ticket ID- {{ $ticket->tickets_id }} </span>)
                </h2>
            </div>
            
            <div class="py-12" >
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                            <div class="text-xl">
                                A comprehensive <strong><em> POP field support report</em></strong> for <span class="text-yellow-600">{{ $ticket->POP_name }}
                                </span>
                                located at 
                                <span class="text-yellow-600">{{ $ticket->address }}</span>, raised on  <span class="text-yellow-600">{{Carbon\Carbon::parse($ticket->created_at)->format('D, M j, Y g:i A')}}</span>, carried out by Engineer 
                                <span class="text-blue-600">{{$ticket->done_by }}</span> and reported on {{Carbon\Carbon::parse($ticket->submitted_at)->format('D, M j, Y g:i A')}}.
                            </div>
                            <div class="mt-8">
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <div class="font-bold pt-2">Fault</div>
                                        <div class="pt-3">{{ $ticket->fault }}</div>
                                    </div>
                                    <div>
                                        <div class="font-bold pt-2">Fault Type</div>
                                        <div class="pt-3">{{$ticket->fault_level }}</div>
                                    </div>
                                    <div>
                                        <div class="font-bold pt-2">Fault Level</div>
                                        <div class="pt-3">{{$ticket->fault_level }}</div>
                                    </div>
                                    <div>
                                        <div class="font-bold pt-2">Fault Status</div>
                                        <div class="pt-3">{{ $ticket->fault_type }}</div>
                                    </div>
                                   
                                    @if($ticket->prev_engr_id != null)
                                        <div>
                                            <div>
                                                <div class="font-bold pt-2">1st Assigned Engr:</div>
                                                <div class="pt-3">  {{ $ticket->first_engr }}</div>
                                            </div>
                                            <div class="font-bold pt-2">Second Assigned engineer:</div>
                                            <div class="pt-3">{{ $ticket->done_by }}</div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="font-bold pt-2">1st Assigned Engr:</div>
                                            <div class="pt-3">  {{ $ticket->done_by }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-12 grid grid-cols-4 mt-6">
                                <table class="border-collapse border table-auto w-full get-company">
                                    <tr>
                                        <th>Things Checked</th>
                                        <th>Status Report</th>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Cable State(Rx/Tx)</td>
                                        <td style="color: black; font:bold">{{ $ticket->cable_state }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Chain Balance</td>
                                        <td style="color: black; font:bold">{{ $ticket->chain_balance }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Radio State</td>
                                        <td style="color: black; font:bold">{{ $ticket->radio_state }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Connector State</td>
                                        <td style="color: black; font:bold">{{ $ticket->connector_state }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Cable Negotiation</td>
                                        <td style="color: black; font:bold">{{ $ticket->cable_neg }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: black; font:bold">Signal</td>
                                        <td style="color: black; font:bold">{{ $ticket->signal }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mt-8">
                                <div class="font-bold">RCA:</div>
                                <div class="pt-3">{{ $ticket->RCA }}</div>
                            </div>
                            <div class="mt-8">
                                <div class="font-bold">Resolution:</div>
                                <div class="pt-3">{{ $ticket->Resolution }}</div>
                            </div>
                            @if($ticket->additional != null)
                                <div class="mt-8">
                                    <div class="font-bold">Additional Comment:</div>
                                    <div class="pt-3">{{ $ticket->additional }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if( $ticket->status !=='Closed')
                <button type="button" onclick="closeTicket('{{ $ticket->tickets_id }}')" class="btn btn-primary ml-3" style="background-color:purple;">Close Ticket</button>
            @endif
        </div>

        <div class="modal-body" style="display: none" id="Close{{ $ticket->tickets_id }}">
            <div style="margin: 20px;margin-bottom:0px">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                    Close Ticket For POP Field Support(<span class="text-gray-600">Ticket ID- {{ $ticket->tickets_id }} </span>)
                </h2>
            </div>
            
            <form class="form-group" action="{{route('pops-ticket-form-closure',['id'=>$ticket->tickets_id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="py-12" >
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                                <div class="col-6 col-sm-6 py-2">
                                    <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Report Status?</strong></label>
                                    <select required name="initiation" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                        <option disabled selected>--- Select Report Status ---</option>
                                        <option>Accepted</option>
                                        <option>Rejected</option>
                                    </select>
                                </div>
            
                                <div class="col-12 py-2" data-wow-delay="300ms">
                                    <label class="formText" style="font-size:20px"><strong>Message To Engineer:</strong></label>
                                    <textarea required name="engr_message" id="comment" rows="6" placeholder="Specify the details  of the client's complaint"
                                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-success" style="background-color:lime;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
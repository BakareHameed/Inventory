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
                        Job Order (<span class="text-gray-600">{{$client->customer_id}}</span>)
                    </h2>
                </div>

                <div class="py-12" >
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div style="overflow-x:auto;" class="p-6 bg-white border-b border-gray-200">
                                <div class="text-xl">
                                    Comprehensive <strong><em> summary of Job Order raised</em></strong> for <span class="text-yellow-600">{{ $client->clients }}
                                    </span>
                                    located at 
                                    <span class="text-yellow-600">{{ $client->address }}</span>, raised on  <span class="text-yellow-600">{{Carbon\Carbon::parse($client->raised_on)->format('D, M j, Y g:i A')}}</span>, raised by Engineer 
                                    <span class="text-blue-600">{{$client->raised_by }}</span>.
                                </div>
                                <div class="mt-8">
                                    <div class="grid grid-cols-6 gap-12">
                                        <div class="col-md-12">
                                            <div class="font-bold">Site Engr:</div>
                                            <div class="pt-3">{{ $client->site_engr }}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="font-bold">Account Manager:</div>
                                            <div class="pt-2">{{ $client->acct_manager }}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="font-bold">Status:</div>
                                            <div class="pt-2">{{ $client->JO_status }}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div><strong>Tools/Materials Required </strong></div>
                            <div class="row col-12 col-xl-12 flex max-w-full">
                                
                                <div class="column">
                                    <table class="border-collapse border table-auto get-company ">
                                        <tr>
                                            <th style="color:black;">S/N</th>
                                        </tr>
                                        @foreach(explode(',', $client->items) as $items) 
                                            <tr>
                                                <td style="color:blue;">{{ $loop->iteration }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div style="overflow:hidden; width:35%" class="column">
                                    <table  class="border-collapse text-center  border table-auto w-full get-company">
                                        <tr >
                                            <th style="color:black;">Materials Needed</th>
                                        </tr>
                                        @foreach(explode(',', $client->items) as $items) 
                                            <tr>
                                                <td style="color:black;">{{ $items }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div style="overflow:hidden; width:10%" class="column">
                                    <table   class="border-collapse border table-auto w-full get-company">
                                        <tr>
                                            <th style="color:black;">Quantity</th>
                                        </tr>
                                        @foreach(explode(',', $client->qty) as $qty) 
                                            <tr>
                                                <td style="color:black;">{{ $qty }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div style="overflow:hidden; width:15%" class="column">
                                    <table class="border-collapse border table-auto w-full get-company">
                                        <tr>
                                            <th style="color:black;">Amount</th>
                                        </tr>
                                        @foreach(explode(',', $client->cost) as $cost) 
                                            <tr>
                                                <td style="color:black;">₦{{ $cost }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div style="overflow:hidden; width:20%" class="column">
                                    <table class="border-collapse border table-auto w-full get-company">
                                        <tr>
                                            <th style="color:black;">Store Remark</th>
                                        </tr>
                                        @foreach(explode(',', $client->store_remark) as $store_remark) 
                                            <tr>
                                                <td style="color:black;">{{ $store_remark }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                            </div>
                            
                           <div style="float:left;color:black">Total Amount: ₦<input style="color:blue;font:20px bold;" type="text" value="{{ number_format($client->sum) }}" id="totalcost" readonly /></div>

                            <div>
                                <div class="mt-5">
                                    <div class="font-bold">Edit Form:</div>
                                    <div class="pt-0"> <a type="button" class="btn btn-primary" id="btn" onclick="edit_form('{{ $client->id }}');" style="padding: 10px; color: white;background-color:black" href="#">Edit Form</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('JobOrder.edit_form')        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
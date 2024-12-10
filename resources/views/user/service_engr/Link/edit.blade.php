
@if(Route::currentRouteName() == 'linked.customers.search')
<form class="form-group" action="{{url('edit_radio_param',$client->service_id)}}" method="POST" enctype="multipart/form-data">

@else
<form class="form-group" action="{{url('edit_radio_param',$client->id)}}" method="POST" enctype="multipart/form-data">
@endif
    @csrf
    <div class="modal fade" id="Edit{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Edit{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Edit{{$client->id}}Label"><span style="color:blue;align:right"><strong >Edit Client's Link Information<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's Name: </strong></label>
                        <input readonly value="{{$client->clients}}" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Address:</strong></label>
                        <input readonly value="{{ old('address', $client->address) }}" placeholder="Address"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Service Type:</strong></label>
                        <input readonly value="{{ old('service_type', $client->service_type) }}" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Access Radio IP(AP):</strong></label>
                        <input type="text" name="access_radio_ip" placeholder="Access Radio IP(AP)" value="{{ old('access_radio_ip', $client->access_radio_ip) }}" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Sation Radio IP(SM):</strong></label>
                        <input type="text" name="station_radio_ip" placeholder="Station Radio IP(SM)" value="{{ old('station_radio_ip', $client->station_radio_ip) }}" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Port Number:</strong></label>
                        <input type="number" name="port" placeholder="Port the client is connected to" value="{{ old('port', $client->port) }}" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                  
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>VLAN ID:</strong></label>
                        <input type="text" name="vlan_id" value="{{ old('vlan_id', $client->vlan_id) }}" placeholder="What's the Client's VLAN ID?"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    {{-- <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Subnet Mask:</strong></label>
                        <input type="text" name="subnet_mask" value="{{ old('subnet_mask', $client->subnet_mask) }}" placeholder="What's the subnet mask?"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div> --}}

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP:</strong></label>
                        <select required name="pop"  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="{{ old('pop', $client->pop) }}"> {{$client->pop}}</option>
                             @foreach($pop as $pops)
                              <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
                           @endforeach 
                        </select>
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
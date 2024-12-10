<form class="form-group" action="{{url('customer_deactivation',$client->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Deactivate{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Deactivate{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Deactivate{{$client->id}}Label"><span style="color:blue;align:right"><strong >Deactivate Client<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client ID: </strong></label>
                        <input id="" type="text" required name="client_id" value="{{$client->id}}" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client: </strong></label>
                        <input id="" type="text" required name="client" value="{{ $client->clients }}" placeholder="Enter ID of site..." readonly value=""
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client Status: </strong></label>
                        <select  type="text" required name="status" placeholder="Enter client name..." id="clients"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option disabled selected>---Select Status---</option>
                            <option>Inactive</option>
                            <option>Suspended</option>
                            <option>Relocation</option>
                            <option>One Time</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 py-2 " data-wow-delay="300ms">
                        <label for="date"><strong>Date</strong></label>
                        <input type="date" name="date" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
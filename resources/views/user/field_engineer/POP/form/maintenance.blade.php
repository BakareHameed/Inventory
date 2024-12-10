<form class="form-group" name="POPMaintenance" action="{{route('pop.maintenance.form',['ticket_id'=>$ticket->tickets_id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="maintenanceForm{{$ticket->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="maintenanceForm{{$ticket->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="maintenanceForm{{$ticket->id}}Label"><span style="color:blue;text-align:right"><strong>POP Maintenance Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Name:</strong></label>
                            <input disabled value="{{$ticket->POP_name}}" placeholder="POP name"  disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Address:</strong></label>
                            <input disabled value="{{$ticket->address}}" placeholder="POP name"  disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>RCA:</strong></label>
                            <input name="rca" placeholder="What was the root cause?"  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Resolution:</strong></label>
                            <input name="resolution" placeholder="How was it resolved?"  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Radio State:</strong></label>
                            <select name="radio_state" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select state of the radio? ---</option>
                                <option>Good </option>
                                <option>Bad</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Cable State:</strong></label>
                            <select name="cable_state" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select state of the cable? ---</option>
                                <option>Good </option>
                                <option>Bad</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Connector State:</strong></label>
                            <select name="connector_state" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select state of the connector? ---</option>
                                <option>Good </option>
                                <option>Rusted</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Cable Negotiation</strong></label>
                            <select required name="cable_neg" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select cable Negotiation? ---</option>
                                <option>Full Duplex</option>
                                <option>Half Duplex</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Chain Balance:</strong></label>
                            <input type="number" name="chain_balance" placeholder="e.g 0,1,etc."  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Signal Level:</strong></label>
                            <input type="number" name="signal" placeholder="e.g 40,50,etc."  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <hr style="border:1px solid black;" class="form-group name2 col-md-11">
                        <div class="form-group name2 col-md-12">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Additional Info:</strong></label>
                            <textarea name="additional_info" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" rows="4">{{ $defaultValue ?? '' }}
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
    </div>
</form>
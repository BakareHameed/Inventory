<form class="form-group" action="{{ url('edit_pop', $pop->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Edit{{ $pop->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Edit{{ $pop->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Edit{{ $pop->id }}Label"><span
                            style="color:blue;align:right"><strong>Edit Base Station Details<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP Name: </strong></label>
                            <input type="text" name="POP_name" value="{{ old('POP_name', $pop->POP_name) }}"
                                placeholder="Enter the POP name"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Site ID: </strong></label>
                            <input type="text" required name="site_id" value="{{ old('site_id', $pop->site_id) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP Router:</strong></label>
                            <input type="text" required name="POP_router" placeholder="Router used at POP"
                                value="{{ old('POP_router', $pop->POP_router) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP Switch:</strong></label>
                            <input type="text" required name="POP_switch" placeholder="Switch used at POP"
                                value="{{ old('POP_switch', $pop->POP_switch) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Third Party Vendor:</strong></label>
                            <input type="number" required name="Third_Party_Vendor"
                                placeholder="Is there a third party vendor?"
                                value="{{ old('Third_Party_Vendor', $pop->Third_Party_Vendor) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Longitude:</strong></label>
                            <input type="text" name="Longitude" placeholder="What's the POP's Longitudinal position?"
                                required value="{{ old('Longitude', $pop->Longitude) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Latitude:</strong></label>
                            <input type="text" name="Latitude" placeholder="What's the POP's Latitudinal position?"
                                required value="{{ old('Latitude', $pop->Latitude) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Inverter Power:</strong></label>
                            <input type="text" name="Inverter_Power"
                                value="{{ old('Inverter_Power', $pop->Inverter_Power) }}"
                                placeholder="What's the value of the Inverter Power on site?" required
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Infrastructure Type:</strong></label>
                            <input type="text" name="Infrastructure_Type"
                                value="{{ old('Infrastructure_Type', $pop->Infrastructure_Type) }}"
                                placeholder="Type of infrastructure on site" required
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Date of Activation:</strong></label>
                            <input type="text" name="Activated_Date"
                                placeholder="What date was the site operational?" required
                                value="{{ old('Activated_Date', $pop->Activated_Date) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Tower Length:</strong></label>
                            <input type="text" name="Tower_Pole_Length" placeholder="Length of the POP tower"
                                required value="{{ old('Tower_Pole_Length', $pop->Tower_Pole_Length) }}"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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

<form class="form-group" action="{{ route('pop.routine.report') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="routineCheck{{ $pop->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="routineCheck{{ $pop->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="routineCheck{{ $pop->id }}Label"><span
                            style="color:blue;align:right"><strong>Routine Check Report<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP ID:</strong></label>
                            <input type="text" name="pop_id" placeholder="POP ID" value="{{ $pop->id }}"
                                readonly
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP:</strong></label>
                            <input type="text" name="POP_name" placeholder="Client's Project type"
                                value="{{ $pop->POP_name }}" readonly
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <label for="exampleInputEmail1## Heading ##" class="formText"
                            style="font-size:20px;margin-left:10px;color:blue"><strong>Report Details</strong></label>
                        <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                        </hr>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Chain Balance</strong></label>
                            <input type="text" name="chain_bal" placeholder="chain balance value..."
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Signal Level</strong></label>
                            <input type="text" name="signal_lvl" placeholder="signal level..."
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Cable Negotiation (Duplex)</strong></label>
                            <input type="text" name="cable_neg" placeholder="cable negotiation..."
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Cable State</strong></label>
                            <select name="cable_state"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select Cable State ---</option>
                                <option>Good</option>
                                <option>Bad</option>
                                <option>Critical</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Radio State</strong></label>
                            <select
                                name="radio_state"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="" disabled selected>--- Select Radio State ---</option>
                                <option>Good</option>
                                <option>Bad</option>
                                <option>Critical</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Connector State</strong></label>
                            <select
                                name="connector_state"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="" disabled selected>--- Select Connector State ---</option>
                                <option>Intact</option>
                                <option>Rusted</option>
                            </select>
                        </div>

                        <div class="float-left row col-md-12">
                            <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                            </hr>
                            <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                    style="font-size:20px"><strong>Power Information </strong></label>
                                <div class="card-body">
                                    <div class="row">
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Primary Source Voltage:</strong></label>
                                        <div class="form-group name2 row col-md-12">
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>L-N:</strong></label>
                                                <input type="text" name="LN"
                                                    placeholder="Live to Neutral parameter"
                                                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>L-E:</strong></label>
                                                <input type="text" name="LE"
                                                    placeholder="Live to Earthen parameter"
                                                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>E-N:</strong></label>
                                                <input type="text" name="EN"
                                                    placeholder="Earthen to Neutral parameter"
                                                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                        </div>

                                        <div class="form-group name2 col-md-3">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Earthen Availability</strong></label>
                                            <select name="earthen"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="">--- Select answer ---</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <div class="form-group name2 col-md-3">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Power Extension</strong></label>
                                            <select name="power_ext"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="" disabled selected>--- Select answer ---</option>
                                                <option>Surge Protector</option>
                                                <option>None</option>
                                            </select>
                                        </div>

                                        <div class="form-group name2 col-md-3">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Equipment Housing</strong></label>
                                            <select name="eqp_housing"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="" disabled selected>--- Select Type ---</option>
                                                <option>Cabinet</option>
                                                <option>Shelter</option>
                                            </select>
                                        </div>

                                        <div class="form-group name2 col-md-3">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Power Backup</strong></label>
                                            <select name="power_bckp"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="">--- Select answer ---</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                            </hr>
                            <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                    style="font-size:20px"><strong>Additional Information </strong></label>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Attachments
                                                </strong> <span class="font-size:10px;font-weight:200">(You can select
                                                    multiple
                                                    Pics.)</span></label>
                                            <input type="file" name="attachments[]" multiple accept="image/*"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                        </div>
                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Any Suggestion Or
                                                    Observation?</strong></label>
                                            <textarea name="additional_info"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm
                                                 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                                  focus:ring-opacity-50 main-form"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

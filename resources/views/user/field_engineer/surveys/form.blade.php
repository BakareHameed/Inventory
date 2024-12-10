<form class="form-group" name="surveyForm{{ $client->id }}" action="{{ url('survey_report_form', ['id' => $client->id]) }}"
    method="POST" enctype="multipart/form-data" onsubmit="return validateForm('{{ $client->id }}')">
    @csrf
    <div class="modal fade" id="Raise{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Raise{{ $client->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Raise{{ $client->id }}Label"><span
                            style="color:blue;text-align:right"><strong>Survey Report Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Client's Name:</strong></label>
                            <input type="text" name="name" placeholder="Client's Name"
                                value="{{ $client->clients }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Project:</strong></label>
                            <input type="text" name="service_type" placeholder="Client's Project type"
                                value="{{ $client->service_type }}" disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-12">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Contact Person/Phone:</strong></label>
                            <input type="text" value="{{ $client->contact_person_name }}/{{ $client->phone }}"
                                disabled
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 ml-4  text-center col-ml-6">
                            <label class="inline-flex items-center pr-24">
                                <input type="radio"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                    onChange = "feasibility(0,'{{ $client->id }}');" id="feas{{ $client->id }}"
                                    name="feasibility[]" value="Feasible" />
                                <span class="ml-2">It's feasible</span>
                            </label>

                            <label class="inline-flex items-right pr-24 ">
                                <input type="radio"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                    onChange = "feasibility(1,'{{ $client->id }}');" id="nofeas{{ $client->id }}"
                                    name="feasibility[]" value="Not feasible" />
                                <span class="ml-2">Not Feasible</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="{{ $client->id }}" style="display:none">
                    <div class="form-group name2 row col-md-12">
                        <div class="form-group name2 col-md-6 ml-0">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Remote Latitude:</strong></label>
                            <input type="text" name="rem_latitude" placeholder="Remote latitude of the location"
                                class="form-control @error('name') is-invalid @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Remote Longitude:</strong></label>
                            <input type="text" name="rem_longitude" placeholder="Remote longitude of location"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <label for="exampleInputEmail1## Heading ##" class="formText"
                            style="font-size:20px;margin-left:10px;color:blue"><strong>Site Details</strong></label>
                        <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                        </hr>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Site Latitude:</strong></label>
                            <input type="text" name="latitude" placeholder="Actual Latitude of the location"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Site Longitude:</strong></label>
                            <input type="text" name="longitude" placeholder="Actual Longitude of location"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Building Height:</strong></label>
                            <input type="text" name="building_height"
                                placeholder="What's the main building height"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>POP Distance:</strong></label>
                            <input type="text" name="distance_from_pop" placeholder="Distance from Pop"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Line of Sight?</strong></label>
                            <select name="los"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Choose an answer ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Suitable Pole location:</strong></label>
                            <select
                                name="suitable_loc"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select Platform ---</option>
                                <option>Rooftop</option>
                                <option>Water Tank Stand</option>
                                <option>By the wall/Fence</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Suitable Pole location's Pics.(png,jpg or
                                    jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" name="pole_image[]" multiple accept="image/*"
                                placeholder="Site picture before casting"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Casting Requirement:</strong></label>
                            <select onchange="Casting(this,'{{ $client->id }}');" id="required_casting"
                                name="required_casting"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">--- Is Casting Required?---</option>
                                <option value="Required">Yes</option>
                                <option value="Not Required">No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6" id="Required{{ $client->id }}"
                            style="display:none;">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Casting Environment's Pics(png,jpg or
                                    jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" name="image[]" multiple accept="image/*"
                                placeholder="Site picture before casting"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Materials Required </strong></label>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <table class="table table-bordered" id = "tb2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Materials</th>
                                                    <th>Qty</th>
                                                    <th style="text-align:center"><a href="#"
                                                            class="btn btn-warning addRow">+</a></th>
                                                </tr>
                                            </thead>
                                            <tbody class="materials">
                                                <tr>
                                                    <td></td>
                                                    <td><input type="text" name="material[]"
                                                            class="form-control" /></td>
                                                    <td><input type="text" name="quantity[]"
                                                            class="form-control" /></td>
                                                    <th style="text-align:center"><a href="#"
                                                            class="btn btn-danger removeRow">-</a></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Cable Length Breakdown:</strong></label>
                                        <div class="form-group name2 row col-md-12">
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>Vertical length:</strong></label>
                                                <select onchange="calculate('{{ $client->id }}')"
                                                    id="vert_cable_length{{ $client->id }}"
                                                    name="vert_cable_length"
                                                    class="client_cable{{ $client->id }}1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="0">--- Vertical cable length?---</option>
                                                    <option value="3">3m</option>
                                                    <option value="6">6m</option>
                                                    <option value="9">9m</option>
                                                    <option value="12">12m</option>
                                                    <option value="15">15m</option>
                                                </select>
                                            </div>
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>Horizontal length:</strong></label>
                                                <select onchange="calculate('{{ $client->id }}')"
                                                    id="horiz_cable_length{{ $client->id }}"
                                                    name="horiz_cable_length"
                                                    class="client_cable{{ $client->id }}2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="0">--- Horizontal cable length?---</option>
                                                    <option value="3">3m</option>
                                                    <option value="6">6m</option>
                                                    <option value="9">9m</option>
                                                    <option value="12">12m</option>
                                                    <option value="15">15m</option>
                                                </select>
                                            </div>
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>Excess cable length
                                                        required:</strong></label>
                                                <select onchange="calculate('{{ $client->id }}')"
                                                    id="excess_cable_length{{ $client->id }}"
                                                    name="excess_cable_length"
                                                    class="client_cable{{ $client->id }}3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="0">--- langth of excess cable?---</option>
                                                    <option value="3">3m</option>
                                                    <option value="6">6m</option>
                                                    <option value="9">9m</option>
                                                    <option value="12">12m</option>
                                                    <option value="15">15m</option>
                                                </select>
                                            </div>
                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>Other additonal cable
                                                        length?</strong></label>
                                                <input onkeyup="calculate('{{ $client->id }}')" type="number"
                                                    name="additional_length" id="others{{ $client->id }}"
                                                    placeholder="Any other additional cable length required?"
                                                    class="client_cable{{ $client->id }}4 form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>

                                            <div class="form-group name2 col-md-4">
                                                <label for="exampleInputEmail1## Heading ##" class="formText"
                                                    style="font-size:20px"><strong>Total Length Required
                                                    </strong></label>
                                                <input type="text" readonly id="result{{ $client->id }}"
                                                    style="background-color:white;color:blue;"
                                                    placeholder="Any other additional cable length required?"
                                                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                        </hr>
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Closest Base Stations:</strong></label>
                            <select multiple name="base_stations[]"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select Base station ---</option>
                                @foreach ($pop_name as $pops)
                                    <option value="{{ $pops->POP_name }}" name="pop" id="pop">
                                        {{ $pops->POP_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Additional Info:</strong></label>
                            <textarea name="additional_info"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form"
                                rows="4">{{ $defaultValue ?? '' }}
                            </textarea>
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

                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Secondary Source
                                                    Voltage:</strong></label>
                                            <input type="text" name="sec_src_volt"
                                                placeholder="What is the secondary voltage source? e.g generator,etc"
                                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Availability of UPS?</strong></label>
                                            <select name="ups"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="">--- Select answer ---</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>UPS power rating/current load
                                                    (%):</strong></label>
                                            <input type="text" name="ups_power"
                                                placeholder="UPs power rating parameter"
                                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>

                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Power Extension?</strong></label>
                                            <select name="power_ext"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="">--- Select answer ---</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <div class="form-group name2 col-md-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Conducive Environment?</strong></label>
                                            <select name="env"
                                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                                <option value="">--- Select answer ---</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body" id="no_fease{{ $client->id }}" style="display:none">
                    <div class="row mt-3">
                        <div class="form-group name2 col-md-12 text-center float-left">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Why?</strong></label>
                            <textarea name="reason"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form"
                                rows="4">{{ $defaultValue ?? '' }}
                            </textarea>
                        </div>

                        <div class="form-group name2 col-md-12 text-center float-left">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Pictoral Evidence(png,jpg or jpeg):</strong><span
                                    style="color:red;font-size:15px">*</span></label>
                            <input type="file" name="non_feasibility_proof[]" multiple accept="image/*"
                                placeholder="Non fasibility picture"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" />
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
    </div>
</form>

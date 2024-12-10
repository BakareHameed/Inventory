<form class="form-group" name="fibreForm{{ $client->id }}"
    action="{{ url('survey_report_form', ['id' => $client->id]) }}" method="POST" enctype="multipart/form-data"
    onsubmit="return validateFormFibre('{{ $client->id }}')">
    @csrf
    <div class="modal fade" id="Fibre{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Fibre{{ $client->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Fibre{{ $client->id }}Label"><span
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
                                    onChange = "feasibility(0,'{{ $client->id }}');"
                                    id="feas{{ $client->id }}Fibre" name="feasibility[]" value="Feasible" />
                                <span class="ml-2">It's feasible</span>
                            </label>

                            <label class="inline-flex items-right pr-24 ">
                                <input type="radio"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                    onChange = "feasibility(1,'{{ $client->id }}');"
                                    id="nofeas{{ $client->id }}Fibre" name="feasibility[]" value="Not feasible" />
                                <span class="ml-2">Not Feasible</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="{{ $client->id }}Fibre" style="display:none">
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
                                                <td><input type="text" name="material[]" class="form-control" /></td>
                                                <td><input type="text" name="quantity[]" class="form-control" /></td>
                                                <th style="text-align:center"><a href="#"
                                                        class="btn btn-danger removeRow">-</a></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <div>
                                        <label for="exampleInputEmail1## Heading ##" class="formText"
                                            style="font-size:20px"><strong>Cable Length Breakdown:</strong></label>
                                    </div>

                                    <div class="d-flex ">
                                        <div class="form-group name2 col-lg-12 col-md-6 col-sm-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Cable Length?
                                                    length?</strong></label>
                                            <input onkeyup="sumCable('{{ $client->id }}')" type="number"
                                                name="additional_length" id="cable_length{{ $client->id }}"
                                                placeholder="Cable length required"
                                                class="client_cable{{ $client->id }}4 form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>

                                        <div class="form-group name2 col-lg-12  col-md-6 col-sm-6">
                                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                                style="font-size:20px"><strong>Total Length Required
                                                </strong></label>
                                            <input type="text" readonly id="length{{ $client->id }}"
                                                style="background-color:white;color:blue;" placeholder="Total Sum"
                                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body" id="no_fease{{ $client->id }}Fibre" style="display:none">
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
    </div>
</form>

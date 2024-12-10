<form class="form-group" action="{{url('client-job-completion-form',['id'=>$client->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Raise{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Raise{{$client->id}}Label"><span style="color:blue;text-align:right"><strong>Job Completion Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body mt-3">
                    <strong><input style="color:white;font:20px bold;background-color:gray;" type="text" value="CONTACT DETAIL" readonly /></strong>
                    <div class="row mt-2 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
                            <input type="text" name="name" placeholder="Client's Name" value="{{  $client->clients }}" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Project:</strong></label>
                            <input type="text" name="service_type" placeholder="Client's Project type" value="{{  $client->service_type }}" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-12">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Contact Person/Phone:</strong></label>
                            <input type="text" value="{{  $client->contact_person_name }}/{{  $client->phone }}" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-12">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Scope of work:</strong></label>
                            <input type="text" name="SoW" required placeholder="What's the scope of the job done?" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Pole installation location:</strong></label>
                            <select required name="pole_loc" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select Platform ---</option>
                                <option>Rooftop</option>
                                <option>Water Tank Stand</option>
                                <option>By the wall/Fence</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Pictoral Evidence of Pole location's(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" required name="pole_img[]" multiple accept="image/*" placeholder="Site picture before casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Casting:</strong></label>
                            <select required onchange="Casting(this,'{{$client->id}}');" id="required_casting" name="casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">--- Was Casting done?---</option>
                                <option value="Done">Yes</option>
                                <option value="Not Done">No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6" id="Required{{$client->id}}" style="display:none;">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Casting Evidence Pics(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" name="cast_img[]" multiple accept="image/*" placeholder="Site picture before casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Outdoor Picture(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" required name="outdoor_img[]" multiple accept="image/*" placeholder="Picture of outdoor cable or devices" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Indoor cable Picture(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" required name="indoor_img[]" multiple accept="image/*" placeholder="Indoor cable picture" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Cable Path Picture(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                            <input type="file" required name="path_img[]" multiple accept="image/*" placeholder="Picture of cable path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <strong><input style="color:white;font:20px bold;background-color:gray;" type="text" value="EQUIPMENT INSTALLED" readonly /></strong>
                    <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-bordered" id="tb2">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Materials</th>
                                                <th>Qty</th>
                                                <th>Remark</th>
                                                <th style="text-align:center"><a href="#" class="btn btn-warning addRow">+</a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="materials">
                                            <tr>
                                                <td></td>
                                                <td><input required type="text" name="material[]" class="form-control" /></td>
                                                <td><input required type="text" name="qty[]" class="form-control" /></td>
                                                <td><input required type="text" name="remark[]" class="form-control" /></td>
                                                <th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-0.5">
                        <div class="form-group name2 row col-md-12">
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>L-N:</strong></label>
                                <input type="number" required name="LN" placeholder="Live to Neutral parameter in V,e.g. 220" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>L-E:</strong></label>
                                <input type="number" required name="LE" placeholder="Live to Earthen parameter in V,e.g. 220 " class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="form-group name2 col-md-4">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>E-N:</strong></label>
                                <input type="number" required name="EN" placeholder="Earthen to Neutral parameter in V,e.g. 0" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="form-group name2 col-md-6">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Power Source Picture(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                                <input type="file" required name="power_img[]" multiple accept="image/*" placeholder="Picture of Power Source" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-body">
                    <strong><input style="color:white;font:20px bold;background-color:gray;" type="text" value="RECOMMENDATION" readonly /></strong>
                    <div class="row mt-0.5">
                        <div class="form-group name2 col-md-6 text-center">
                            <label style="float:left;" for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Any recommendation?</strong></label>
                            <textarea name="recommendation" placeholder="What do you think is needed that wasn't done on site?" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" rows="3">{{ $defaultValue ?? '' }}
                            </textarea>
                        </div>
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Activation Status?</strong></label>
                            <select row="3" required name="activation_status" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Select answer ---</option>
                                <option>Up and running</option>
                                <option>Not yet optimal</option>
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
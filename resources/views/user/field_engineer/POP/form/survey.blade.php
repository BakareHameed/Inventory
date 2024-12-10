<form class="form-group" name="POPSurvey" action="{{route('engr.pop.survey.form',['id'=>$survey->id ])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="POPSurveyReport{{$survey->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="POPSurveyReport{{$survey->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="POPSurveyReport{{$survey->id}}Label"><span style="color:blue;text-align:right"><strong>POP Survey Report<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Name:</strong></label>
                            <input disabled value="{{$survey->POP_name}}" placeholder="POP name"  disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Contact/Phone:</strong></label>
                            <input disabled value="{{$survey->contact}}-{{$survey->phone}}" placeholder="POP contact personnel" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-12">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Address:</strong></label>
                            <input value="{{$survey->address}}" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row mt-3">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px;margin-left:10px;color:blue"><strong>POP Details</strong></label>
                        <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                        </hr>

                        <div class="form-group name2 row col-md-12">
                            <div class="form-group name2 col-md-6 ml-0">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP coordinate(Latitude):</strong></label>
                                <input type="number" value="{{$survey->Latitude}}" name="latitude" placeholder="latitude of the location" class="form-control @error('latitude') is-invalid @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
    
                            <div class="form-group name2 col-md-6">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP coordinate(Longitude) :</strong></label>
                                <input type="number" value="{{$survey->Longitude}}" name="longitude" placeholder="longitude of location" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Height:</strong></label>
                            <input type="text" name="height" placeholder="Height of the POP Tower" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Distance:</strong></label>
                            <input type="text" name="distance" placeholder="Distance of POP from refrerence" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Power Stability:</strong></label>
                            <select name="power_stability" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Is Power stable? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Usability:</strong></label>
                            <select name="pop_usability" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Is POP usable? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Tower top space</strong></label>
                            <select name="tower_top" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Is there space on tower? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Line of Sight:</strong></label>
                            <select name="loS" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- is there line of sight? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Location Security:</strong></label>
                            <select name="loc_sec" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Are there thugs or other security threats? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP feasibility to each other:</strong></label>
                            <select onchange="feasPOPs(this)" name="feasibillity" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Is it feasible to any other POP? ---</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>

                        <div id="POPfeas" style="display :none" class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Feasibile to?</strong></label>
                            <select id="feasible_pops" name="feasible_pops[]" multiple class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                                <option value="">--- Is it feasible to any other POP? ---</option>
                                @foreach($pop as $pops)
                                    <option>{{$pops->POP_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="float-left row col-md-12">
                            <hr style="border:1px solid black;" class="form-group name2 col-md-12">
                            <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Pictorial Information</strong></label>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group name2 row col-md-12">
                                            <div class="form-group name2 col-md-6">
                                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Height Pics.(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                                                <input type="file" name="height_pic[]" multiple accept="image/*" placeholder="Site picture before casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                            </div>
                                            <div class="form-group name2 col-md-6">
                                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Line of sightPics.(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                                                <input type="file" name="los_pic[]" multiple accept="image/*" placeholder="Site picture before casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                            </div>
                                            <div class="form-group name2 col-md-6">
                                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Tower Top Space Pics.(png,jpg or jpeg):</strong><span style="color:red;font-size:15px">*</span></label>
                                                <input type="file" name="tower_space_pic[]" multiple accept="image/*" placeholder="Site picture before casting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                            </div>
                                            <div class="form-group name2 col-md-6">
                                                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Location Suitability Pics (png,jpg or jpeg):</strong></label>
                                                <input type="file" name="suitable_loc[]" multiple accept="image/* placeholder="What is the secondary voltage source? e.g generator,etc" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<form class="form-group" action="{{url('job-order-form-submit',['id'=>$client->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Raise{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Raise{{$client->id}}Label"><span style="color:blue;align:right"><strong >Job Order Form<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's ID: </strong></label>
                            <input type="number" name="ID"  placeholder="Client's ID on ERP" value="{{  $client->id }}" disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
                            <input type="text" name="name"  placeholder="Client's Name" value="{{  $client->clients }}" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Email:</strong></label>
                            <input type="text" name="email"  placeholder="Client's Email" value="{{  $client->customer_email }}" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Phone No:</strong></label>
                            <input type="text" name="phone"  placeholder="Client's Number" value="{{  $client->phone }}" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Address:</strong></label>
                            <input type="text" name="address"  placeholder="Client's Address" value="{{  $client->address }}" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Building:</strong></label>
                            <input type="text" name="address"  placeholder="Client's Address" value="{{  $client->building_height }}" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Distance:</strong></label>
                            <input type="text" name="address"  placeholder="Client's Address" value="{{  $client->distance_from_pop }}({{  $client->base_stations }})" required disabled
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2 col-md-6" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Account Manager</strong></label>
                            <select required name="acct_manager_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="{{$client->marketer_id}}">{{$client->marketer_name}}</option>
                                @foreach($marketers as $marketer)
                                    <option value="{{$marketer->id}}"  id="acct_manager_id" >{{$marketer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-sm-4 py-2" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Service Plan:</strong><span style="color:red;font-size:15px">*</span></label>
                            <select readonly  id="service_plan" name="service_plan"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="{{$client->service_type}}">{{$client->service_type}}</option>
                            </select>
                        </div>

                        <div class="form-group name2 py-2 col-md-4">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Installation Platform:</strong></label>
                            <select required name="installation"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="">--- Assign Engineer ---</option>
                                    <option>Rooftop</option>
                                    <option>Water Tank Stand</option>
                                    <option>By the wall/Fence</option>
                            </select>
                        </div>

                        <div class="form-group name2 py-2 col-md-4">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Installation Standard</strong></label>
                            <select required name="installation_standard"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="">--- Select installation standard ---</option>
                                    <option>Standard</option>
                                    <option>Non-Standard</option>
                                    <option>Non-Standard Plus</option>
                                    <option>Dedicated Setup</option>
                                    <option>Fibre</option>

                            </select>
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Building Floor</strong></label>
                            <input type="text" name="building_floor"  placeholder="e.g., ground floor, top floor,etc." required
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Building Type</strong></label>
                            <input type="text" name="building_type"  placeholder="e.g., A storey, 2 Storey, Bungalow,etc." required
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Project duration(days)</strong></label>
                            <input type="number" name="project_time"  placeholder="e.g., 1 , 2 etc. " required
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Site Engineer</strong></label>
                            <select required name="field_engr_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="">--- Assign Engineer ---</option>
                                @foreach($engineers as $engineer)
                                    <option value="{{$engineer->id}}"  id="first_engr_id" >{{$engineer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Engr's Bank</strong></label>
                            <select required name="engr_bank"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                                <option value="">--- Select Engineer's Bank ---</option>
                                <option>GTB</option>
                                <option>Access Bank</option>
                                <option>First Bank</option>
                                <option>Zenith Bank</option>
                                <option>UBA</option>
                                <option>Stanbic IBTC</option>
                                <option>OPAY</option>
                                <option>Polaris Bank</option>
                                <option>Union Bank</option>
                                <option>Diamond Bank</option>
                                <option>Petty Cash</option>
                            </select>
                        </div>

                        <div class="form-group name2  py-2 col-md-4" >
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Engr's Acct. No.</strong></label>
                            <input type="number" name="eng_acct_no"  placeholder="Engineer's Account No." required
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    
                        <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Tools/Materials Required </strong></label><span style="float:right;color:black">Total Amount: ₦<input style="color:blue;font:20px bold;" type="text" name="sum" class="totalcost" readonly /></span>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <table class="table table-bordered" id = "tb2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Amount(₦)</th>
                                                    <th>Store Remark</th>
                                                    <th style="text-align:center"><a href="#" class="btn btn-warning" onclick="addRow('{{$client->id}}')">+</a></th>
                                                </tr>
                                            </thead>
                                            <tbody class="item" id="{{$client->id}}">
                                                <tr>
                                                    <td></td>
                                                    <td><input required type="text" name="item[]" class="form-control"/></td>
                                                    <td><input required type="text" name="qty[]" class="form-control"/></td>
                                                    <td><input required type="number" onkeyup="findTotal(this,'{{$client->id}}')" name="amount[]" class="form-control amount"/></td>
                                                    <td><input required type="text" name="store_remark[]" class="form-control"/></td>
                                                    <th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5">Total</th>
                                                    <td id="totalcost"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
            </div>
            </div>
        </div>
    </div>
</form>
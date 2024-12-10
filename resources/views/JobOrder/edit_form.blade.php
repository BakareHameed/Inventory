<form class="main-form"  action="{{url('edit-job-order',['client_id'=>$client->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-12 col-xl-12 py-2 show_form" style="display:none" id="edit{{$client->id}}">
    <div class="row mt-5 ">
        <div class="form-group name2 col-md-6">
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's ID: </strong></label>
            <input type="number" name="ID"  placeholder="Client's ID on ERP" value="{{  $client->id }}" disabled
            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div class="form-group name2 col-md-6">
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
            <input type="text" name="clients"  placeholder="Client's Name" value="{{  $client->clients }}" required disabled
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
            <input type="text" name="building_height"  placeholder="Client's Address" value="{{  $client->building_height }}" required disabled
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
                <option value="">--- Account Manager ---</option>
                @foreach($marketers as $marketer)
                    <option value="{{$marketer->id}}"  id="acct_manager_id" >{{$marketer->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group name2 col-md-6" >
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
                <option>OPAY</option>
                <option>Stanbic IBTC</option>
                <option>Polaris Bank</option>
                <option>Union Bank</option>
                <option>Diamond Bank</option>
                <option>Petty Cash</option>
            </select>
        </div>

        <div class="form-group name2  py-2 col-md-4" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Engr's Acct. No.</strong></label>
            <input type="number" name="eng_acct_no"  placeholder="Engineer's Account No." 
            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        
        <div class="form-group name2 col-xl-12" data-wow-delay="300ms">
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Tools/Materials Required </strong></label><span style="float:right;color:black">Total Amount: ₦<input style="color:blue;font:20px bold;" type="text" name="sum" id="totalcost" readonly /></span>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
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
                            <tbody class="item">
                                <tr>
                                    <td></td>
                                    <td><input required type="text" name="item[]" class="form-control"/></td>
                                    <td><input required type="text" name="qty[]" class="form-control"/></td>
                                    <td><input required type="number" onblur="findTotal()" name="amount[]" class="form-control amount"/></td>
                                    <td><input required type="text" name="store_remark[]" class="form-control"/></td>
                                    <th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
    </div>
</form>  
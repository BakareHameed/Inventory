<form class="form-group" action="{{url('base_station_creation')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CreateLabel"><span style="color:blue;align:right"><strong >Create New Base Station<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Name: </strong></label>
                        <input type="text" name="POP_name" placeholder="Enter the POP name"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Site ID: </strong></label>
                        <input type="text" required name="site_id" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Router:</strong></label>
                        <input type="text" required name="POP_router" placeholder="Router used at POP"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP Switch:</strong></label>
                        <input type="text" required name="POP_switch" placeholder="Switch used at POP"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Third Party Vendor:</strong></label>
                        <input type="number" required name="Third_Party_Vendor" placeholder="Is there a third party vendor?"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                  
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Longitude:</strong></label>
                        <input type="text" name="Longitude" placeholder="What's the POP's Longitudinal position?" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Latitude:</strong></label>
                        <input type="text" name="Latitude" placeholder="What's the POP's Latitudinal position?" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Inverter Power:</strong></label>
                        <input type="text" name="Inverter_Power" placeholder="What's the value of the Inverter Power on site?" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Infrastructure Type:</strong></label>
                        <input type="text" name="Infrastructure_Type" placeholder="Type of infrastructure on site" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Date of Activation:</strong></label>
                        <input type="date" name="Activated_Date" placeholder="What date was the site operational?" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Tower Length:</strong></label>
                        <input type="text" name="Tower_Pole_Length" placeholder="Length of the POP tower" required
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>All Trunk IPs </strong></label>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-bordered" id = "tb2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Trunk IP</th>
                                                <th style="text-align:center"><a href="#" class="btn btn-warning" onclick="addRow()">+</a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="item">
                                            <tr>
                                                <td></td>
                                                <td><input required type="text" name="Trunk_IP[]" class="form-control"/></td>
                                                <th style="text-align:center"><a href="#" class="btn btn-danger removeRow">-</a></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group name2 col-md-12" data-wow-delay="300ms">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>All Base/Cluster IPs </strong></label>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-bordered" id = "tb2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Base/Cluster IP</th>
                                                <th style="text-align:center"><a href="#" class="btn btn-warning" onclick="addBaseCluser()">+</a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="baseCluster">
                                            <tr>
                                                <td></td>
                                                <td><input required type="text" name="Base_Cluster_IP[]" class="form-control"/></td>
                                                <th style="text-align:center"><a href="#" class="btn btn-danger deleteRow">-</a></th>
                                            </tr>
                                        </tbody>
                                    </table>
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
</form>
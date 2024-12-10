<div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
    <h2 class="text-center" style="text-align:center; font-weight: 120px; ; font-size: 30px;font-family:'Courier New', Courier, monospace"><strong>Add New Customer Form</strong> </h2>
    </div>

    @if(Session::has('message'))
        <div class="col-lg-6 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
    @endif
</div>

<div align="Center" style="padding-left:30px;margin-bottom:60px">
    <form class="main-form" action="{{url('submit-form')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mt-5 ">
        <div class="form-group name2 col-md-6">
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's Name:<span style="color:red;font-size:15px">*</span> </strong></label>
                <input type="text" name="clients"  placeholder="Client's Name" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Contact Person:<span style="color:red;font-size:15px">*</span></strong></label>
                <input type="text" name="contact_person_name"  placeholder="Contact Person's Name" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Email:<span style="color:red;font-size:15px">*</span></strong></label>
                <input type="text" name="email"  placeholder="Email address.." required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Phone No:<span style="color:red;font-size:15px">*</span></strong></label>
                <input type="text" name="number"  placeholder="Client's Number" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Address:<span style="color:red;font-size:15px">*</span></strong></label>
                <input type="text" name="address"  placeholder="Client's Address" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Account Manager:</strong><span style="color:red;font-size:15px">*</span></label>
                <select required name="account_manager"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Account Manager ---</option>
                    @foreach($marketers as $marketer)
                        <option value="{{$marketer->id}}"  id="account_manager" >{{$marketer->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
                 <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Service Plan:</strong><span style="color:red;font-size:15px">*</span></label>
                <select onchange="planCheck(this);" id="service_plan" name="service_plan"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">---Service Plan---</option>
                    <option>Shared</option>
                    <option>Dedicated</option>
                </select>
            </div>

           <div id ="Shared" style="display: none;" class="formText col-6 col-sm-6" >
               <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Shared Services:</strong><span style="color:red;font-size:15px">*</span></label>
               <select
                name="service_type_shared" id="service_type_shared"
                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                >   
                    <option value="">---Select Shared Plan---</option>
                    <option value="Home Frenzie" >Home Frenzie</option>
                    <option value="Home Delight" >Home Delight</option>
                    <option value="Home Delight Plus" >Home Delight Plus</option>
                    <option value="Home Extreme" >Home Extreme</option>
                    <option value="SME Lite" >SME Lite</option>
                    <option value="SME Extra" >SME Extra</option>
                    <option value="SME Gold" >SME Gold</option>
                    <option value="SME Diamond" >SME Diamond</option>
                    <option value="SME Platinum" >SME Platinum</option>
                </select>
            </div>

            <div id ="Dedicated" style="display: none;" class="col-6 col-sm-6 py-2" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Dedicated Services:</strong><span style="color:red;font-size:15px">*</span></label>
                <select onchange="DedicatedCheck(this);"
                    name="service_type_dedicated" id="service_type_dedicated"
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                    >
                    <option value="">---Select Dedicated Plan---</option>
                    <option   value="LAN">LAN</option>
                    <option id="txtBandwidth"  value="wireless">Wireless</option>
                    <option id="fibre"  value="Fibre">Fibre</option>
                    <option  value="Power">Power</option>
                </select>
            </div>

            <div id ="bandwidth" style="display: none;" class="formText col-12 col-sm-6"> 
                <div>
                    <label>Upload: </label><input id="dedicated" type="number" name="upload_bandwidth"> 
                </div>
                <div class ="pt-2">
                    <label>Download: </label><input id="dedicated" type="number" name="download_bandwidth">
                </div>
                <div>
                    <select id="dedicated" name="bandwidth_unit" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option value="">---select Unit---</option>
                        <option>Mbps</option>
                        <option>Gbps</option>
                    </select>
                </div>
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's AP:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="text" name="access_radio_ip" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Access Radio IP(AP)" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's SM:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="text" name="station_radio_ip" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Station Radio IP(SM)" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Port:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="number" name="port" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Port"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>VLAN:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="number" name="vlan_id" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="VLAN ID" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Subnet Mask:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="text" name="subnet_mask" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Subnet Mask" required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>IP Address:</strong><span style="color:red;font-size:15px">*</span></label>
                <input type="text" name="ip_address" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="IP address..." required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                 <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP:</strong><span style="color:red;font-size:15px">*</span></label>
                <select required name="pop" class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                    <option value="">---select POP---</option>
                    @foreach($pop as $pops)
                        <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
                    @endforeach 
                 </select>
            </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Profile Name:</strong><span style="color:red;font-size:15px">*</span></label>
            <input type="text" name="queue_name" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Profile Name">
          </div>
          
          <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Device Type:</strong><span style="color:red;font-size:15px">*</span></label>
            <select required  name="device_type"class="block  mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" >
                <option value="">---select device type---</option>
                <option>Switch</option>
                <option>Router</option>
            </select>
          </div>

            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                <label class="formText" style="font-size:20px"><strong>Any message?:</strong></label>
                <textarea required name="message" id="comment" rows="6" placeholder="Specify the details  of the client's complaint"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm ml-3" style="background-color:#8cd687">Submit</button>
        </div>
    </form>
</div>


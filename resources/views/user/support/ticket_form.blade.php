<div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h2 class="text-center" style="text-align:center; font-weight: 120px; ; font-size: 30px;font-family:'Courier New', Courier, monospace"><strong>Incident Ticket Form</strong> </h2>
    </div>

    @if(Session::has('message'))
        <div class="col-lg-6 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
    @endif
</div>

<div align="Center" style="padding-left:30px;margin-bottom:60px">
    <form class="main-form" action="{{url('submit_field_support_form')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mt-5 ">
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong> Client's ID: </strong></label>
                <input type="number" name="ID"  placeholder="Client's ID on ERP"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Name:</strong></label>
                <input type="text" name="name"  placeholder="Client's Name"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Email:</strong></label>
                <input type="text" name="email"  placeholder="Client's Address"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Phone No:</strong></label>
                <input type="text" name="phone"  placeholder="Client's Number"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client's Address:</strong></label>
                <input type="text" name="address"  placeholder="Client's Email"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Account Manager</strong></label>
                <select required name="acct_manager_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Account Manager ---</option>
                    @foreach($marketers as $marketer)
                        <option value="{{$marketer->id}}"  id="acct_manager_id" >{{$marketer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault:</strong></label>
                <input type="text" name="fault" placeholder="What's the issue"
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Status</strong></label>
                <select required name="fault_level"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Fault Status ---</option>
                    <option>Norminal</option>
                    <option>Critical</option>
                    <option>Highly Critical</option>
                    <option>Catastrophic</option>
                </select>
            </div>

            <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Fault Level</strong></label>
                <select required name="fault_type"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Fault Level ---</option>
                    <option value="1st">1st Level (Support)</option>
                    <option value="2nd">2nd Level (Service Operations)</option>
                    <option value="3rd">3rd Level (NOC)</option>
                    <option value="4th">4th Level (Core Network)</option>
                </select>
            </div>

            <!-- <div class="col-6 col-sm-6 py-2 wow fadeInRight" >
            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Assign Engineer</strong></label>
                <select required name="first_engr_id"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Assign Engineer ---</option>
                    @foreach($engineers as $engineer)
                        <option value="{{$engineer->id}}"  id="first_engr_id" >{{$engineer->name}}</option>
                    @endforeach
                </select>
            </div> -->

            <div class="col-6 col-sm-6 py-2">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Initiation type?</strong></label>
                <select required name="initiation" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                    <option value="">--- Select Initiation Type ---</option>
                    <option>Reactive</option>
                    <option>Proactive</option>
                </select>
            </div>
            
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                <label class="formText" style="font-size:20px"><strong>Details of Fault:</strong></label>
                <textarea required name="details" id="comment" rows="6" placeholder="Specify the details  of the client's complaint"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm " style="background-color:#8cd687">Submit</button>

        </div>
    </form>
</div>


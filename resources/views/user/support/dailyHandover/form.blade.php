<form class="form-group" action="{{route('support.dailyHandover.form')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="DailyHandover" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DailyHandoverLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DailyHandoverLabel"><span style="color:blue;align:right"><strong >Add To Daily Handover<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client: </strong></label>
                        <select  type="text" required name="clients" placeholder="Enter client name..." id="clients"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option disabled selected>---Select Customer---</option>
                            @foreach($customers as $cust)
                                <option value="{{$cust->id}}"> {{$cust->clients}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Issue: </strong></label>
                        <input id="" type="text" required name="issue" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Radio IP(AP/SM): </strong></label>
                        <input id="radio_ip" type="text" required name="radio_IP" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>POP: </strong></label>
                        <input id="pop" type="text" required name="pop" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Time: </strong></label>
                        <input id="" type="time" required name="start_time" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Start Date: </strong></label>
                        <input id="day" type="date" required name="start_day" placeholder="Enter Date"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Any comment? </strong></label>
                        <textarea  type="date" name="comment" placeholder="Do you have any comment?" rows="2"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring
                         focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
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
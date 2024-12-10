
@foreach ($ticket as $ticket)
    <div align="Center" style="padding:0px">
        <div class="col-lg-6 py-3 wow fadeInUp text-center" >
            <h2 class="text-center" style="text-align:center; font-weight: 120px; ; font-size: 30px;font-family:'Courier New', Courier, monospace"><strong>Close Ticket for {{$ticket->client_name}}</strong> </h2>
        </div>

        @if(Session::has('message'))
            <div class="col-lg-6 py-3 alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
        @endif
    </div>

    <div class="container" align="center" style="padding-top: 20px;">
        <form action="{{url('closing_mail',$ticket->ticket_id)}}" method="post"> 
        {{  csrf_field () }}
            <div style="padding: 15px; " class="form-group name2 col-md-3">
                    <label> Dear </label>
                    <input type="text" name="greeting"  placeholder="Sir/Ma/Miss"  
                    class="main-form mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div style="padding: 15px; " class="form-group name2 col-md-3">
                <label>Body</label>
                <textarea style="align-content: flex-start;" name="Body" id="Body" rows="3" placeholder="Message to client"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>
            <div style="padding: 15px; " class="form-group name2 col-md-3">
                <label>End Part</label>
                <input type="text" name="End" placeholder="Regards" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  style="color:black" required="">
            </div>

            <hr>
            <label>Summary Report for Team</label>
            </hr>
            <div style="padding-x: 15px; " class="form-group name2 col-md-3">
                <label  for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>RCA Category</strong></label>
                    <select onclick="rcaCat(this)" required name="rca_cat"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option disabled selected value="">--- Categorization of RCA ---</option>
                        <option>Missalignment</option>
                        <option>Pole Fell</option>
                        <option>Cable Disconnection</option>
                        <option>Others</option>
                    </select>
            </div>
            <div id="otherRca" style="padding: 15px;display:none" class="form-group name2 col-md-3">
                <label  for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Other RCA Category?</strong></label>
                <input type="text" name="otherRCA" placeholder="Write rca..." class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  style="color:black">
            </div>
            <div style="padding: 15px" class="form-group name2 col-md-3">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Resolution status</strong></label>
                    <select onclick="resolutionState(this)" required name="resolution_status"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option disabled selected value="">--- Status of the resolution ---</option>
                        <option>Permanently resolved</option>
                        <option>Temporarily resolved</option>
                        <option>Others</option>
                    </select>
            </div>
            <div id="resState" style="padding: 15px;display:none" class="form-group name2 col-md-3">
                <label  for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Other Resolution Category?</strong></label>
                <input type="text" name="other_resState" placeholder="Write resolution status..." class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  style="color:black">
            </div>
            <div style="padding: 15px;">
                <button type="submit" class="btn btn-success" style="background-color: burlywood;">Send</button>
            </div>
        </form>
    </div>
@endforeach


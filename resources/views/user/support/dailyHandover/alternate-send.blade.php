<form class="form-group" action="{{ route('support.dailyHandover.send') }}" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="sendDailyHandover" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sendDailyHandoverLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="sendDailyHandoverLabel"><span style="color:blue;align:right"><strong >Send Daily Handover<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    @if(Auth::user()->role=="Support Corper")
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Name: </strong></label>
                            <input id="" type="text"   name="sender" placeholder="Your name..." 
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    @else
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Name: </strong></label>
                            <input id="" type="text"   name="sender" placeholder="Your name..." value="{{ Auth::user()->name }}"
                            class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    @endif

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Plan </strong></label>
                        <select  type="text" required name="plan"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option disabled selected>---Select Service Plan---</option>
                            <option value="Shared"> Retail </option>
                            <option value="Dedicated"> Enterprise</option>
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
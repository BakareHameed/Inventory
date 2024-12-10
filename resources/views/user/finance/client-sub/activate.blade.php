<form class="form-group" action="{{url('customer_payment',$client->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="Activate{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Activate{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Activate{{$client->id}}Label"><span style="color:blue;align:right"><strong >Activate Client<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Client: </strong></label>
                        <input id="" type="text" required name="client" value="{{ $client->clients }}"  readonly
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                   
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Amount: </strong></label>
                        <input id="" type="text" required name="amount_paid" value="{{ old('amount_paid', $client->amount_paid) }}" placeholder="Enter ID of site..."
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="col-12 col-sm-6 py-2 " data-wow-delay="300ms">
                        <label for="date"><strong>Date</strong></label>
                        <input type="date" name="date" id="billingDate" required value=""
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="date"><strong>Service Plan Change?</strong></label>
                        <select onchange="QuoteCheck(this);" id="quote" name="change" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option>--- Change Service Plan?---</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <div class="form-group name2 col-md-6" id="ifQuoteYes" style="display: none;" >
                        <select onchange="planCheck(this);" id="service_plan" name="service_plan"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option value="{{ old('service_plan', $client->service_plan) }}">---Service Plan---</option>
                        <option>Shared</option>
                        <option>Dedicated</option>
                        </select>
                    </div>
                
                      <div class="form-group name2 col-md-6" id ="Shared" style="display: none;" >
                          <select
                              name="service_type" id="service_type"
                              class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                              multiple>
                              <option>Home Frenzie</option>
                              <option>Home Delight</option>
                              <option>Home Delight Plus</option>
                              <option>Home Extreme</option>
                              <option>SME Lite</option>
                              <option>SME Extra</option>
                              <option>SME Gold</option>
                              <option>SME Diamond</option>
                              <option>SME Platinum</option>
                          </select>
                      </div>
                
                      <div class="form-group name2 col-md-6" id ="Dedicated" style="display: none;" >
                          <select
                          name="service_type" id="service_type"
                          class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                          multiple>
                          <option  value="LAN">LAN</option>
                            <option id="txtBandwidth" value="wireless">Wireless</option>
                            <option id="fibre" value="Fibre">Fibre</option>
                            <option value="Power">Power</option>
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
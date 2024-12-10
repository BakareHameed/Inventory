<form class="main-form" action="{{url('call_out_form_edit',$client->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="editCallOutForm{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCallOutForm{{$client->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCallOutForm{{$client->id}}Label"><span style="color:blue;text-align:right"><strong >Survey Report Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
                </div>
              
                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                          <input type="text" name="company_name" value="{{ old('company_name', $client->company_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Company Name">
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                          <input type="text" name="contact_name" value="{{ old('contact_name', $client->contact_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Contact Name">
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                            <input  type="text" name="contact_number" value="{{ old('contact_name', $client->company_name) }}"  class="form-control rounded-md shadow-md border-gray-300" Placeholder=" Contact Number"> 
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms" >
                          <input type="date" name="date" value="{{ old('date', $client->date) }}" class="form-control rounded-md shadow-md border-gray-300" required>
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                          <input type="text" name="location" value="{{ old('location', $client->location) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Location">
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                          <input type="text" name="address" value="{{ old('address', $client->address) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Address">
                        </div>
                        <div class="col-12 col-sm-6 py-2 " >
                          <select required onchange="QuoteCheck({{$client->id}},this);" id="quote" name="quote" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">--- Any Quote?---</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                        <div id="ifQuoteYes{{$client->id}}" style="display: none;">
                          <div id="quote_amount" class="col-12 col-sm-6 py-2" >
                              <label>Quote Amount(₦): </label><input type="number" name="quote_amount" class="rounded-md shadow-md border-gray-300">
                          </div>
                        </div>
                        <div id="MTCYes{{$client->id}}" style="display: none;">
                          <div>
                            <span style="margin-left:10px" class="col-12 col-sm-6 py-2">
                              <label>MRC(₦):<input type="number" name="MRC" class="rounded-md shadow-md border-gray-300"> </label>
                            </span>
                            <span style="margin-left:150px" class="col-12 col-sm-6 py-2">
                              <label>OTC(₦):<input type="number" name="OTC" class="rounded-md shadow-md border-gray-300"> </label>
                            </span>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 py-2" class="col-12 col-sm-6 py-2" >
                          <select required onchange="yesnoCheck({{$client->id}},this);" id="sales" name="sales" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">--- Any Sale?---</option>
                            <option  value="Yes">Yes</option>
                            <option  value= "No">No</option>
                          </select>
                        </div><br>
                        <div id="ifYes{{$client->id}}" style="display: none;" class="col-12 col-sm-6 py-2">
                          <div id="sales_amount" style="margin-bottom:5px;margin-left:5px">
                              <label>Sales Amount(₦): </label><input type="number" name="sales_amount" class="rounded-md shadow-md border-gray-300">
                          </div>
                        </div>
                  
                        <div id="MTC_sales_Yes{{$client->id}}" style="display: none;">
                          <div>
                            <span class="col-12 col-sm-6 py-2">
                              <label>Sales_MRC(₦):<input type="number" name="MRC_sales" class="rounded-md shadow-md border-gray-300"> </label>
                            </span>
                            <span class="col-12 col-sm-6 py-2">
                              <label>Sales_OTC(₦):<input type="number" name="OTC_sales" class="rounded-md shadow-md border-gray-300"> </label>
                            </span>
                          </div>
                        </div>
                        <div id="Service{{$client->id}}" class="col-6 py-2 form-group" data-wow-delay="300ms" >
                          <select onchange="planCheck({{$client->id}},this);" id="service_plan" name="service_plan[]"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                            <option value="">---Service Plan---</option>
                            <option>Shared</option>
                            <option>Dedicated</option>
                          </select>
                        </div>
                      </div>
                  
                      <div id ="Shared{{$client->id}}" style="display: none;" class="form-group" >
                        <select name="service_type[]" id="service_type[]"
                          class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                          multiple>
                              <option id="service_type[]" name="service_type[]" >Home Frenzie</option>
                              <option id="service_type[]" name="service_type[]" >Home Delight</option>
                              <option id="service_type[]" name="service_type[]" >Home Delight Plus</option>
                              <option id="service_type[]" name="service_type[]" >Home Extreme</option>
                              <option id="service_type[]" name="service_type[]" >SME Lite</option>
                              <option id="service_type[]" name="service_type[]" >SME Extra</option>
                              <option id="service_type[]" name="service_type[]" >SME Gold</option>
                              <option id="service_type[]" name="service_type[]" >SME Diamond</option>
                              <option id="service_type[]" name="service_type[]" >SME Platinum</option>
                        </select>
                      </div>
                      <div id ="Dedicated{{$client->id}}" style="display: none;" class="form-group" >
                        <select  name="service_type[]" id="service_type[]"
                          class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                          multiple>
                          <option  name="service_type[]" value="LAN">LAN</option>
                            <option id="txtBandwidth" name="service_type[]" value="wireless">Wireless</option>
                            <option id="fibre" name="service_type[]" value="fibre">Fibre</option>
                            <option name="service_type[]" value="Power">Power</option>
                        </select>
                      </div>
                  
                      <div class="col-12 py-2 " data-wow-delay="300ms">
                        <textarea name="comment" id="comment" value="{{ old('comment', $client->comment) }}" class="form-control rounded-md shadow-md border-gray-300" rows="6" placeholder="Any comment?"></textarea>
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




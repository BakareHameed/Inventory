<form class="main-form" action="{{url('call_out_form_edit',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="modal fade" id="edit-CallOut{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit-CallOut{{$data->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-CallOut{{$data->id}}Label"><span style="color:blue;align:right"><strong >Edit Call-Outs<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                      <input type="text" name="company_name" value="{{ old('company_name', $data->company_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Company Name">
                    </div>
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                      <input type="text" name="contact_name" value="{{ old('contact_name', $data->contact_name) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Contact Name">
                    </div>
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                        <input  type="text" name="contact_number" value="{{ old('contact_name', $data->company_name) }}"  class="form-control rounded-md shadow-md border-gray-300" Placeholder=" Contact Number"> 
                    </div>
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms" >
                      <input type="date" name="date" value="{{ old('date', $data->date) }}" class="form-control rounded-md shadow-md border-gray-300" required>
                    </div>
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                      <input type="text" name="location" value="{{ old('location', $data->location) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Location">
                    </div>
                    <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                      <input type="text" name="address" value="{{ old('address', $data->address) }}" class="form-control rounded-md shadow-md border-gray-300" placeholder="Address">
                    </div>
                    <div class="col-12 col-sm-6 py-2" >
                      <select required onchange="QuoteCheck(this,'{{$data->id}}');" id="quote" name="quote" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option value="">--- Any Quote?---</option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                    <div id="ifQuoteYes{{$data->id}}" class="col-12 col-sm-6 py-2" style="display: none;">
                        <input type="number" name="quote_amount" placeholder="Quote amount in naira(₦)" class="block w-full rounded-md shadow-md border-gray-300">
                    </div>
                    <div id="MTCYes{{$data->id}}" style="display: none;">
                      <div>
                        <span style="margin-left:10px">
                          <label>MRC(₦):<input type="number" name="MRC" class="rounded-md shadow-md border-gray-300"> </label>
                        </span>
                        <span style="margin-left:150px">
                          <label>OTC(₦):<input type="number" name="OTC" class="rounded-md shadow-md border-gray-300"> </label>
                        </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6 py-2" >
                      <select required onchange="yesnoCheck(this,'{{$data->id}}');" id="sales" name="sales" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option value="">--- Any Sale?---</option>
                        <option  value="Yes">Yes</option>
                        <option  value= "No">No</option>
                      </select>
                    </div><br>
                    <div id="ifYes{{$data->id}}" style="display: none;">
                      <div id="sales_amount" style="margin-bottom:5px;margin-left:5px">
                          <label>Sales Amount(₦): </label><input type="number" name="sales_amount" class="rounded-md shadow-md border-gray-300">
                      </div>
                    </div>
              
                    <div id="MTC_sales_Yes{{$data->id}}" style="display: none;">
                      <div>
                        <span style="margin-left:20px">
                          <label>Sales_MRC(₦):<input type="number" name="MRC_sales" class="rounded-md shadow-md border-gray-300"> </label>
                        </span>
                        <span style="margin-left:40px">
                          <label>Sales_OTC(₦):<input type="number" name="OTC_sales" class="rounded-md shadow-md border-gray-300"> </label>
                        </span>
                      </div>
                    </div>
                    <div id="Service{{$data->id}}" style="display: none;" class="col-12 py-2 form-group" data-wow-delay="300ms" >
                      <select onchange="planCheck(this,'{{$data->id}}');" id="service_plan" name="service_plan[]"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                        <option value="">---Service Plan---</option>
                        <option>Shared</option>
                        <option>Dedicated</option>
                      </select>
                    </div>
                  </div>
              
                  <div id ="Shared{{$data->id}}" style="display: none;" class="form-group" >
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
                  <div id ="Dedicated{{$data->id}}" style="display: none;" class="form-group" >
                    <select  name="service_type[]" id="service_type[]"
                      class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control"
                      multiple>
                      <option  name="service_type[]" value="LAN">LAN</option>
                        <option id="txtBandwidth" name="service_type[]" value="wireless">Wireless</option>
                        <option id="fibre" name="service_type[]" value="fibre">Fibre</option>
                        <option name="service_type[]" value="Power">Power</option>
                    </select>
                  </div>
              
                  <div class="col-12 py-2" data-wow-delay="300ms">
                    <textarea name="comment" id="comment" value="{{ old('comment', $data->comment) }}" class="form-control rounded-md shadow-md border-gray-300" rows="6" placeholder="Any comment?"></textarea>
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

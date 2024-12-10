<div class="page-section">
  <div class="container">
    <h1 class="text-center wow fadeInUp" style="font-size:30px;">Create a Survey Request</h1>
    <form class="main-form" name="SurveyRequestForm" onsubmit="return SurveyRequest();" action="{{url('appointment')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row mt-5 ">
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <input type="text" name="clients" class="form-control border-gray-300 rounded-md shadow-sm" placeholder="Client's Name" required>
        </div>

        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <input type="text" name="contact_person_name" class="form-control  border-gray-300 rounded-md shadow-sm" placeholder="Contact Person's Name" required>
        </div>

        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="email" name="email" class="form-control  border-gray-300 rounded-md shadow-sm" placeholder="Email address.." required>
        </div>

        <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="date" name="date" class="form-control  border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" name="address" class="form-control  border-gray-300 rounded-md shadow-sm" placeholder="Residential address" required>
        </div>

        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" name="number" class="form-control  border-gray-300 rounded-md shadow-sm" placeholder="Number.." required>
        </div>

        @if( Auth::user()->role == "Admin Manager")
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <select  name="account_owner" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" onchange="Checkroad()">
              <option selected disabled>---select Account Owner---</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        @endif
        <div class="col-12 col-sm-6 py-2 wow fadeInRight" >
          <select required onchange="QuoteCheck(this);" id="quote" name="quote"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
            <option value="">--- Any Quote?---</option>
            <option>Yes</option>
            <option>No</option>
          </select>
        </div>
        <div id="ifQuoteYes" style="display: none;">
            <div id="quote_amount" >
                <label>Quote Amount(₦): </label><input type="number" name="quote_amount" class="rounded-md shadow-sm border-gray-300">
            </div>
        </div>
        <div id="MTCYes" style="display: none;">
          <div>
            <span style="margin-left:15px;margin-right:0px">
              <label>Quote_MRC(₦):<input type="number" name="MRC" class="rounded-md shadow-sm border-gray-300"> </label>
            </span>
            <span style="margin-left:20px">
              <label>Quote_OTC(₦):<input type="number" name="OTC" class="rounded-md shadow-sm border-gray-300"> </label>
            </span>
          </div>
        </div>
    
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft" >
          <select required onchange="yesnoCheck(this);" id="sales" name="sales" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
            <option value="">--- Any Sale?---</option>
            <option  value="Yes">Yes</option>
            <option  value= "No">No</option>
          </select>
        </div>
        <div id="ifSalesYes" style="display: none;">
          <div id="sales_amount"  style="margin-bottom:5px;margin-left:5px">
            <label>Sales Amount(₦): </label><input type="number" name="sales_amount" class="rounded-md shadow-sm border-gray-300">
          </div>
        </div>
        <div id="MTC_sales_Yes" style="display: none;">
          <div>
            <span style="margin-left:20px">
              <label>Sales_MRC(₦):<input type="number" name="MRC_sales" class="rounded-md shadow-sm border-gray-300"> </label>
            </span>
            <span style="margin-left:40px">
              <label>Sales_OTC(₦):<input type="number" name="OTC_sales" class="rounded-md shadow-sm border-gray-300"> </label>
            </span>
          </div>
        </div>
        <div class="col-12 py-2">
          <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 form-group">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="text-xl">Service Plan</div>

                <div class="pt-6 form-group">
                  <label class="inline-flex items-center pr-24">
                    <input type="radio" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="service_plan" value="Dedicated" onclick="ServicePlan(0);" id="Dedi" />
                    <span class="ml-2">Dedicated </span>
                  </label>

                  <label class="inline-flex items-center">
                    <input type="radio" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="service_plan" value="Shared" onclick="ServicePlan(1);" id="Shar" />
                    <span class="ml-2">Shared</span>
                  </label>
                </div>

                <div id="ifYes" style="display:none" class="form-group">
                  <div class="mt-8 mx-auto max-w-4xl">
                    <div class="form-group">
                      <select id="ded_service_type" name="ded_service_type" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control" onchange="Checkroad()">
                        <option value="">---select Dedicated type---</option>
                        <option>LAN</option>
                        <option id="txtBandwidth">wireless</option>
                        <option id="fibre">fibre</option>
                        <option>Power</option>
                      </select>
                      <br />

                      <div id="dedicated" style="display: none;">
                        <label>Upload: </label><input id="dedicated" type="number" name="upload_bandwidth">
                        <label>Download: </label><input id="dedicated" type="number" name="download_bandwidth">
                        <label>Unit: </label>
                        <select id="dedicated" name="bandwidth_unit" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                          <option value="">---select Unit---</option>
                          <option>Mbps</option>
                          <option>Gbps</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="ifNo" style="display:none" class="form-group">
                  <div class="mt-8 mx-auto max-w-4xl">
                    <div class="form-group">
                      <select name="shar_service_type" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-control">
                        <option value="">---select Shared type---</option>
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
                  </div>
                </div>

                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                  <textarea name="message" id="message" class="form-control  border-gray-300 rounded-md shadow-sm" rows="6" placeholder="Enter message.."></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="pl-2 pb-2 ml-2 px-4 mx-10">
          <button type="submit" class="btn btn-primary mt-3  wow zoomIn  border-gray-300 rounded-md shadow-sm" style="background-color:#8cd687">Submit Request</button>
        </div>
      </div>
    </form>
  </div>
</div> <!-- .page-section -->
<div align="Center" style="padding:0px">
    <div class="col-lg-12 py-3 wow fadeInUp text-center">
        <h2 class="text-center"
            style="text-align:center; font-weight: 120px; ; font-size: 30px;font-family:'Courier New', Courier, monospace">
            <strong>Field Report Form</strong>
        </h2>
    </div>

    @if (Session::has('message'))
        <div class="col-lg-6 py-3 alert alert-success" role="alert">
            <strong>Success:</strong>{{ Session::get('message') }}
        </div>
    @endif
</div>

<div align="Center" style="padding-left:30px;margin-bottom:60px">
    <form class="main-form" action="{{ url('submit_field_report_form', ['ticket_id' => $ticket_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="row mt-5 ">
            @foreach ($my_ticket as $mticket)
                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Name</label>
                    <input type="text" name="name" placeholder="{{ $mticket->client_name }}" disabled
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Address</label>
                    <input type="text" name="email" placeholder="{{ $mticket->client_address }}" disabled
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            @endforeach
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText">RCA:</label>
                <input type="text" name="RCA" placeholder="What's the cause of fault?"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="form-group name2 col-md-6" fadeInRight>
                <label for="exampleInputEmail1## Heading ##" class="formText">Resolution</label>
                <textarea name="Resolution" id="comment" rows="2" placeholder="What was done?"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
                @error('Resolution')
                    <p class="text-danger"> {{ $message }}</p>
                @enderror
            </div>

            @if (Auth::user()->role !== 'Fibre Engineer')
                <div class="col-6 col-sm-6 py-2 wow fadeInRight">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Client's LAN status</label>
                    <select required
                        name="client_LAN"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                        <option value="">--- Client's LAN ---</option>
                        <option>Okay</option>
                        <option>Not Okay</option>
                        <option>Critical</option>
                    </select>
                </div>

                <div class="col-6 col-sm-6 py-2 wow fadeInRight">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Pole Status</label>
                    <select required
                        name="pole_status"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                        <option value="">--- Pole Status ---</option>
                        <option>Okay</option>
                        <option>Not Okay</option>
                        <option>Critical</option>
                    </select>
                </div>

                <div class="col-6 col-sm-6 py-2 wow fadeInRight">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Chain Balance</label>
                    <select required
                        name="chain_balance"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                        <option value="">--- Chain Balance ---</option>
                        <option>Okay</option>
                        <option>Not Okay</option>
                        <option>Critical</option>
                    </select>
                </div>

                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Chain Parameter:</label>
                    <input type="text" name="chain_param" placeholder="Chain Parameter"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('chain_param')
                        <p class="text-danger"> {{ $message }}</p>
                    @enderror
                </div>
            @endif
            <div class="col-6 col-sm-6 py-2 wow fadeInRight">
                <label for="exampleInputEmail1## Heading ##" class="formText">Power Status</label>
                <select required
                    name="power_status"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                    <option value="">--- Power Status ---</option>
                    <option>Okay</option>
                    <option>Not Okay</option>
                    <option>Critical</option>
                </select>
            </div>

            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText">Power Parameter</label>
                <input type="text" name="power_param" placeholder="Power Parameter"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('power_param')
                    <p class="text-danger"> {{ $message }}</p>
                @enderror
            </div>

            <div class="col-6 col-sm-6 py-2 wow fadeInRight">
                <label for="exampleInputEmail1## Heading ##" class="formText">Signal Strength(Rx):</label>
                <select required
                    name="signal_strength"class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form">
                    <option value="">--- Signal Strength ---</option>
                    <option>Okay</option>
                    <option>Not Okay</option>
                    <option>Critical</option>
                </select>
            </div>
            @if (Auth::user()->role !== 'Fibre Engineer')
                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Signal Strength Parameter(Rx):</label>
                    <input type="text" name="RX" placeholder="Signal Strength(Reception)"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('RX')
                        <p class="text-danger"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group name2 col-md-6">
                    <label for="exampleInputEmail1## Heading ##" class="formText">Signal Strength Parameter(Tx):</label>
                    <input type="text" name="TX" placeholder="Signal Strength(Transmission)"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('TX')
                        <p class="text-danger"> {{ $message }}</p>
                    @enderror
                </div>
            @endif
            <div class="form-group name2 col-md-6">
                <label for="exampleInputEmail1## Heading ##" class="formText">Image:</label>
                <input type="file" name="image[]" placeholder="What's the cause of fault?" multiple
                    accept="image/*"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('image')
                    <p class="text-danger"> {{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                <label class="formText">Other Information:</label>
                <textarea name="additional" id="comment" rows="4" placeholder="Any additional information"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm " style="background-color:#8cd687">Submit</button>
        </div>
    </form>
</div>

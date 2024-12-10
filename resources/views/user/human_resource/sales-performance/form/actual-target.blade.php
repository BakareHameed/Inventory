<form class="main-form" action="{{ route('sales.target.submit', $personnell->unique('id')->pluck('id')->implode('')) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="salesTargetForm{{ $personnell->unique('id')->pluck('id')->implode('') }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="salesTargetForm{{ $personnell->unique('id')->pluck('id')->implode('') }}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"
                        id="salesTargetForm{{ $personnell->unique('id')->pluck('id')->implode('') }}Label"><span
                            style="color:blue;text-align:right"><strong>Sales Target Form<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <div><strong>X</strong></div>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mt-5 ">
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                            <label for="">UID</label>
                            <input type="text" name="name"
                                value="{{ $personnell->unique('id')->pluck('id')->implode(' ') }}"
                                class="form-control rounded-md shadow-md border-gray-300">
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                            <label for="">Sales Person</label>
                            <input type="text" name="user_id"
                                value="{{ $personnell->unique('name')->pluck('name')->implode('') }}"
                                class="form-control rounded-md shadow-md border-gray-300">
                        </div>
                        <div class="form-group name2 col-md-6">
                            <label for="exampleInputEmail1## Heading ##" class="formText"
                                style="font-size:20px"><strong>Sales Target: </strong></label>
                            <input type="text" name="target" id="currency-field"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                pattern="^\₦ \d{1,3}(,\d{3})*(\.\d+)?₦ " data-type="currency"
                                placeholder="Enter amount...">
                        </div>
                        <div class="col-12 col-sm-6 py-2" data-wow-delay="300ms">
                            <label for="">Year</label>
                            <input type="date" name="year"
                                class="form-control rounded-md shadow-md border-gray-300">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="background-color:grey;"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

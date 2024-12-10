<form class="main-form"  action="{{url('job-order-approval',['client_id'=>$client->id,'raiser'=>$client->raised_by,'FSE'=>$client->site_engr])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body col-12 col-xl-12 py-2 edit_form" style="display:none" id="approval{{$client->id}}">
        <div class="row mt-5 ">
            <div class="form-group name2 col-md-6" >
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Approval Status</strong></label>
                <select required name="status" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 main-form" >
                    <option value="">--- Change  Status ---</option>
                    <option >Approved</option>
                    <option >Disapproved</option>
                </select>
            </div>
            <div class="form-group name2 col-md-12">
                <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Comment</strong></label>
                <textarea type="text" row="3" name="approval_comment"  placeholder="Write your comment..." required
                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>
            </div>
                <button type="submit" class="btn btn-primary" style="background-color:purple;">Send</button>
            </div>
        </div>
    </div>
</form>  
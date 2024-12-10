<form class="form-group" action="{{route('sales.uploadSLA',['id'=>$survey->id])}}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="modal fade" id="SLA{{$survey->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SLA{{$survey->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="SLA{{$survey->id}}Label"><span style="color:blue;align:right"><strong >Upload SLA for {{$survey->clients}}<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="form-group name2 col-md-12">
                    <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Upload SLA(PDF):</strong><span style="color:red;font-size:15px">*</span></label>
                    <input type="file" required name="pdf" multiple accept="pdf/*" placeholder="Picture of outdoor cable or devices" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
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
<div class="modal fade" id="SLA{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Raise{{$report->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="SLA{{$client->id}}Label"><span style="color:blue;align:right"><strong>SLA for {{$client->clients}}<strong></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <div><strong>X</strong></div>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-white-900 py-1">
                    <div class="flex flex-col mt-1">
                        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden sm:rounded-lg">
                                    <iframe height="700" width="1050" src="/image/installations/SLAs/{{$client->SLA}}"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Component End  -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:purple;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
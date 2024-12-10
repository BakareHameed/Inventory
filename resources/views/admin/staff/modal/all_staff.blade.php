<div class="modal fade" id="All" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AllLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content  bg-white">
            <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AllLabel"><span style="color:blue;align:right"><strong >All Syscodes  Staff<strong></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
                </div>
            <div class="modal-body">
                <div style="margin: 20px;margin-bottom:0px">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                        All Staff  (<span class="text-gray-600"> Former and Current</span>)---(<span class="text-blue-600"></span>)
                    </h2>
                </div>
                <table class="min-w-full text-sm text-gray-400">
                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                        <tr style="background-color:black;">
                            <th style="padding:10px; font-size: 20px; color: white ;">#</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Name</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Phone</th>
                            <th style="padding:10px; font-size: 20px; color: white ;text-alignment:left">Email</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Adress</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Role</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                            <th style="padding:10px; font-size: 20px; color: white ;">Action</th>
                        </tr>
                    </thead>
               
                        <tbody class="bg-gray-800">
                            <tr style="background-color: white;" align="left">
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->id}}</strong></td>
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->name}}</strong></td>
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->phone}}</strong></td>
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->email}}</strong></td>
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->address}}</strong></td>
                                <td style="padding: 5px; color: black;font-size:1rem;"><strong>{{$staff->role}}</strong></td>
                                @if($staff->u_status=='Active')
                                    <td style="padding: 5px; color: black;font-size:1rem;  background-color: #8febab"><strong>{{$staff->u_status}}</strong></td>
                                @elseif($staff->u_status=='Inactive')
                                    <td style="padding: 5px; color: black;font-size:1rem;  background-color: yellow"><strong>{{$staff->u_status}}</strong></td>
                                @else
                                    <td style="padding: 5px; color: black;font-size:1rem;  background-color: #fc6d6d "><strong>{{$staff->u_status}}</strong></td>
                                @endif
                                <td style="padding: 5px; color: black;font-size:1rem;">
                                    <a style="padding: 5px;margin-bottom:5px" class="btn btn-primary" href="{{url('job-order-form',$staff->id)}}">view</a><span>
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
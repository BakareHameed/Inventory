<div class="container" align="center" >
 
    <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-white-900 py-10">
        <div class="flex flex-col mt-1">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
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
                        
                            @foreach($staff as $staff)
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
                            @endforeach
                            </tbody>
                            </table>
                        
                        </div>
                    </div>
                
                </div>
            </div>
            <!-- Component End  -->
        </div>
    <div>
</div>
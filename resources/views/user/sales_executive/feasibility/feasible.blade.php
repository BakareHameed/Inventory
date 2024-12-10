<div class="modal fade feasible" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <table border="0">
        <tr style="background-color:black;">
          <th style="padding:5px; font-size: 20px; color: white ;">S/N</th>
          <th style="padding:5px; font-size: 20px; color: white ;">ID</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Client</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Number</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Address</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Date</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Service Plan</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Service Type</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Feasibility</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Status</th>
          <th style="padding:5px; font-size: 20px; color: white ;">Action</th>
        </tr>
        @foreach($feasible as $feasible)
          <tr style="background-color: skyblue;" align="left">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->id}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->clients}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->phone}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->address}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->date}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->service_plan}}</td>
            <td style="padding: 3px; color: black;">{{$feasible->service_type}}</td>
            @if ($feasible->engr_name !== null && $feasible->latitude !== null  )
              <td style="padding: 10px; color: black;">Feasible
                <a class="btn btn-primary" href="{{url('survey_report',$feasible->id)}}"> survey report</a>
              </td>
            @elseif ($feasible->engr_name !== null && $feasible->latitude == null  )
              <td style="padding: 10px; color: black;">Not feasible
                <a class="btn btn-primary" href="{{url('survey_report',$feasible->id)}}"> survey report</a>
              </td>
            @else
              <td style="padding: 10px; color: black;">NA</td>
            @endif
              <td style="padding: 3px; color: black;" >{{$feasible->status}}</td>
              <td>
                <a style="padding: 0px;margin-bottom:5px" class="btn btn-secondary" href="{{url('payment_confirmation_paid',$feasible->id)}}">paid</a><span>
                <a style="padding: 0px;margin-bottom:5px" class="btn btn-danger" href="{{url('payment_confirmation_notpaid',$feasible->id)}}">Not paid</a></span>
              </td>   
          </tr>
        @endforeach
      </table>  
    </div>
  </div>
</div>
<div class="modal fade non-feasible" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
        </tr>
        @foreach($nonfeasible as $nonfeasible)
          <tr style="background-color: skyblue;" align="left">
            <td>{{$loop->iteration}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->id}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->clients}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->phone}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->address}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->date}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->service_plan}}</td>
            <td style="padding: 3px; color: black;">{{$nonfeasible->service_type}}</td>
            @if ($nonfeasible->engr_name !== null && $nonfeasible->latitude !== null  )
              <td style="padding: 10px; color: black;">Not feasible
                <a class="btn btn-primary" href="{{url('survey_report',$nonfeasible->id)}}"> survey report</a>
              </td>
            @elseif ($nonfeasible->engr_name !== null && $nonfeasible->latitude == null  )
              <td style="padding: 10px; color: black;">Not feasible
                <a class="btn btn-primary" href="{{url('survey_report',$nonfeasible->id)}}"> survey report</a>
              </td>
            @else
              <td style="padding: 10px; color: black;">NA</td>
            @endif
              <td style="padding: 3px; color: black;" >{{$nonfeasible->status}}</td>
          </tr>
        @endforeach
      </table>  
    </div>
  </div>
</div>
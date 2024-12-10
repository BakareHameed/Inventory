<style>
    .table table{
       border: 2px solid black;
       border-radius: 10px !important;
       padding: 3px 15px;
    }
    .table th{
      border: 2px solid black;
      border-top: none;
      border-right: none;
      color: white;
      text-align: center;
      background: black
    }
    .table th:first-child, .table td:first-child{
        border-left: none;
    }
    .table td{
      border: 2px solid black;
      border-bottom: none;
      border-right: none;
      color: black !important;
      font-weight: bold;
      text-align: center;
      font-family: "Times New Roman", Times, serif;
    }
    
 
</style>


<x-mail::message>
# Dear Team,

Below are the <b>{{ $count }}  {{ $service_type }} </b> clients handovers for today, {{Carbon\Carbon::parse( $today)->format('D, M j, Y g:i A')}}.

<x-mail::table @class(['p-4', 'font-bold' => true])>
| S/N  | Client | Issue  | Start Time | Support's Findings| Resolution(RCA) | End Time | Radio IP | POP | Status | Comment |
| -----|:------:|:------:|:----------:|:-----------------:|:---------------:|:--------:|:--------:|:---:|:------:| -------:|
@foreach($clients as $client)
|{{ $loop->iteration }}|{{ $client->clients }}| {{ $client->issue }}| {{Carbon\Carbon::parse( $client->start_time)->format('D, M j, Y g:i A')}} | {{ $client->findings }}| {{ $client->resolution }} | @if($client->end_time !== null){{Carbon\Carbon::parse( $client->end_time)->format('D, M j, Y g:i A')}} @else {{null}} @endif | {{ $client->radio_IP }} | {{ $client->pop }} | {{ $client->status }} | {{ $client->comment }}|
@endforeach
</x-mail::table>

Thanks,<br>

<strong style="color:brown">{{ $senderName }}</strong><br>

<strong style="color:brown">{{ $senderRole  }} </strong><br>
<strong style="color:brown">Syscodes Communications Ltd.</strong><br>
<strong style="color:brown">Email:</strong> <strong><em style="color:blue;font-family: Georgia, serif;"> support@syscodescomms.com</em></strong> <br>
<strong style="color:brown">OL:</strong> <strong style="color:brown;font-family: Georgia, serif;">+234 8186249685, 8039349772</strong><br>
<strong style="color:brown">Office Address:</strong> <strong style="color:black;font-family: Georgia, serif;">3rd Floor, 19, Toyin Street, Ikeja, Lagos</strong><br>
<strong style="color:brown">Website:<em style="color:brown"> www.syscodescomms.com </em></strong><br>
<img src="{{ asset('assets/img/Syscodes.png') }}" style="width:30%" alt="App Logo"><br>
<h3 style="color:green">connecting with ease...</h3>
</x-mail::message>
 
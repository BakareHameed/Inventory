
<style>
        .content-body {
            background: #FFFFFF;
            padding: 2rem;
            overflow: hidden;
            margin-top: 2rem;
        }

        .content-text { 
            font-size: 18px;
            line-height: 1.5;
        }

        p {
            padding-bottom: 1rem;
        }

        .small-container {
            padding: 1rem 0;
            font-style: italic;
        }

        .message{

        	text-color: black;
        }
    </style>

@component('mail::message')
<h2>Dear {{ $engr_name}},</h2>
<p style="color:black">
    You have been reassigned to attend to the client,  <strong> {{$client_name}}</strong>,<br>
    who complained of <strong> {{ $client_complaint}}</strong>. Other details of
    client and its related issues are as underlisted.<br><br>
    Contact:<strong> {{ $client_phone  }}</strong><br>
    Address:<strong> {{ $client_address }}</strong><br>
    Fault status:<strong> {{ $fault_level }}</strong><br>
    Start Time: <strong> {{Carbon\Carbon::parse($started_at)->format('D, M j, Y. g:i A')}}</strong><br>
    Details:<strong> {{ $fault_details }}</strong><br><br>
    Work Type:<strong> {{ $purpose }}</strong><br>
    Resolution Type:<strong> {{ $resolution }}</strong><br>
    We await your swift response.<br><br>
    Thank you.
</p>

 

<strong style="color:brown">{{ $sender_name }}</strong><br>

<strong style="color:brown">{{ $sender_role  }} </strong><br>
<strong style="color:brown">Syscodes Communications Ltd.</strong><br>
<strong style="color:brown">Email:</strong> <strong><em style="color:blue;font-family: Georgia, serif;"> support@syscodescomms.com</em></strong> <br> 
<strong style="color:brown">OL:</strong> <strong style="color:brown;font-family: Georgia, serif;">+234 8186249685, 8039349772</strong><br>
<strong style="color:brown">Office Address:</strong> <strong style="color:black;font-family: Georgia, serif;">3rd Floor, 19, Toyin Street, Ikeja, Lagos</strong><br>
<strong style="color:brown">Website:<em style="color:brown"> www.syscodescomms.com </em></strong><br>
<img src="{{ asset('assets/img/Syscodes.png') }}" style="width:30%" alt="App Logo"><br>
<h3 style="color:green">connecting with ease...</h3> 

@endcomponent
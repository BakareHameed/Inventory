
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
<h2>Dear Samuel,</h2>
<p style="color:black">This to to notify you that job order has been raised for the client,
 <strong> {{ $client_name}}</strong> , with ID---<strong>{{$survey_id}}</strong>.<br><br>
    Kindly review and give your thought(s).<br><br>
    Thank you.
</p>

 

<strong style="color:brown">{{ $sender_name }}</strong><br>

<strong style="color:brown">{{ $sender_role  }} </strong><br>
<strong style="color:brown">Syscodes Communications Ltd.</strong><br>
<strong style="color:brown">Email:</strong> <strong><em style="color:blue;font-family: Georgia, serif;"> servicedelivery@syscodescomms.com</em></strong> <br> 
<strong style="color:brown">OL:</strong> <strong style="color:brown;font-family: Georgia, serif;">+234 8186249685, 8039349772</strong><br>
<strong style="color:brown">Office Address:</strong> <strong style="color:black;font-family: Georgia, serif;">3rd Floor, 19, Toyin Street, Ikeja, Lagos</strong><br>
<strong style="color:brown">Website:<em style="color:brown"> www.syscodescomms.com </em></strong><br>
<img src="{{ asset('assets/img/Syscodes.png') }}" style="width:30%" alt="App Logo"><br>
<h3 style="color:green">connecting with ease...</h3> 

@endcomponent
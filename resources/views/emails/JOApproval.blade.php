
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

        	color: black;
        }
    </style>

@component('mail::message')
<h2>Dear {{ $details['raiser'] }},</h2>
<p style="color:black">{{  $details ['approval_comment']  }}
</p>

 

<strong style="color:brown">{{ $details ['sender_name']  }}</strong><br>

<strong style="color:brown">{{ $details ['sender_role']  }} </strong><br>
<strong style="color:brown">Syscodes Communications Ltd.</strong><br>
<strong style="color:brown">Email:</strong> <strong><em style="color:blue;font-family: Georgia, serif;"> support@syscodescomms.com</em></strong> <br> 
<strong style="color:brown">OL:</strong> <strong style="color:brown;font-family: Georgia, serif;">+234 8186249685, 8039349772</strong><br>
<strong style="color:brown">Office Address:</strong> <strong style="color:black;font-family: Georgia, serif;">3rd Floor, 19, Toyin Street, Ikeja, Lagos</strong><br>
<strong style="color:brown">Website:<em style="color:brown"> www.syscodescomms.com </em></strong><br>
<img src="{{ asset('assets/img/Syscodes.png') }}" style="width:30%" alt="App Logo"><br>
<h3 style="color:green">connecting with ease...</h3> 

@endcomponent
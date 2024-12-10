
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


<p> {{ $details['greeting'] }}</p>
<p>Survey details for: {{ $details['clients'] }}, ID:{{ $details['customer_id'] }}.</p>
<p>{{  $details ['body']  }}</p>
<p>Please Do Not respond to this </p>
<p>{{$details ['endpart']  }}</p>
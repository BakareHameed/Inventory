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
# Dear Delivery Team
This is to remind you that the following {{$pending}} pending client's survey(s) request have no engineer assigned to them:

@component('mail::table')
| ID | customer ID | Client| 
| -- |:----:| ----:|
@foreach($clients as $clients)
|{{ $clients->id }}|{{ $clients->customer_id }}| {{ $clients->clients }}|
@endforeach

@endcomponent

Please DO not reply to this email.




Thanks,<br>
{{ config('app.name') }}
@endcomponent

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
# Dear Network Team
This is to remind you that the following {{$pending}} client(s) is/are yet to be assigned integration parameters:

@component('mail::table')
| ID | Client |Customer ID | 
| -- |:----:| ----:|
@foreach($customers as $customers)
|{{ $customers->id }}|{{ $customers->clients }}| {{ $customers->customer_id }}|
@endforeach

@endcomponent

Please DO not reply to this email.




Thanks,<br>
{{ config('app.name') }}
@endcomponent

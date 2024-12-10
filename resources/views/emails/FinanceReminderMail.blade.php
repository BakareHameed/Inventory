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
# Dear Finance Team
This is to remind you that you have  {{ $pending }} pending client's payment to confirm.


@component('mail::table')
| ID | customer ID | Client| 
| -- |:----:| ----:|
@foreach($customers as $customers)
|{{ $customers->id }}|{{ $customers->customer_id }}| {{ $customers->clients }}|
@endforeach

@endcomponent


Please DO not reply to this email.




Thanks,<br>
{{ config('app.name') }}
@endcomponent

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
Please note that prospective client {{ $id  }} {{ $clients }},with residential address: {{$address}},has been created. Kindly assign an engineer for the survey. Thanks.


Please DO not reply to this email.




Thanks,<br>
{{ config('app.name') }}
@endcomponent

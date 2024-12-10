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
# Dear {{ $engr_name[0] }}
You have been assigned to carry out a physical survey for
the prospective client below:

Client's ID:<strong> {{ $customer_id  }}</strong><br>
Client's Name:<strong> {{ $clients }}</strong><br>
Client's Number:<strong> {{ $phone }}</strong><br>
Residential address: <strong> {{$address}}</strong>.
  
Kindly proceed <em> as soon as possible</em>, as your report will
be needed for any action to be taken on this project.





Thanks,<br>
{{ config('app.name') }}
@endcomponent

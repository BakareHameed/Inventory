<x-mail::message>
# Dear Team,

<p style="color:black">
    This is to notify you that <strong> {{$message['POP']}} POP</strong>,is down at the moment.<br>
    Also, Engineer<strong> {{$message['engineer']}} </strong> has been sent to the location.
    <br><br><strong>Kindly login to the ERP for further details relating to the site down.</strong><br><br>
    <strong>Best Regards.</strong>
</p>

<strong style="color:brown">{{ $message['sender_name'] }}</strong><br>

<strong style="color:brown">{{ $message['sender_role']  }} </strong><br>
<strong style="color:brown">Syscodes Communications Ltd.</strong><br>
<strong style="color:brown">Email:</strong> <strong><em style="color:blue;font-family: Georgia, serif;"> support@syscodescomms.com</em></strong> <br>
<strong style="color:brown">OL:</strong> <strong style="color:brown;font-family: Georgia, serif;">+234 8186249685, 8039349772</strong><br>
<strong style="color:brown">Office Address:</strong> <strong style="color:black;font-family: Georgia, serif;">3rd Floor, 19, Toyin Street, Ikeja, Lagos</strong><br>
<strong style="color:brown">Website:<em style="color:brown"> www.syscodescomms.com </em></strong><br>
<img src="{{ asset('assets/img/Syscodes.png') }}" style="width:30%" alt="App Logo"><br>
<h3 style="color:green">connecting with ease...</h3>
<br>
</x-mail::message>


<h2></h2>




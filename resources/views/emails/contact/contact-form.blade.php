@component('mail::message')

<p>Message sent through the Joinery Scene Website - Contact Us</p>
<strong>Name</strong><br> {{ $data['name'] }}<br><br>
<strong>Email</strong><br> {{ $data['email'] }}<br><br>
<strong>Phone</strong><br> {{ $data['phone'] }}<br><br>
<strong>Message</strong><br> {{ $data['message'] }}<br><br>

@endcomponent

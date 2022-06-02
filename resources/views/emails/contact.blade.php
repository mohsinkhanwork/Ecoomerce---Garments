@component('mail::message')
# Contact Us Form Email!

Email: {{ $msg['subject_email'] }}

Subject: {{ $msg['subject'] }}

Message: {{ $msg['message'] }}

@endcomponent
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Coming Soon - Urban Enigma</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/coming-soon.css') }}"/>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '970630876776102');
fbq('track', 'PageView');
fbq('track', 'ViewContent');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=970630876776102&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
    <div class="coming-soon">
        <div class="coming-soon-inner">
            <img src="{{ asset('frontend/assets/images/coming-soon-text.png') }}" class="coming-soon-text" alt="Urban Enigma">
            <img src="{{ asset('frontend/assets/images/coming-soon-logo.png') }}" class="coming-soon-logo" alt="Urban Enigma">
            <p>Stand out, be different by being yourself an Enigma</p>
        </div>
    </div>
</body>
</html>

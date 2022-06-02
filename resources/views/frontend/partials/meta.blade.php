	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="initial-scale=1,width=device-width" />
    @php 
    $meta_title = $meta_title??'Urban Engima | Online Clothing Store Inspired by Cultural Diversity';
    $meta_description = $meta_description??'Our clothes embrace the urban lifestyle as a combination of many different cultures and ethnicities. We believe in being unique, not perfect. Stand out, be different by just being yourself an Enigma! Know more.';
    $meta_tags = $meta_tags??'Urban Engima | Online Clothing Store Inspired by Cultural Diversity';
    $meta_img = $meta_img??asset('frontend/assets/images/enigma-puzzle.png');
    @endphp
    <title>{{$meta_title}}</title>

    <meta name="title" content="{{ $meta_title }}">
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_tags }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_description}}">
    <meta property="og:image" content="{{ $meta_img }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->full() }}">
    <meta property="twitter:title" content="{{$meta_title}}">
    <meta property="twitter:description" content="{{$meta_description}}">
    <meta property="twitter:image" content="{{ $meta_img }}">

	<link rel="canonical" href="{{url()->current()}}"/>
	<link rel="shortcut icon" href="{{ asset('frontend/assets/images/enigma-puzzle.png') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">

    <!-- Google Tag Manager - Analytics --- Starts -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154886863-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-154886863-1');
    </script>
	<!-- Google Tag Manager - Analytics --- Ends -->

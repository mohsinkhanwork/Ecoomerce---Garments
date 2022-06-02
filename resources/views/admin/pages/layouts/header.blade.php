<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Urban Enigma is an online store">
  <meta name="keywords" content="urban, enigma, online, store, buy, shirts, cap">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Dashboard &mdash; Urban Enigma Online Store</title>

  <!-- Styles -->
  <link href="{{ asset('css/core.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script src="{{ asset('js/dropzone.js') }}"></script>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
  <link rel="icon" href="{{ asset('img/favicon.png') }}">

  @yield('style')

</head>

<body>


<!-- Preloader -->
<div class="preloader">
  <div class="spinner-dots">
    <span class="dot1"></span>
    <span class="dot2"></span>
    <span class="dot3"></span>
  </div>
</div>

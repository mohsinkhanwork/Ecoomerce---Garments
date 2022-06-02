<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Urban Enigma is an online store">
    <meta name="keywords" content="urban, enigma, online, store, buy, shirts, cap">

    <title>Admin Login &mdash; Urban Enigma Online Store</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
</head>

<body>



<div class="row min-h-fullscreen center-vh p-20 m-0">
    <div class="col-12">
        <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
            <h5 class="text-uppercase">Sign in</h5>
            <br>

            <form class="form-type-material" method="post" action="{{ url('admin') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="current-password" required>
                    <label for="password">Password</label>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group flexbox flex-column flex-md-row">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">{{ __('Remember Me') }}</span>
                    </label>

                    <a class="text-muted hover-primary fs-13 mt-2 mt-md-0" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>

                <div class="form-group">
                    <button class="btn btn-bold btn-block btn-primary" type="submit">{{ __('Login') }}</button>
                </div>
            </form>

    </div>


    <footer class="col-12 align-self-end text-center fs-13">
        <p class="mb-0"><small>Copyright © 2019 <a href="#">Urban Enigma</a>. All rights reserved.</small></p>
    </footer>
</div>

</div>



<!-- Scripts -->
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>

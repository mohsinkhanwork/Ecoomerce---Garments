<div id="reg-log-popup" class="popup-container">

    <div class="reg-log-container">

        <div class="reg-log-close">
            <span></span>
        </div>

        <h3 class="text-center">Download Mobile App for Voucher codes and more !</h3>

        <div class="reg-log-inner" id="reg-log-inner">

            <div class="reg-log-mobile">
                <h3><a class="login-mobile reg-log-active" href="javascript:;">Login</a></h3>
                <span class="reg-log-slash">\</span>
                <h3><a class="register-mobile" href="javascript:;">Register</a></h3>
            </div>

            <div class="login-inner reg-log-target">
                <form id="login-form" method="post" action="{{ url('admin') }}">
                    @csrf
                    <h3>Login</h3>

                    <div class="input-bg">
                        <input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="username" required autofocus>
                    </div>

                    <div class="input-bg">
                        <input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password" autocomplete="current-password" required>
                    </div>

                    <span id="login-form-error-message" style="display: none;">These credentials do not match our records.</span>
                    <a href="javascript:;" id="forgot-link">Damn. I forgot my password!</a>

                    <div class="button-bg hvr-push">
                        <input type="submit" value="LOGIN" />
                    </div>
                </form>
            </div>

            <div class="register-inner reg-log-target">
                <form id="register-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h3>Register</h3>

                    <div class="input-bg">
                        <input type="text" placeholder="Name" name="name" required autofocus>
                    </div>

                    <div class="input-bg">
                        <input type="email" placeholder="Email" name="email" autocomplete="username" required>
                    </div>

                    <span id="register-form-error-message" style="color: red; display: none;"></span>

                    <div class="input-bg">
                        <input type="password" placeholder="Password" name="password" minlength="6" autocomplete="new-password" required>
                    </div>

                    <div class="input-bg">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" minlength="6" autocomplete="new-password" required>
                    </div>

                    <h5>
                        <input type="checkbox" id="reg-checkbox" name="promotions">
                        <label for="reg-checkbox">Send me discount, promotions info</label>
                    </h5>

                    <p>By clicking "Create Account", you agree to our Terms and Privacy Policy</p>

                    <div class="hvr-push button-bg">
                        <input type="submit" value="CREATE ACCOUNT" />
                    </div>
                </form>
            </div>

        </div>

        <div class="reg-log-inner" id="forgot-inner" style="width: 50%; display: none;">

            <div class="reg-log-mobile">
                <h3><a class="login-mobile reg-log-active" href="javascript:;">Login</a></h3>
                <span class="reg-log-slash">\</span>
                <h3><a class="register-mobile" href="javascript:;">Register</a></h3>
            </div>

            <div class="login-inner reg-log-target" style="border: none; float: none; width: 100%;">
                <form id="forgot-form" method="post" action="{{ route('password.email') }}">
                    @csrf
                    <h3>Forgot Password</h3>

                    <div class="input-bg">
                        <input type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="resetemail" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required autofocus>
                    </div>

                    <span id="forgot-form-error-message" class="alert" style="display: none;"></span>

                    <span class="loader" style="display: none"><i class="fa fa-spinner fa-3x fa-spin"></i></span>

                    <div class="button-bg hvr-push">
                        <input type="submit" value="Send Password Reset Link" />
                    </div>

                </form>
            </div>

        </div>

    </div>

    <img class="reg-log-key" src="{{ asset('frontend/assets/images/register-key.png') }}" alt="#"/>

</div>
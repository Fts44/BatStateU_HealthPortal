@extends('layout.index')

@push('title')
    <title>Login</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">

@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU - Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">Please enter your login credentials below.</p>

        	<form class="login-form mt-2" method="POST" action="{{ route('Login') }}">
                @csrf
                <div class="form-control">
                    <input class="form-control border" type="text" placeholder="Email or SR-Code" name="userid" value="{{ old('userid') }}">
                </div>
                <div id="userid_error" class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('userid')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Password" name="pass" id="pass" value="{{ old('pass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>
                <div id="pass_error" class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control non-input">
                	<a class="forgotPassword" href="{{ route('Recover') }}">Forgot Password</a>
                </div>


                <!-- <div class="form-control reCaptcha">
                    <div id="g-recaptcha" class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" data-sitekey="6LcasJsgAAAAADf5Toas_DlBccLh5wyGIzmDmjQi"></div>
                </div> -->

                <br>
                
                <button id="btnProceed" class="submit btn btn-secondary">Login</button>
            </form>

            <p> Don't have an account? Sign Up <a href="registration">here</a> <p>
        </div>
	</section>
@endsection

@push('script')
    <script src="{{ asset('js/recaptcha.js') }}"></script>
    <!-- google recaptcha -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function(){
            $('.showpassword').click(function(){            
                let input = $('#pass');
                if(input.attr('type') === 'password'){
                    input.attr('type','text');
                    $('.showpassword').removeClass('fa-eye-slash');
                    $('.showpassword').addClass('fa-eye');
                }
                else{
                    input.attr('type','password');
                    $('.showpassword').removeClass('fa-eye');
                    $('.showpassword').addClass('fa-eye-slash');
                }
            });
        });
    </script>
@endpush
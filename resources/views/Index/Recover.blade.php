@extends('Layout.Index')

@push('title')
    <title>Recover</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
    <section class="main">
		<div class="registration-container">
			<p class="title">BatStateU - Health Portal</p>
        	<p class="separator"></p>
        	<p class="welcome-message">To recover account enter your email and otp below.</p>
        	<form class="registration-form" method="POST" action="{{ route('Recover') }}">
                <div class="form-section">
                    @csrf
                    <div class="form-control">
                        <input class="form-control border field" type="text" placeholder="Gsuite or personal email" id="email" name="email"  value="{{ old('email') }}"> 
                    </div>
                    
                    <div id="email_error" class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('email')
                        {{ $message }}
                    @enderror
                    </div>

                    <div class="form-control">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8 pe-0" style="width: 70%;">
                                    <input class="form-control border field" type="number" placeholder="One Time Pin" id="otp" name="otp"  value="{{ old('otp') }}">
                                </div>
                                
                                <div class="col-lg-4 ps-1" style="width: 30%;">
                                    <a id="btn_otp" class="btn btn-secondary">
                                        <i class="lbl_loading fa-solid fa-spinner d-none" style="font-size: 14px;"></i>
                                        <span id="btn_otp_lbl">Send</span>
                                    </a>
                                </div>
                            </div>
                        </div>            
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('otp')
                        {{ $message }}
                    @enderror
                    </div>
                    

                    <div class="form-control">
                        <input class="form-control border field" type="password" placeholder="Password" id="pass" name="pass" value="{{ old('pass') }}">
                        <span class="showpassword fa-regular fa-eye-slash"></span>                               
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px; width: 450px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                    </div>

                    <div class="form-control">
                        <input class="form-control border field" type="password" placeholder="Confirm New Password" id="cpass" name="cpass" value="{{ old('cpass') }}">   
                        <span class="showpassword fa-regular fa-eye-slash"></span>     
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('cpass')
                        {{ $message }}
                    @enderror
                    </div>
                    

                    <!-- <div class="form-control reCaptcha">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" data-sitekey="6LcasJsgAAAAADf5Toas_DlBccLh5wyGIzmDmjQi"></div>
                    </div> -->
                </div>

                <button id="btnProceed " class="submit btn btn-secondary" style="float: right;">Recover</button>     
                
            </form>

            <p>Already have an account?  Login <a href="{{ route('Login') }}">here</a> <p>
        </div>
	</section>

@endsection

@push('script')
    <script>
        $(document).ready(function(){
            @if(session('status'))
                @php 
                    $status = json_decode(session('status'));                      
                @endphp
                swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
            @endif

            $('.showpassword').click(function(){
                $('.showpassword').toggleClass('fa fa-eye-slash');
                let input_pass = $('#pass, #cpass');
                if(input_pass.attr('type') === 'password'){
                    input_pass.attr('type','text');
                    $('.showpassword').removeClass('fa-eye-slash');
                    $('.showpassword').addClass('fa-eye');
                }
                else{
                    input_pass.attr('type','password');
                    $('.showpassword').removeClass('fa-eye');
                    $('.showpassword').addClass('fa-eye-slash');
                }
            });

            $('#btn_otp').click(function(e){
                e.preventDefault();
                let email = $('#email').val();

                $('.lbl_loading').removeClass('d-none');
                $('#btn_otp_lbl').addClass('d-none');

                $.ajax({
                    type: "POST",
                    url: "{{ route('SendOTP') }}",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "email": email,
                        "msg_type": "recover",
                        "_token": "{{csrf_token()}}",
                    }),
                    success: function(response){
                        response = JSON.parse(response);
                        console.log(response);
                        $('.lbl_loading').addClass('d-none');
                        $('#btn_otp_lbl').removeClass('d-none');

                        if(response.status == 400){
                            $.each(response.errors, function(key, err_values){
                                $('#'+key+'_error').html(err_values);
                            });
                        }
                        else{
                            $('.error-message').html('');
                            swal(response.title, response.message, response.icon);
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush
@extends('layout.index')

@push('title')
    <title>Registration</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('CSS/Registration.css') }}">
@endpush

@section('content')
    <section class="main">
		<div class="registration-container p-3 mt-5">
			<p class="title">BatStateU - Health Portal</p>
        	<p class="separator"></p>
        	<p class="welcome-message">To register enter your email and otp below.</p>
        	<form class="registration-form" method="POST" action="{{ route('Registration') }}">
                <div class="form-section">
                    @csrf
                    <div class="form-control">
                        <input class="form-control border field" type="text" placeholder="Email" id="email" name="email"  value="{{ old('email') }}"> 
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

                    <div class="form-control border-0">
                        <input class="form-control border field" type="password" placeholder="Password" id="pass" name="pass" value="{{ old('pass') }}">
                        <span class="showpassword fa-regular fa-eye-slash"></span>                               
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px; width: 450px;">
                        @error('pass')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-control border-0">
                        <input class="form-control border field" type="password" placeholder="Confirm New Password" id="cpass" name="cpass" value="{{ old('cpass') }}">   
                        <span class="showpassword fa-regular fa-eye-slash"></span>     
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                        @error('cpass')
                            {{ $message }}
                        @enderror
                    </div>
                    
                    <div class="form-control">
                        <select class="form-select field pt-auto" name="classification" id="classification">
                            <option value="">Choose Classification</option>
                            <option value="student" {{ (old('classification')=='student')?'selected':'' }}>Student</option>
                            <option value="teacher" {{ (old('classification')=='teacher')?'selected':'' }}>Teacher</option>
                            <option value="school personnel" {{ (old('classification')=='school personnel')?'selected':'' }}>School Personnel</option>
                            <option value="infirmary personnel" {{ (old('classification')=='infirmary personnel')?'selected':'' }}>Infirmary Personnel</option>
                        </select>
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px; max-width: 450px;">
                        @error('classification')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-control">
                        <select class="form-select field pt-auto {{ (!$errors->has('position')&&old('position')==null)?'d-none':'' }}" name="position" id="position">
                            <option value="">Choose Position</option>
                            <option value="dentist" {{ (old('position')=='dentist')?'selected':'' }}>Dentist</option>
                            <option value="doctor" {{ (old('position')=='doctor')?'selected':'' }}>Doctor</option>
                            <option value="nurse" {{ (old('position')=='nurse')?'selected':'' }}>Nurse</option>
                        </select>
                    </div>
                    
                    <div class="error-message text-danger px-3" id="position_error" style="font-size: 14px; max-width: 450px;">
                        @error('position')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-control d-flex text-center">
                    <button class="submit btn btn-secondary" style="float: right;">Register</button>
                </div>
                    
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
                        "msg_type": "register",
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

            $('#classification').change(function(e){
                e.preventDefault();
                if($(this).val() == 'infirmary personnel'){
                    $('#position').removeClass('d-none');
                    $('#position_error').removeClass('d-none');
                }
                else{
                    $('#position').addClass('d-none');
                    $('#position_error').addClass('d-none');
                }
            });

        });
    </script>
@endpush
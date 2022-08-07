@extends('layout.patient-main')

@push('title')
    <title>Patient Profile</title>
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle mb-3">
        <h1>Personal Info</h1>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            @php
                                if(session()->has('active_page')){
                                    $active_page = session()->get('active_page');
                                }
                                else{
                                    $active_page = 'profile';
                                }
                            @endphp
                            
                            <li class="nav-item">
                                <button class="nav-link {{ ($active_page=='profile') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link  {{ ($active_page=='emergency contact') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-emergency-contact">Emergency Contact</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link {{ ($active_page=='password') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Password</button>
                            </li>

                        </ul>
                        
                       
                        <div class="tab-content pt-2">
                            <!-- Profile Edit Form -->
                            <div class="tab-pane fade p-3 {{ ($active_page=='profile') ? 'active show' : '' }}" id="profile-edit">

                                <form method="POST" enctype="multipart/form-data" action="{{ route('UpdatePatientProfile', ['id'=>Session::get('user_id')]) }}">
                                   
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label d-flex justify-content-center" for="profile_pic">Profile Picture</label>
                                        <div class="col-lg-12 mt-1 d-flex justify-content-center">
                                            <img id="profile_pic_preview" class="form-control p-2" src="{{ ($user_details->profile_pic) ? asset('storage/profile_picture/'.$user_details->profile_pic) : asset('storage/profile_picture/default.jpg') }}" alt="Upload image" style="height: 200px; width: 200px;">
                                        </div>
                                        <div class="col-lg-12 mt-3 d-flex justify-content-center">
                                            <input class="w-50 form-control" type="file" name="profile_pic" id="profile_pic" accept=".jpg,.png">
                                        </div>
                                    </div>

                                    <div class="row mb-3">  
                                        <div class="col-lg-6">
                                            <label class="col-lg-12 col-form-label" for="gsuite_email">Gsuite Email</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="gsuite_email" id="gsuite_email" type="text" class="form-control" placeholder="abc@g.batstate-u.edu.ph" value="{{ old('gsuite_email',$user_details->gsuite_email) }}" {{ ($user_details->gsuite_email) ? 'readonly' : '' }}>
                                            </div>
                                            <span class="text-danger">
                                                @error('gsuite_email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="col-lg-6 {{ ($user_details->gsuite_email) ? 'd-none' : '' }}" >
                                            <div class="row">
                                                <label for="otp" class="col-lg-12 col-form-label ">One Time Pin</label>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 mt-1">
                                                            <input type="text" class="form-control" placeholder="OTP" name="otp" id="otp" {{ ($user_details->gsuite_email) ? 'disabled' : '' }}>
                                                            <span class="text-danger">
                                                                @error('otp')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <a class="btn btn-secondary" style="width: 100%;" id="btn_otp">
                                                                <span class="spinner-border spinner-border-sm d-none" id="lbl_loading" role="status" aria-hidden="true"></span>
                                                                <span id="lbl_otp"> Get otp</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-8">
                                            <label class="col-lg-12 col-form-label" for="email">Personal Email</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="email" id="email" type="text" class="form-control"  placeholder="abc@example.com" value="{{   old('email', $user_details->email) }}">
                                            </div>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>   
                                        
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="sr_code">SR-Code:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="sr_code" id="sr_code" type="text" class="form-control" placeholder="12-34567"  value="{{ old('sr_code', $user_details->sr_code) }}" >
                                            </div>
                                            <span class="text-danger">
                                                @error('sr_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="col-lg-12 col-form-label">Name</label>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="first_name" type="text" class="form-control" placeholder="First"  value="{{ old('first_name', $user_details->first_name) }}" >
                                                            <span class="text-danger">
                                                                @error('first_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="middle_name" type="text" class="form-control" placeholder="Middle"  value="{{ old('middle_name', $user_details->middle_name) }}" >
                                                            <span class="text-danger">
                                                                @error('middle_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="last_name" type="text" class="form-control" placeholder="Last" value="{{ old('last_name', $user_details->last_name) }}" >
                                                            <span class="text-danger">
                                                                @error('last_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-2 mt-1">
                                                    <input name="suffix_name" type="text" class="form-control" placeholder="Suffix" value="{{ old('suffix_name', $user_details->suffix_name) }}" >
                                                </div>
                                            </div>
                                            
                                        </div>           
                                    </div>  

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="col-lg-12">
                                                <label for="" class="col-lg-12  col-form-label">Gender</label>
                                                <div class="col-lg-12 mt-1 text-center">
                                                    <select class="form-select" name="gender" id="gender">
                                                        <option value="">--- Choose gender ---</option>
                                                        <option value="male" {{ (old('gender', $user_details->gender)=='male') ? 'selected' : '' }} >Male</option>
                                                        <option value="female" {{ (old('gender', $user_details->gender)=='female') ? 'selected' : '' }} >Female</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger">
                                                    @error('gender')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="civil_status">Civil Status:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="civil_status" id="civil_status">
                                                    <option value="">--- Choose status ---</option>
                                                    <option value="single" {{ (old('civil_status', $user_details->civil_status)=='single') ? 'selected' : '' }} >Single</option>
                                                    <option value="married" {{ (old('civil_status', $user_details->civil_status)=='married') ? 'selected' : '' }} >Married</option>
                                                    <option value="widowed" {{ (old('civil_status', $user_details->civil_status)=='widowed') ? 'selected' : '' }} >Widowed</option>
                                                    <option value="divorced" {{ (old('civil_status', $user_details->civil_status)=='divorced') ? 'selected' : '' }} >Divorced</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('civil_status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="contact" class="col-lg-12 col-form-label">Contact Number</label>
                                            <input type="tel" class="form-control mt-1" name="contact" id="contact" value="{{ old('contact', $user_details->contact) }}" >
                                            <span class="text-danger">
                                                @error('contact')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label" for="home_prov">Home Address</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_prov" id="home_prov">
                                                <option value="">--- Choose Province ---</option>
                                                @foreach($provinces as $province)
                                                    @if(!$home_add)
                                                        <option value='{{ $province->provCode }}' {{ ((old('home_prov')==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @else
                                                        <option value='{{ $province->provCode }}' {{ ((old('home_prov',$home_add->province)==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>  
                                            <span class="text-danger">
                                                @error('home_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span>      
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_mun" id="home_mun">
                                                <option value="">--- Choose Municipality ---</option>
                                                @if(!old('home_mun'))
                                                    @if($home_municipalities)
                                                        @foreach($home_municipalities as $municipality)
                                                            <option value='{{ $municipality->citymunCode }}' {{ ((old('home_mun',$home_add->municipality)==$municipality->citymunCode) ? 'selected' : '' ) }}>{{ $municipality->citymunDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>  
                                            <span class="text-danger">
                                                @error('home_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span>       
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_brgy" id="home_brgy">
                                                <option value="">--- Choose Barangay ---</option>
                                                @if(!old('home_brgy'))
                                                    @if($home_barangays)
                                                        @foreach($home_barangays as $barangay)
                                                            <option value='{{ $barangay->brgyCode }}' {{ ((old('birth_brgy',$home_add->barangay)==$barangay->brgyCode) ? 'selected' : '' ) }}>{{ $barangay->brgyDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select> 
                                            <span class="text-danger">
                                                @error('home_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span>        
                                        </div>  
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="religion">Religion:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input type="text" class="form-control" name="religion" id="religion" value="{{ old('religion', $user_details->religion) }}">
                                            </div>
                                            <span class="text-danger">
                                                @error('religion')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="birthdate">Birthdate:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="birthdate" id="birthdate" type="date" class="form-control" value="{{ old('birthdate', $user_details->birthdate) }}">
                                            </div>
                                            <span class="text-danger">
                                                @error('birthdate')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="classification">Classification:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="classification" id="classification">
                                                    <option value="">--- Choose classification ---</option>
                                                    <option value="student" {{ (old('classification', $user_details->classification)=='student') ? 'selected' : '' }} >Student</option>
                                                    <option value="teacher" {{ (old('classification', $user_details->classification)=='teacher') ? 'selected' : '' }} >Teacher</option>
                                                    <option value="school personnel" {{ (old('classification', $user_details->classification)=='school personnel') ? 'selected' : '' }} >School Personnel</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('classification')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>  
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label">Place of Birth</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_prov" id="birth_prov">
                                                <option value="">--- Choose Province ---</option>
                                                @foreach($provinces as $province)
                                                    @if(!$birth_add)
                                                        <option value='{{ $province->provCode }}' {{ ((old('birth_prov')==$province->provCode) ? 'selected' : '' ) }}>{{ $province->provDesc }}</option>
                                                    @else
                                                        <option value='{{ $province->provCode }}' {{ ((old('birth_prov',$birth_add->province)==$province->provCode) ? 'selected' : '' ) }}>{{ $province->provDesc }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_mun" id="birth_mun">
                                                <option value="">--- Choose Municipality ---</option>
                                                @if(!old('birth_mun'))
                                                    @if($birth_municipalities)
                                                        @foreach($birth_municipalities as $municipality)
                                                            <option value='{{ $municipality->citymunCode }}' {{ ((old('birth_mun',$birth_add->municipality)==$municipality->citymunCode) ? 'selected' : '' ) }}>{{ $municipality->citymunDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_brgy" id="birth_brgy">
                                                <option value="">--- Choose Barangay ---</option>
                                                @if(!old('birth_brgy'))
                                                    @if($birth_barangays)
                                                        @foreach($birth_barangays as $barangay)
                                                            <option value='{{ $barangay->brgyCode }}' {{ ((old('birth_brgy',$birth_add->barangay)==$barangay->brgyCode) ? 'selected' : '' ) }}>{{ $barangay->brgyDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="grade_level">Grade level:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="grade_level" id="grade_level">
                                                    <option value="">--- Choose grade level ---</option>
                                                    <option value="Elementary" {{ (old('grade_level', $user_details->grade_level)=='Elementary') ? 'selected' : '' }}>Elementary</option>
                                                    <option value="Junior High School" {{ (old('grade_level', $user_details->grade_level)=='Junior High School') ? 'selected' : '' }}>Junior High School</option>
                                                    <option value="Senior High School" {{ (old('grade_level', $user_details->grade_level)=='Senior High School') ? 'selected' : '' }}>Senior High School</option>
                                                    <option value="College" {{ (old('grade_level', $user_details->grade_level)=='College') ? 'selected' : '' }}>College</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('grade_level')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="department">Department:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="department" id="department">
                                                    <option value="1">--- Choose department ---</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('department')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="program">Program:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="program" id="program">
                                                    <option value="1">--- Choose program ---</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('program')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label">Dorm Address (If any)</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_prov" id="dorm_prov">
                                                <option value="">--- Choose Province ---</option>
                                                @foreach($provinces as $province)
                                                    @if($dorm_add)
                                                        <option value='{{ $province->provCode }}' {{ ((old('dorm_prov',($dorm_add->province))==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @else
                                                        <option value='{{ $province->provCode }}' {{ ((old('dorm_prov')==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>        
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_mun" id="dorm_mun">
                                                <option value="">--- Choose Municipality ---</option>
                                                @if(!old('dorm_mun'))
                                                    @if($dorm_municipalities)
                                                        @foreach($dorm_municipalities as $municipality)
                                                            <option value='{{ $municipality->citymunCode }}' {{ ((old('dorm_mun',$dorm_add->municipality)==$municipality->citymunCode) ? 'selected' : '' ) }}>{{ $municipality->citymunDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>  
                                            <span class="text-danger">
                                                @error('dorm_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span>      
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_brgy" id="dorm_brgy">
                                                <option value="">--- Choose Barangay ---</option>
                                                @if(!old('dorm_brgy'))
                                                    @if($dorm_barangays)
                                                        @foreach($dorm_barangays as $barangay)
                                                            <option value='{{ $barangay->brgyCode }}' {{ ((old('dorm_brgy',$dorm_add->barangay)==$barangay->brgyCode) ? 'selected' : '' ) }}>{{ $barangay->brgyDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>  
                                            <span class="text-danger">
                                                @error('dorm_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span>       
                                        </div>  
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form>

                            </div>
                            <!-- End Profile Edit Form -->

                            <!-- emergency contact form -->
                            <div class="tab-pane fade p-3  {{ ($active_page=='emergency contact') ? 'active show' : '' }}" id="profile-emergency-contact">

                                <form method="POST" action="{{ route('UpdatePatientEmergencyContact', ['id'=>Session::get('user_id')]) }}">
                                    
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label" for="">Name</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_fn" id="emerg_fn" placeholder="First" value="{{ old('emerg_fn',$user_details->ec_first_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_fn')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_mn" id="emerg_mn" placeholder="Middle" value="{{ old('emerg_mn',$user_details->ec_middle_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_mn')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_ln" id="emerg_ln" placeholder="Last" value="{{ old('emerg_ln',$user_details->ec_last_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_ln')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mt-1">
                                            <input class="form-control" type="text" name="emerg_sn" id="emerg_sn" placeholder="Suffix" value="{{ old('emerg_sn',$user_details->ec_suffix_name) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label for="emerg_landline" class="col-lg-12 col-form-label">Landline</label>
                                            <input class="form-control mt-1" type="text" placeholder="" name="emerg_landline" id="emerg_landline" value="{{ old('emerg_landline',$user_details->ec_landline) }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="emerg_contact" class="col-lg-12 col-form-label">Contact Number</label>
                                            <input class="form-control mt-1" type="tel"  placeholder="09123456789" name="emerg_contact" id="emerg_contact" value="{{ old('emerg_contact',$user_details->ec_contact) }}">
                                            <span class="text-danger">
                                                @error('emerg_contact')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="emerg_relation" class="col-lg-12 col-form-label">Relation to you</label>
                                            <input type="text" class="form-control mt-1" name="emerg_relation" id="emerg_relation" placeholder="" value="{{ old('emerg_relation',$user_details->ec_rtp) }}">
                                            <span class="text-danger">
                                                @error('emerg_relation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="" class="col-lg-12 col-form-label">Bussiness Address</label>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_prov" id="emerg_prov">
                                                <option value="">Choose Province</option>
                                                @foreach($provinces as $province)
                                                    @if(!$ec_biz_add)
                                                        <option value='{{ $province->provCode }}' {{ ((old('emerg_prov')==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @else
                                                        <option value='{{ $province->provCode }}' {{ ((old('emerg_prov',$ec_biz_add->province)==$province->provCode) ? 'selected' : '' ) }}>{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_mun" id="emerg_mun">
                                                <option value="">Choose Municipality</option>
                                                @if(!old('emerg_mun'))
                                                    @if($emerg_municipalities)
                                                        @foreach($emerg_municipalities as $municipality)
                                                            <option value='{{ $municipality->citymunCode }}' {{ ((old('home_mun',$ec_biz_add->municipality)==$municipality->citymunCode) ? 'selected' : '' ) }}>{{ $municipality->citymunDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_brgy" id="emerg_brgy">
                                                <option value="">Choose Barangay</option>
                                                @if(!old('emerg_brgy'))
                                                    @if($emerg_barangays)
                                                        @foreach($emerg_barangays as $barangay)
                                                            <option value='{{ $barangay->brgyCode }}' {{ ((old('emerg_brgy',$ec_biz_add->barangay)==$barangay->brgyCode) ? 'selected' : '' ) }}>{{ $barangay->brgyDesc }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form>

                            </div>
                            <!-- emergency contact form -->

                            <!-- Change Password Form -->
                            <div class="tab-pane fade p-3  {{($active_page=='password') ? 'active show' : '' }}" id="profile-change-password">
                               
                                <form method="POST" action="{{ route('UpdatePatientPassword', ['id'=>Session::get('user_id')]) }}">
                                    
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="new_pass" class="col-lg-12 col-form-label">New Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="new_pass" id="new_pass" value="{{ old('new_pass') }}">
                                            <span class="text-danger">
                                                @error('new_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="confirm_pass" class="col-lg-12 col-form-label">Confirm Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" value="{{ old('confirm_pass') }}">
                                            <span class="text-danger">
                                                @error('confirm_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="old_pass" class="col-lg-12 col-form-label">Old Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="old_pass" id="old_pass" value="{{ old('old_pass') }}">
                                            <span class="text-danger">
                                                @error('old_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-lg-5 mt-1">
                                        <input class="showpassword" type="checkbox" name="showpassword" id="showpassword"> 
                                        <label for="showpassword">Show password</label>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form><!-- End Change Password Form -->

                            </div>
                            <!-- Change Password Form -->
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>

            </div>
        </div>
    </section>

  </main>
  <!-- main -->

@endsection

@push('script')
<script src="{{ asset('js/select.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
<script>
    @if(old('home_prov'))
        set_municipality('#home_mun','{{ old("home_mun") }}', '{{ old("home_prov") }}', '#home_brgy');
        @if(old('home_mun'))
            set_barangay('#home_brgy','{{ old("home_brgy") }}', '{{ old("home_mun") }}');
        @endif
    @endif

    @if(old('birth_prov'))
        set_municipality('#birth_mun','{{ old("birth_mun") }}', '{{ old("birth_prov") }}', '#birth_brgy');
        @if(old('birth_mun'))
            set_barangay('#birth_brgy','{{ old("birth_brgy") }}', '{{ old("birth_mun") }}');
        @endif
    @endif
    
    @if(old('dorm_mun'))
        set_municipality('#dorm_mun','{{ old("dorm_mun") }}', '{{ old("dorm_prov") }}', '#dorm_brgy');
        @if(old('dorm_mun'))
            set_barangay('#dorm_brgy','{{ old("dorm_brgy") }}', '{{ old("dorm_mun") }}');
        @endif
    @endif

    @if(old('emerg_mun'))
        set_municipality('#emerg_mun','{{ old("emerg_mun") }}', '{{ old("emerg_prov") }}', '#emerg_brgy');
        @if(old('emerg_mun'))
            set_barangay('#emerg_brgy','{{ old("emerg_brgy") }}', '{{ old("emerg_mun") }}');
        @endif
    @endif

    $(document).ready(function(){

        @if(session('status'))  
            @php 
                $status = json_decode(session('status'));                      
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif

        
        $('#btn_otp').click(function(e){
            e.preventDefault();
            let gsuite_email = $('#gsuite_email').val();
            if(!gsuite_email.includes('@g.batstate-u.edu.ph')){
                swal('Error!', 'Invalid gsuite email', 'error');
            }
            else{
                $('#lbl_loading').removeClass('d-none');
                $('#lbl_otp').addClass('d-none');
                $.ajax({
                    type: "POST",
                    url: "{{ route('SendOTP') }}",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "email": gsuite_email,
                        "msg_type": "register",
                        "_token": "{{csrf_token()}}",
                    }),
                    success: function(response){
                        response = JSON.parse(response);
                        console.log(response);
                        $('#lbl_loading').addClass('d-none');
                        $('#lbl_otp').removeClass('d-none');
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
            }          
        });
    });
</script>
@endpush
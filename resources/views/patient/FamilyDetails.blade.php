@extends('layout.patient-main')

@push('title')
    <title>Family Details</title>
@endpush

@section('content')
    <div id="main" class="main">
        <div class="pagetitle mb-3">
            <h1>Family Details</h1>
        </div>
        
        <div class="section">
            <div class="card px-4 py-3" id="cardTable">
                <div class="card-body px-4 py-3">
                    <form method="POST" action="{{ route('UpdatePatientFamilyDetails', ['id'=>Session::get('user_id')]) }}">
                        @csrf 

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label class="col-lg-12 col-form-label">Father Name <span class="text-danger field-required">*</span></label>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-4 mt-1">
                                                <input name="father_fn" type="text" class="form-control" placeholder="First"  value="{{ old('father_fn',$user_fd_details->father_fn) }}">
                                                <span class="text-danger">
                                                    @error('father_fn')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-lg-4 mt-1">
                                                <input name="father_mn" type="text" class="form-control" placeholder="Middle"  value="{{ old('father_mn',$user_fd_details->father_mn) }}" >
                                                <span class="text-danger">
                                                    @error('father_mn')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-lg-4 mt-1">
                                                <input name="father_ln" type="text" class="form-control" placeholder="Last" value="{{ old('father_ln',$user_fd_details->father_ln) }}" >
                                                <span class="text-danger">
                                                    @error('father_ln')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div> 
                                    </div>  
                                    <div class="col-lg-2 mt-1">
                                        <input name="father_sn" type="text" class="form-control" placeholder="Suffix" value="{{ old('father_sn',$user_fd_details->father_sn) }}" >
                                    </div>
                                </div>
                            </div>           
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="col-lg-12 col-form-label">Father Occupation <span class="text-danger field-required">*</span></label>
                                <input type="text" class="form-control" name="father_occupation" value="{{ old('father_occupation',$user_fd_details->father_occupation) }}">
                                <span class="text-danger">
                                    @error('father_occupation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label class="col-lg-12 col-form-label">Mother Name <span class="text-danger field-required">*</span></label>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-4 mt-1">
                                                <input name="mother_fn" type="text" class="form-control" placeholder="First" value="{{ old('mother_fn',$user_fd_details->mother_fn) }}">
                                                <span class="text-danger">
                                                    @error('mother_fn')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-lg-4 mt-1">
                                                <input name="mother_mn" type="text" class="form-control" placeholder="Middle"  value="{{ old('mother_mn',$user_fd_details->mother_mn) }}" >
                                                <span class="text-danger">
                                                    @error('mother_mn')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-lg-4 mt-1">
                                                <input name="mother_ln" type="text" class="form-control" placeholder="Last" value="{{ old('mother_ln',$user_fd_details->mother_ln) }}" >
                                                <span class="text-danger">
                                                    @error('mother_ln')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div> 
                                    </div>  
                                    <div class="col-lg-2 mt-1">
                                        <input name="mother_sn" type="text" class="form-control" placeholder="Suffix" value="{{ old('mother_sn',$user_fd_details->mother_sn) }}" >
                                    </div>
                                </div>
                            </div>           
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="col-lg-12 col-form-label">Mother Occupation <span class="text-danger field-required">*</span></label>
                                <input type="text" class="form-control" name="mother_occupation" value="{{ old('mother_occupation',$user_fd_details->mother_occupation) }}">
                                <span class="text-danger">
                                    @error('mother_occupation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label class="col-lg-12 col-form-label">Present Marital Status <span class="text-danger field-required">*</span></label>
                                <select class="form-select" name="marital_status">
                                    <option value="">--- Choose ---</option>
                                    <option value="married" {{ (old('marital_status',$user_fd_details->marital_status)=='married') ? 'selected' : '' }}>Married</option>
                                    <option value="unmarried" {{ (old('marital_status',$user_fd_details->marital_status)=='unmarried') ? 'selected' : '' }}>Unmarried</option>
                                    <option value="separated" {{ (old('marital_status',$user_fd_details->marital_status)=='separated') ? 'selected' : '' }}>Separated</option>
                                </select>
                                <span class="text-danger">
                                    @error('marital_status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>                
                        </div>

                        <div class="row mb-3 mt-4">
                            <label class="col-lg-12">Family illness history</label>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="diabetes" id="diabetes" {{ (old('diabetes')=='on') ? 'selected' : ($user_fd_details->diabetes == 1) ? 'checked' : '' }}>
                                        <label for="diabetes">Diabetes</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="heart_disease" id="heart_disease" {{ (old('heart_disease')=='on') ? 'selected' : ($user_fd_details->heart_disease == 1) ? 'checked' : '' }}>
                                        <label for="heart_disease">Heart Disease</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="mental_illness" id="mental_illness"  {{ (old('mental_illness')=='on') ? 'selected' : ($user_fd_details->mental_illness == 1) ? 'checked' : '' }}>
                                        <label for="mental_illness">Mental illness</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="cancer" id="cancer" {{ (old('cancer')=='on') ? 'selected' : ($user_fd_details->cancer == 1) ? 'checked' : '' }}>
                                        <label for="cancer">Cancer</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="hypertension" id="hypertension" {{ (old('hypertension')=='on') ? 'selected' : ($user_fd_details->hypertension == 1) ? 'checked' : '' }}>
                                        <label for="hypertension">Hypertension</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="kidney_disease" id="kidney_disease" {{ (old('kidney_disease')=='on') ? 'selected' : ($user_fd_details->kidney_disease == 1) ? 'checked' : '' }}>
                                        <label for="kidney_disease">Kidney Disease</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input type="checkbox" name="epilepsy" id="epilepsy" {{ (old('epilepsy')=='on') ? 'selected' : ($user_fd_details->epilepsy == 1) ? 'checked' : '' }}>
                                        <label for="epilepsy">Epilepsy</label>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <input class="form-control" type="text" name="others" id="others" placeholder="others pls specify" value="{{ old('others', $user_fd_details->others) }}">
                                    </div>
                                </div>

                               
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>  
            </div>  
        </div>  
    </div>
@endsection

@push('script')
<script>
    @if(session('status'))  
        @php 
            $status = json_decode(session('status'));                      
        @endphp
        swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
    @endif
</script>

@endpush
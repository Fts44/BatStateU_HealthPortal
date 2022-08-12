@extends('layout.admin-main')

@push('title')
    <title>Patient Accounts</title>
@endpush


@section('content')

<div id="main" class="main">
   
<div class="pagetitle">
    <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Patient</li>
                <li class="breadcrumb-item">Details</li>
            </ol>
        </nav>
    </div>

    <div class="section profile">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body profile-card pt-4" style="overflow-y: scroll; height: 75vh;">
                        <div class="d-flex flex-column align-items-center">
                            <img id="profile_pic_preview" class="form-control p-2" src="{{ ($user_details->profile_pic) ? asset('storage/profile_picture/'.$user_details->profile_pic) : asset('storage/profile_picture/default.jpg') }}" alt="profile_image" style="height: 125px; width: 125px;">
                            
                        </div>
                        
                        <div class="row mt-2">
                            <label class="col-form-label">
                                <span class="label-profile">SR-Code:</span>
                                {{ $user_details->sr_code }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Name:</span>
                                {{ $user_details->first_name." ".$user_details->middle_name." ".$user_details->last_name }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Classification:</span>
                                {{ $user_details->classification }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Gender:</span>
                                {{ $user_details->gender }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Grade:</span>
                                {{ $user_details->gl_name }}
                            </label>
                            @if($user_details->classification == 'student')
                                <label class="col-form-label">
                                    <span class="label-profile">Department:</span>
                                    {{ $user_details->dept_code }}
                                </label>
                                <label class="col-form-label">
                                    <span class="label-profile">Program:</span>
                                    {{ $user_details->prog_code }}
                                </label>
                            @endif
                            <label class="col-form-label">
                                <span class="label-profile">Gsuite:</span>
                                {{ $user_details->gsuite_email }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Email:</span>
                                {{ $user_details->email }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Contact:</span>
                                {{ $user_details->contact }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Home Address:</span><br>
                                {{ $user_details->home_brgy.", ".$user_details->home_mun.", ".$user_details->home_prov }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Civil Status:</span>
                                {{ $user_details->civil_status }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Religion:</span>
                                {{ $user_details->religion }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Birthdate:</span>
                                {{ date_format(date_create($user_details->birthdate), "M d, Y") }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Birth place:</span><br>
                                {{ $user_details->birth_brgy.", ".$user_details->birth_mun.", ".$user_details->birth_prov }}
                            </label>
                            <label class="col-form-label">
                                <span class="label-profile">Dorm address:</span><br>
                                {{ $user_details->dorm_brgy.", ".$user_details->dorm_mun.", ".$user_details->dorm_prov }}
                            </label>
                        </div>
                        
                    </div>  
                </div>
            </div>


            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" 
                                data-bs-target="#documents">Documents</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" 
                                data-bs-target="#uploads">Uploads</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" 
                                data-bs-target="#visit">Visit</button>
                            </li>

                        </ul>   

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview mt-4" id="documents">
                                <table id="datatable" class="table table-striped nowrap" style="width:100%">
                                    <thead class="border" style="width: 100%;"> 
                                        <tr>
                                            <th scope="col">Action</th>
                                            <th scope="col">ID</th>      
                                            <th scope="col">Document</th>      
                                            <th scope="col">Filename</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade profile-overview" id="uploads">
                                <table id="datatable" class="table table-striped nowrap" style="width:100%">
                                    <thead class="border" style="width: 100%;"> 
                                        <tr>
                                            <th scope="col">ID</th>      
                                            <th scope="col">Document</th>      
                                            <th scope="col">Filename</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="visit">
                                <table id="datatable" class="table table-striped nowrap" style="width:100%">
                                    <thead class="border" style="width: 100%;"> 
                                        <tr>
                                            <th scope="col">ID</th>      
                                            <th scope="col">Document</th>      
                                            <th scope="col">Filename</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
  
@push('script')
    <script>
        const datatable = $('.table').DataTable({
            rowReorder: {
            selector: 'td:nth-child(2)'
            },
            responsive: true,
        });
    </script>
    <script>
       
    </script>
@endpush
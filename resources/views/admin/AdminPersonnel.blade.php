@extends('layout.admin-main')

@push('title')
    <title>Patient Accounts</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item">Patient</li>
                    <li class="breadcrumb-item active">Personnel</li>
                </ol>
            </nav>
        </div>
        
        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4">
                    <h5 class="card-title">Patient Details</h5>
                    <!-- <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a> -->
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col" class='d-none'>PatientID</th>
                                <th scope="col" class='d-none'>Gsuite</th>
                                <th scope="col" class='d-none'>Email</th>
                                <th scope="col" class='d-none'>Contact</th>
                                <th scope="col" class='d-none'>Birthdate</th>
                                <th scope="col" class='d-none'>Gender</th>
                                <th scope="col" class='d-none'>CivilStatus</th>
                                <th scope="col" class='d-none'>Religion</th>
                                <th scope="col" class='d-none'>ProfilePic</th>
                                <th scope="col" class='d-none'>IsVerified</th>
                                <th scope="col" class='d-none'>RegisteredDate</th>
                                <th scope="col" class='d-none'>HomePlace</th>
                                <th scope="col" class='d-none'>BirthPlace</th>
                                <th scope="col" class='d-none'>DormPlace</th>
                                <th scope="col" class='d-none'>EmergencyName</th>
                                <th scope="col" class='d-none'>RelationToPatient</th>
                                <th scope="col" class='d-none'>Landline</th>
                                <th scope="col" class='d-none'>Contact</th>
                                <th scope="col" class='d-none'>BusinessAddress</th>

                                <th scope="col">Classification</th>
                                <th scope="col">Position</th>
                                <th scope="col">SRCode</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @foreach($patients as $patient)
                        <tr>
                            <td class='d-none'>{{ $patient->acc_id }}</td> 
                            <td class='d-none'>{{ $patient->gsuite_email }}</td> 
                            <td class='d-none'>{{ $patient->email }}</td> 
                            <td class='d-none'>{{ $patient->contact }}</td> 
                            <td class='d-none'>{{ ($patient->birthdate) ? date_format(date_create($patient->birthdate), 'M d, Y') : '' }}</td> 
                            <td class='d-none'>{{ $patient->gender }}</td>
                            <td class='d-none'>{{ $patient->civil_status }}</td>
                            <td class='d-none'>{{ $patient->religion }}</td>
                            <td class='d-none'>{{ asset('storage/profile_picture/'.$patient->profile_pic) }}</td>
                            <td class='d-none'>{{ $patient->is_verified }}</td>
                            <td class='d-none'>{{ date_format(date_create($patient->created_at), 'M d, Y') }}</td>
                            <td class='d-none'>{{ ($patient->home_prov && $patient->home_mun && $patient->home_brgy) ? $patient->home_brgy.', '.$patient->home_mun.', '.$patient->home_prov : '' }}</td>
                            <td class='d-none'>{{ ($patient->birth_prov && $patient->birth_mun && $patient->birth_brgy) ? $patient->birth_brgy.', '.$patient->birth_mun.', '.$patient->birth_prov : '' }}</td>
                            <td class='d-none'>{{ ($patient->dorm_prov && $patient->dorm_mun && $patient->dorm_brgy) ? $patient->dorm_brgy.', '.$patient->dorm_mun.', '.$patient->dorm_prov : '' }}</td>
                            <td class='d-none'>{{ $patient->ec_fn." ".$patient->ec_mn." ".$patient->ec_ln." ".$patient->ec_sn}}</td> 
                            <td class='d-none'>{{ $patient->ec_rtp }}</td>
                            <td class='d-none'>{{ $patient->ec_landline }}</td>
                            <td class='d-none'>{{ $patient->ec_contact }}</td>
                            <td class='d-none'>{{ ($patient->ec_prov && $patient->ec_mun && $patient->ec_brgy) ? $patient->ec_brgy.', '.$patient->ec_mun.', '.$patient->ec_prov : '' }}</td>

                            <td>{{ ucwords($patient->classification) }}</td> 
                            <td>{{ ucwords($patient->position) }}</td> 
                            <td>{{ $patient->sr_code }}</td> 
                            <td>{{ ucwords($patient->first_name." ".$patient->middle_name." ".$patient->last_name." ".$patient->suffix_name) }}</td> 
                            <td>{{ $patient->contact }}</td> 
                            <td>
                                <a class="btn btn-primary btn-sm" id="view_details" data-bs-toggle="modal" data-bs-target="#modal">
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>
                            </td> 
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Personnel Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">                       
                
                    <div class="text-center">
                        <img id="img" class="img-fluid" src="" alt="" style="height: 150px;">
                    </div>

                    <div class="form-control border-0 d-flex justify-content-center">
                        <span class="row" id="verified" title="Update Verified Status"></span>
                    </div>

                    <input class="d-none" id="acc_id" type="text" value="">

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">SR Code: </label> <label id="sr_code"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Personnel Name: </label> <input id="name" class="border-0" type="text"></input>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Gender: </label> <label id="gender"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Classification: </label> <label id="classification"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Grade level: </label> <label id="grade"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Department: </label> <label id="dept"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Program: </label> <label id="prog"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Gsuite: </label> <label id="gsuite"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Email: </label> <label id="email"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Contact: </label> <label id="contact"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Home Address: </label> <label id="home_add"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Civil Status: </label> <label id="civil_status"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Religion: </label> <label id="religion"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Birthdate: </label> <label id="birthdate"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Birth Address: </label> <label id="birth_add"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Dorm Address: </label> <label id="dorm_add"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Emergency Contact: </label> <label id="ec_name"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Relation to patient: </label> <label id="ec_rtp"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Contact: </label> <label id="ec_contact"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Landline: </label> <label id="ec_landline"></label>
                    </div>

                    <div class="form-control border-0">
                        <label style="font-weight: 600;">Account Created: </label> <label id="account_created"></label>
                    </div>
                </div>
                    

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit_button">Add</button>
                </div>
            </div>    
        </div>
    </div>

@endsection
  
@push('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        @if(session('status'))  
            @php 
                $status = json_decode(session('status'));                      
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif


        $(document).ready(function(){
            $("#verified").tooltip();  
            
            var table = $('#datatable').DataTable();

            table.on('click', '#view_details', function(){

                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                console.log(data);

                $('#verified').html(data[9]=="1" ? "<button id='vstatus' value='1' class='border-0 badge bg-success'>Verified</button>" : "<button id='update_vstatus' value='2' class='border-0 badge bg-danger'>Not Verified</button>");
                $('#img').attr('src', data[8]);
                $('#acc_id').val(data[0]);
                $('#sr_code').html(data[23]);
                $('#name').val(data[24]);
                $('#gender').html(data[5]);
                $('#classification').html(data[22]);
                $('#grade').html(data[19]);
                $('#dept').html(data[20]);
                $('#prog').html(data[21]);
                $('#gsuite').html(data[1]);
                $('#email').html(data[2]);
                $('#contact').html(data[25]);
                $('#civil_status').html(data[6]);
                $('#religion').html(data[7]);
                $('#home_add').html(data[11]);
                $('#birth_add').html(data[12]);
                $('#birthdate').html(data[4])
                $('#dorm_add').html(data[13]);
                $('#ec_name').html(data[14]);
                $('#ec_rtp').html(data[15]);
                $('#ec_contact').html(data[17]);
                $('#ec_landline').html(data[16]);
                $('#ec_add').html(data[18]);
                $('#account_created').html(data[10]);
            });

            $('#verified').click(function(){
                swal({
                    title: "Are you sure?",
                    text: "This will update the account verification status of "+$('#name').val()+" to "+($('#vstatus').val() == 1 ? ' not verified' : ' verified'),
                    icon: "warning",
                    buttons: [
                        'No',
                        'Yes'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type: "GET",
                            url: window.location.href+'/patient/updateverfication/'+$('#acc_id').val()+'/'+$('#vstatus').val(),
                            success: function(response){
                                response = JSON.parse(response);
                                swal(response.title, response.message, response.icon);
                                if(response.icon == 'success'){
                                    $('#verified').html($('#vstatus').val()!="1" ? "<button id='vstatus' value='1' class='border-0 badge bg-success'>Verified</button>" : "<button id='update_vstatus' value='2' class='border-0 badge bg-danger'>Not Verified</button>");
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush
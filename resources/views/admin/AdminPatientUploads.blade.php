@extends('layout.admin-main')

@push('title')
    <title>Patient Documents</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Medical Documents</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item active">Uploads</li>
                    <li class="breadcrumb-item">Prescription</li>
                </ol>
            </nav>
        </div>
        
        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4">
                    <h5 class="card-title">Your uploads</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>    
                                <th scope="col">SRCode</th>
                                <th scope="col">Name</th>
                                <th scope="col">Document</th>
                                <th scope="col">Filename</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            @foreach($PatientUploads as $docs)
                                <tr>
                                    <td>{{ $docs->sr_code }}</td>
                                    <td>{{ $docs->first_name." ".$docs->middle_name[0]." ".$docs->last_name }}</td>
                                    <td>{{ $docs->document_type }}</td>
                                    <td>{{ $docs->filename }}</td>
                                    <td>{{ date_format(date_create($docs->date), 'M d, Y') }}</td>
                                    <td>
                                    @if($docs->verified==0)
                                        <button class="badge bg-danger border-0" value="{{ $docs->acc_id }}" id="vstatus" title="Update Verified Status">Not Verified</button>
                                    @else
                                        <button class="badge bg-success border-0" value="{{ $docs->acc_id }}" id="vstatus" title="Update Verified Status">Verified</button>
                                    @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('PatientViewDocument',['pd_id' => $docs->pd_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
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
                    <h5 class="modal-title" id="modal_title">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('PatientUploadDocuments', ['id'=>Session::get('user_id')]) }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body mb-4">
                        <div class="row">
                            <div>
                                <label for="" class="col-form-label col-lg-12">Document Type:</label>
                                <select class="form-select form-select" name="document_type" id="">
                                    <option value="">--- Choose document type ---</option>
                                    
                                </select>
                            </div>
                            <span class="text-danger" id="file_error">
                                @error('document_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="row">
                            <div>
                                <label for="" class="col-form-label col-lg-12 mt-4">Document:</label>
                                <input class="form-control" type="file" name="file" id="file">
                            </div>
                            <span class="text-danger" id="file_error">
                                @error('file')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Add</button>
                    </div>
                </form>
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
            
            @if($errors->any())
                $('#modal').modal('show');
            @endif

            $('#vstatus').tooltip();
            
        });

    </script>
@endpush
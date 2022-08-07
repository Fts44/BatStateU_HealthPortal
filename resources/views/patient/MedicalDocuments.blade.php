@extends('layout.patient-main')

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
                                <th scope="col">ID</th>      
                                <th scope="col">Document</th>
                                <th scope="col">Filename</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            @foreach($user_documents as $docs)
                                <tr>
                                    <td>{{ $docs->dt_id }}</td>
                                    <td>{{ $docs->document_type }}</td>
                                    <td>{{ $docs->filename }}</td>
                                    <td>{{ date_format(date_create($docs->date), 'M d, Y g:i a') }}</td>
                                    <td>{{ ($docs->verified==0) ? 'Not verified' : 'Verified' }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('PatientViewDocument',['pd_id' => $docs->pd_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                        <a class="btn btn-danger btn-sm" href="{{ route('PatientDeleteDocuments', ['id'=> $docs->pd_id]) }}"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>


                    </iframe>
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
                                    @foreach($document_type as $type)
                                        <option value="{{ $type->dt_id }}" {{ (old('document_type')==$type->dt_id) ? 'selected' : '' }}>{{ $type->document_type }}</option>
                                    @endforeach
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
            $('#file').change(function(){
                let MAX_FILE_SIZE = 5 * 1024 * 1024;
                let fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    $('#file_error').html("File must no be greater than 5mb!");
                    $(this).val('');
                } else {
                    $('#file_error').html("");
                }
            });
            @if($errors->any())
                $('#modal').modal('show');
            @endif
            
        });
    </script>
@endpush
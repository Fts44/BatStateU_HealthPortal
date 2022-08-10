@extends('layout.admin-main')

@push('title')
    <title>Medicine Inventory</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Medicine Inventory</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicine') }}">Summary</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicineProduct') }}">Product</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicineInfo') }}">MedInfo</a></li>
                    <li class="breadcrumb-item active">Types</li>
                    <li class="breadcrumb-item "><a href="{{ route('AdminInventoryMedicineCategory') }}">Category</a></li>
                </ol>
            </nav>
        </div>
        
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{session('failed')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4">
                    <h5 class="card-title">Medicine Types</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>      
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @foreach($medicine_types as $types)
                            <tr>
                                <td>{{ $types->mt_id }}</td>
                                <td>{{ $types->mt_name }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="#" id="Update">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <a class="btn btn-danger btn-sm" href="{{ route('AdminInventoryDeleteMedicineTypes', ['mt_id' => $types->mt_id ]) }}">
                                        <i class="bi bi-eraser"></i>
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
                    <h5 class="modal-title" id="modal_title">Medicine Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="form" action="{{ route('AdminInventoryMedicineTypes') }}" method="POST">
                    <div class="modal-body">       
                        @csrf
                        <div class="form-control border-0">
                            <label for="mt_name" class="col-lg-12">Name:</label>
                            <input class="form-control mt-2" type="text" id="mt_name" name="mt_name" placeholder="Medicine type" value="{{ old('mt_name') }}">
                            <span class="text-danger">
                                @error('mt_name')
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
        $(document).ready(function(){
            @if($errors->any())
                $('#modal').modal('show');
            @endif

            $('.alert').delay(5000).fadeOut('slow');

            var table = $('#datatable').DataTable();
            table.on('click', '#Update', function(){
                
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#mt_name').val(data[1]);
                $('#form').attr('action', "{{ url('admin/inventory/medicine/types/update/') }}"+"/"+data[0]);
                $('#modal_title').html('Update Medicine type');
                $('#submit_button').html('Update');
                $('#modal').modal('show');
            });
        });
    </script>
@endpush
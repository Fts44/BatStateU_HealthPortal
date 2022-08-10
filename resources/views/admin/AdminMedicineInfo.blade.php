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
                    <li class="breadcrumb-item active">MedInfo</li>
                    <li class="breadcrumb-item "><a href="{{ route('AdminInventoryMedicineTypes') }}">Types</a></li>
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
                    <h5 class="card-title">Medicine Info</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>    
                                <th scope="col">Prescription</th>
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @foreach($medicine_infos as $mi)
                        <tr>
                            <td>{{ $mi->mi_id }}</td>
                            <td>{{ $mi->mi_name }}</td>
                            <td>
                                @if($mi->mi_prescription_req==1)
                                    <span class="badge bg-warning text-dark">Required</span>
                                @else
                                    <span class="badge bg-success">Not required</span>
                                @endif
                            </td>
                            <td>{{ $mi->mc_name }}</td>
                            <td>{{ $mi->mt_name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" id="Update" href="#"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-danger btn-sm" href="{{ route('AdminInventoryDeleteMedicineInfo', ['mi_id'=> $mi->mi_id] ) }}"><i class="bi bi-eraser"></i></a>
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
                    <h5 class="modal-title" id="modal_title">New Medicine Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="form" action="{{ route('AdminInventoryMedicineInfo') }}" method="POST">
                    <div class="modal-body"> 
                        @csrf
                        <div class="form-control border-0">
                            <label for="" class="col-lg-12">Medicine Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control border-0">
                            <label for="" class="col-lg-12">Category:</label>
                            <select class="form-select mt-1" name="category" id="category">
                                <option value="">--- Choose category ---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->mc_id }}" {{ $category->mc_id==old('category') ? 'selected' : '' }}>{{ $category->mc_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> 

                        <div class="form-control border-0">
                            <label for="" class="col-lg-12">Type:</label>
                            <select class="form-select mt-1" name="type" id="type">
                                <option value="">--- Choose type ---</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->mt_id }}" {{ $type->mt_id==old('type') ? 'selected' : '' }}>{{ $type->mt_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control border-0">
                            <label for="" class="col-lg-12">Prescription required?:</label>
                            <select class="form-select mt-1" name="rx" id="rx">
                                <option value="0">Not Required</option>
                                <option value="1">Required</option>
                            </select>
                            <span class="text-danger">
                                @error('rx')
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
            $('.alert').delay(5000).fadeOut('slow');

            @if($errors->any())
                $('#modal').modal('show');
            @endif

            var table = $('#datatable').DataTable();
            table.on('click', '#Update', function(){
                
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#name').val(data[1]);

                $('#category option').map(function () {
                    if ($(this).text() == data[3]) return this;
                }).attr('selected', 'selected');

                $('#type option').map(function () {
                    if ($(this).text() == data[4]) return this;
                }).attr('selected', 'selected');

                (data[2].includes('Not')) ? $('#rx').val('0') : $('#rx').val('1');

                $('#form').attr('action', "{{ url('admin/inventory/medicine/info/update/') }}"+"/"+data[0]);
                $('#modal_title').html('Update Medicine info');
                $('#submit_button').html('Update');
                $('#modal').modal('show');
            });
        });
    </script>
@endpush
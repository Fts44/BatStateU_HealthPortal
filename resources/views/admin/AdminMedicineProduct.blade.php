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
                    <li class="breadcrumb-item active">Product</li>
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicineInfo') }}">MedInfo</a></li>
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
                    <h5 class="card-title">Medicine List</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="d-none">mi_id</th>
                                <th scope="col" class="d-none">mi_expiry</th>
                                <th scope="col">Product Info</th>     
                                <th scope="col">Stock used</th>
                                <th scope="col">Available</th>
                                <th scope="col">Expired</th>
                                <th scope="col">Date Create</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @foreach($inventory_medicines as $med)
                            <tr>
                                <td>{{ $med->im_id }}</td>
                                <td class="d-none">{{ $med->mi_id }}</td>
                                <td class="d-none">{{ $med->expiry }}</td>
                                <td> 
                                    Name:        {{ $med->mi_name }}<br>
                                    Category:    {{ $med->mc_name }}<br>
                                    Type:        {{ $med->mt_name }}<br>
                                    Prescription: 
                                    @if($med->mi_prescription_req==1)
                                        <span class="badge bg-warning text-dark">Required</span>
                                    @else
                                        <span class="badge bg-success">Not required</span>
                                    @endif
                                </td>
                                <td>{{ $med->stockout."/".$med->stockin }}</td>
                                <td>{{ $med->stockin-$med->stockout }}</td>
                                <td>{{ date_format(date_create($med->expiry), 'M d, Y') }}</td>
                                <td>{{ date_format(date_create($med->created_at), 'M d, Y') }}</td>
                                <td>
                                    <a class="btn btn-secondary btn-sm" id="Transac"><i class="bi bi-plus-slash-minus"></i></a>
                                    <a class="btn btn-primary btn-sm" id="Update"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('AdminInventoryDeleteMedicineProduct',['im_id'=>$med->im_id]) }}"><i class="bi bi-eraser"></i></a>
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
                    <h5 class="modal-title" id="modal_title">New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="form" action="{{ route('AdminInventoryMedicineProduct') }}" method="POST">
                    <div class="modal-body">       
                        @csrf    
                        <div class="form-control border-0">
                            <label for="" class="col-lg-12">Product Details</label>
                            <select name="product" id="product" class="form-select mt-1">
                            <option value="">--- Choose medicine ---</option>
                            @foreach($medicine_infos as $info)
                                <option value="{{ $info->mi_id }}" {{ ($info->mi_id==old('product')) ? 'selected' : '' }}>{{ $info->mi_name." (".$info->mc_name.")" }}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                @error('product')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> 
                        
                        <div class="form-control border-0">
                            <label for="expiry" class="col-lg-12">Expiry:</label>
                            <input type="date" id="expiry" name="expiry" class="form-control" value="{{ old('expiry') }}">
                            <span class="text-danger">
                                @error('expiry')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control border-0">
                            <label for="quantity" class="col-lg-12">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}">
                            <span class="text-danger">
                                @error('quantity')
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
                $('#product').val(data[1]);
                $('#expiry').val(data[2]);
                $('#quantity').val(data[5]);
                $('#form').attr('action', "{{ url('admin/inventory/medicine/product/update/') }}"+"/"+data[0]);
                $('#modal_title').html('Update Medicine type');
                $('#submit_button').html('Update');
                $('#modal').modal('show');
            });

            table.on('click', '#Transac', function(){
                
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                // $('#product').val(data[1]);
                // $('#expiry').val(data[2]);
                // $('#quantity').val(data[5]);
                // $('#form').attr('action', "{{ url('admin/inventory/medicine/product/update/') }}"+"/"+data[0]);
                // $('#modal_title').html('Update Medicine type');
                // $('#submit_button').html('Update');
                // $('#modal').modal('show');
            });
        });
    </script>
@endpush
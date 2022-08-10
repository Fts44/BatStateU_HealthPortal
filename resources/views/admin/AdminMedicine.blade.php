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
                    <li class="breadcrumb-item active">Summary</li>
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicineProduct') }}">Product</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('AdminInventoryMedicineInfo') }}">MedInfo</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('AdminInventoryMedicineTypes') }}">Types</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('AdminInventoryMedicineCategory') }}">Category</a></li>
                </ol>
            </nav>
        </div>
        
        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4">
                    <h5 class="card-title">Medicine</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;"  data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">Product Name</th>      
                                <th scope="col">Stock In</th>
                                <th scope="col">Stock Out</th>
                                <th scope="col">Available </th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @php $i = 0 @endphp 
                        @foreach($summary_medicine as $medicine)
                        <tr>
                            <td>{{ $medicine->mi_name }}</td>
                            <td>{{ $medicine->TotalStockin }}</td>
                            <td>{{ $medicine->TotalStockout }}</td>
                            <td>{{ $medicine->TotalStockin-$medicine->TotalStockout }}</td>
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
                    <h5 class="modal-title" id="modal_title">Patient Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">                       
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
        

    </script>
@endpush
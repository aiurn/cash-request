@extends('layouts.app')

@push('styles')
@endpush

@section('container')

{{-- CASH REQUEST --}}
<form action="{{ route('cash-request.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @include('components.alert-message')
        <div class="card">
            <div class="card-header">
                <h4 class="fw-bold">
                    <i class="fas fa-calendar-alt"></i> Create Cash Request
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" required>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Project</label>
                            <select name="project_id" required class="form-select @error('project') @enderror">
                                <option selected disabled>-- Select Project --</option>
                                @foreach ($project as $item)
                                    <option value="{{ $item->id }}" {{ old('project') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('project')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>       
                    </div>
                        {{-- @can('role-approve') --}}
                        {{-- <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Request by</label>
                                <input type="text" class="form-control" name="request_by" value="{{ App\Models\User::find($cash_request->request_by)->name }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Department</label>
                                <input type="text" class="form-control" name="request_by" value="{{ App\Models\User::find($cash_request->request_by)->roles()->pluck('name')->implode(', ') }}" disabled>
                            </div> --}}
                        {{-- </div> --}}
                        {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>

    {{-- CASH REQUEST DETAIL --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="me-auto p-2 bd-highlight">
                            <h4 class="fw-bold">
                                Details
                            </h4>
                        </div>
                        <div class="p-2 bd-highlight">
                            <div class="btn btn-primary" id="add-row" onclick="">+ New Detail</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="cash-request-detail-table" class="table table-striped table-borderless table-hovered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" class="form-control description" name="description[]" required></td>
                                    <td><input type="text" class="form-control unit" name="unit[]" required></td>
                                    <td><input type="number" class="form-control qty" name="qty[]" required></td>
                                    <td><input type="number" class="form-control amount" name="amount[]" required></td>
                                    <td><input type="number" class="form-control total" name="total[]" readonly></td>
                                    <td><button class="btn btn-danger mx-1 btn-remove-row" onclick="deleteRow()" id="delete"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('cash-request.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success" id="save-data">Save Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        var jumlahBaris = $('#cash-request-detail-table tbody tr').length;
        $('#cash-request-detail-table').val(jumlahBaris + 1);
        // var row = 1;
        $('#add-row').click(function(){
            jumlahBaris++;
            $('#cash-request-detail-table tbody').append('<tr>'+
                '<td>'+jumlahBaris+'</td>'+
                '<td><input type="text" class="form-control description" name="description[]" required></td>'+
                '<td><input type="text" class="form-control unit" name="unit[]" required></td>'+
                '<td><input type="number" class="form-control qty" name="qty[]" required></td>'+
                '<td><input type="number" class="form-control amount" name="amount[]" required></td>'+
                '<td><input type="number" class="form-control total" name="total[]" readonly></td>'+
                '<td><button class="btn btn-remove-row btn-danger mx-1" onclick="deleteRow()" id="delete"><i class="fas fa-trash"></i></button></td>'+
                '</tr>');
                $('#cash-request-detail-table').val(jumlahBaris + 1);
        });

        $(document).on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
        });

        $('body').on('input', '.qty, .amount', function(){
            // ambil nilai qty dan amount
            var qty = $(this).closest('tr').find('.qty').val();
            var amount = $(this).closest('tr').find('.amount').val();
            
            // hitung total
            var total = qty * amount;
            
            var harga = total.toLocaleString('id-ID');
            $(this).closest('tr').find('.total').val(harga);
        });

    }); 
</script>
@endpush




@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <div class="card-header">
                <h4 class="fw-bold">
                   <i class="fas fa-calendar-alt"></i> Cash Request
                </h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                   <label for="" class="form-label">Date</label>
                   <input type="date" class="form-control" name="date" value="{{ $cash_request->date }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Project</label>
                    <select name="project_id" id="" class="form-select @error('project') @enderror" disabled>
                        <option value="" selected disabled>-- Select Project --</option>
                            @foreach ($project as $item)
                            <option value="{{ $item->id }}" {{ ($cash_request->project_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                    </select>
                    @error('project')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>    
            </div> 
        </div>      
    </div>
</div>

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
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="cash-request-detail-table" class="table table-striped table-borderless table-hovered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cash_request_detail as $item)
                            <tr>
                                <td><input type="text" class="form-control description" name="description[]" value="{{ $item->description }}" disabled></td>
                                <td><input type="text" class="form-control unit" name="unit[]" value="{{ $item->unit }}" disabled></td>
                                <td><input type="number" class="form-control qty" name="qty[]" value="{{ $item->qty }}" disabled></td>
                                <td><input type="number" class="form-control amount" name="amount[]" value="{{ $item->amount }}" disabled></td>
                                <td><input type="number" class="form-control total" name="total[]" value="{{ $item->total }}" disabled></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('cash-request.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
@endpush
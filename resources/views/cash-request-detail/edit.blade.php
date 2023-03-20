@extends('layouts.app')

@push('styles')
@endpush

@section('container')

{{-- CASH REQUEST DETAIL --}}
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <form action="{{ route('cash-request-detail.update.'$cr_detail->id) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Cash Request</label>
                        <select name="cash_request_id" class="form-select @error('cash_request') @enderror">
                            <option selected disabled>-- Select Cash Request --</option>
                            @foreach ($cash_request as $item)
                                <option value="{{ $item->id }}" {{ ($cr_detail->cash_request_id == $item->id) ? 'selected' : '' }}>{{ $item->id }}</option>
                            @endforeach
                        </select>
                        @error('cash_request')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"placeholder="Input Description" value="{{ $cr_detail->description }}">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Qty</label>
                        <input type="number" name="qty" id="" class="form-control @error('qty') is-invalid @enderror"placeholder="Input Qty" value="{{ $cr_detail->qty }}">
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Unit</label>
                        <input type="text" name="unit" id="" class="form-control @error('unit') is-invalid @enderror"placeholder="Input Unit" value="{{ $cr_detail->unit }}">
                        @error('unit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control @error('amount') is-invalid @enderror"placeholder="Input Amount" value="{{ $cr_detail->amount }}">
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('cash-request.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                    <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush




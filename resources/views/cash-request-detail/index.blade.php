@extends('layouts.app')

@push('styles')
@endpush

@section('container')

{{-- CASH REQUEST DETAIL --}}
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <form action="{{ route('cash-request-detail.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Cash Request</label>
                        <select name="cash_request_id" id="">
                            @foreach ($cash_request as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"placeholder="Input Description" value="{{ old('username') }}">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Qty</label>
                        <input type="number" name="qty" id="" class="form-control @error('qty') is-invalid @enderror"placeholder="Input Qty" value="{{ old('username') }}">
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Unit</label>
                        <input type="text" name="unit" id="" class="form-control @error('unit') is-invalid @enderror"placeholder="Input Unit" value="{{ old('username') }}">
                        @error('unit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control @error('amount') is-invalid @enderror"placeholder="Input Amount" value="{{ old('username') }}">
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

<div class="row">
    <div class="col-12">
        @include('components.alert-message')
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="me-auto p-2 bd-highlight">
                        <h4 class="fw-bold">
                            <i class="fas fa-users"></i> Page Title
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="department" class="table table-striped table-borderless table-hovered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash_request_detail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>
                                        <a href="{{ route('cash-request.edit', $item->id) }}" class="btn btn-warning" title="Edit Cash Request"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger mx-1" onclick="modalDelete('Cash Request Detail', 'Cash Request Detail {{ $item->name }}', '{{ route('cash-request.destroy', $item->id) }}', '{{ route('cash-request.index') }}')" title="Delete Cash Request"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush




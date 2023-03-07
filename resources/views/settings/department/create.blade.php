@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-md-4 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card bg-head-up text-white style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 20px;">
                    <h5 class="card-title fw-bold"><a href="{{ route('settings') }}" class="text-white"><img src="{{ asset('assets/images/icon/setting.png') }}" width="40" alt="" title="Go Back to Settings"></a> <span>/</span> <a href="{{ route('settings.department.index') }}" class="text-white"><img src="{{ asset('assets/images/icon/departement.png') }}" width="40" alt="" title="Go Back to Deparment Management"></a> <span>/</span> Create</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <form action="{{ route('settings.department.store') }}" method="post">
                @csrf
                <div class="card-header">
                    <h4 class="fw-bold">
                        <i class="fas fa-building"></i> Create Department
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Department Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Department Name" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Permission:</label>
                        <input type="checkbox" id="checkbox">
                        <select class="select2-department form-control @error('permission') is-invalid @enderror" name="permission[]" data-placeholder="Choose one (with optgroup)" multiple="multiple">
                            @foreach ($permissions as $item)
                                <option value="{{ $item->id }}" {{ old('permission') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('settings.department.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                    <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
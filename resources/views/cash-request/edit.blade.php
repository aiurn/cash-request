@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <form action="{{ route('cash-request.update', $cash_request->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="card-header">
                    <h4 class="fw-bold">
                        <i class="fas fa-building"></i> Update Cash Request
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $cash_request->date }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Project</label>
                        <select name="project_id" id="" class="form-select @error('project') @enderror">
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
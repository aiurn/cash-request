@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-md-4 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card bg-head-up text-white style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 20px;">
                    <h5 class="card-title fw-bold"><a href="{{ route('settings') }}" class="text-white"><img src="{{ asset('assets/images/icon/setting.png') }}" width="40" alt="" title="Go Back to Settings"></a> <span>/</span> <a href="{{ route('settings.user.index') }}" class="text-white"><img src="{{ asset('assets/images/icon/users-2.png') }}" width="40" alt="" title="Go Back to User Management"></a> <span>/</span> Create</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        @include('components.alert-message')
        <div class="card">
            <form action="{{ route('settings.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4 class="fw-bold">
                        <i class="fas fa-users"></i> {{ $page_title }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Full Name</label>
                        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" placeholder="Input Full Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" name="username" id="" class="form-control @error('username') is-invalid @enderror"placeholder="Input Username" value="{{ old('username') }}">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email Address" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Input Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm-password" id="" class="form-control @error('confirm-password') is-invalid @enderror" placeholder="Input Password One More Time">
                        @error('confirm-password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Department</label>
                        <select name="role" id="" class="form-select @error('role') @enderror">
                            <option value="" selected disabled>-- Select Department --</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->name }}" {{ old('role') == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Avatar</label>
                        <input type="file" name="avatar" id="" class="form-control @error('avatar') is-invalid @enderror" placeholder="Input Avatar">
                        @error('avatar')
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
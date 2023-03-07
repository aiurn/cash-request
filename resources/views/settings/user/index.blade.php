@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-md-4 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card bg-head-up text-white style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 20px;">
                    <h5 class="card-title fw-bold"><a href="{{ route('settings') }}" class="text-white"><img src="{{ asset('assets/images/icon/setting.png') }}" width="40" alt="" title="Go Back to Settings"></a> <span>/</span> {{ $page_title }}</h5>
                </div>
            </div>
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
                            <i class="fas fa-users"></i> {{ $page_title }}
                        </h4>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{ route('settings.user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="department" class="table table-striped table-borderless table-hovered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('assets/images/profile/'.$item->avatar) }}" width="50" alt=""></td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->roles[0]->name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('settings.user.edit', $item->id) }}" class="btn btn-warning" title="Edit User"><i class="fas fa-edit"></i></a>
                                        @if ($item->username != 'admin')
                                            <button class="btn btn-danger mx-1" onclick="modalDelete('User', 'User {{ $item->name }}', '{{ route('settings.user.destroy', $item->id) }}', '{{ route('settings.user.index') }}')" title="Delete User"><i class="fas fa-trash"></i></button>
                                        @endif
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
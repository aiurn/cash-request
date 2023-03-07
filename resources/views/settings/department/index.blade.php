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
                            <i class="fas fa-building"></i> {{ $page_title }}
                        </h4>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{ route('settings.department.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="department" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Department Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('settings.department.edit', $item->id) }}" class="btn btn-warning" title="Edit Department"><i class="fas fa-edit"></i></a>
                                        @if ($item->name != 'ROOT')
                                            <button class="btn btn-danger mx-1" onclick="modalDelete('Role', 'Role {{ $item->name }}', '{{ route('settings.department.destroy', $item->id) }}', '{{ route('settings.department.index') }}')" title="Delete Department"><i class="fas fa-trash"></i></button>
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
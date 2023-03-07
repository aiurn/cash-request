@extends('layouts.app')

@push('styles')
@endpush

@section('container')
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
                    <div class="p-2 bd-highlight">
                        <a href="{{ route('cash-request.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="department" class="table table-striped table-borderless table-hovered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Project</th>
                                {{-- <th>Request By</th>
                                <th>Approved By</th>
                                <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash_request as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->project->name }}</td>
                                    {{-- <td>{{ $item->user ? $item->user->name : '-' }}</td>
                                    <td>{{ $item->user ? $item->user->name : '-' }}</td> --}}
                                    {{-- <td>{{ $item->status }}</td> --}}
                                    <td>
                                        <a href="{{ route('cash-request.edit', $item->id) }}" class="btn btn-warning" title="Edit Cash Request"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger mx-1" onclick="modalDelete('Cash Request', 'Cash Request {{ $item->name }}', '{{ route('cash-request.destroy', $item->id) }}', '{{ route('cash-request.index') }}')" title="Delete Cash Request"><i class="fas fa-trash"></i></button>
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
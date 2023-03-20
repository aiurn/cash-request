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
                            <i class="fas fa-calendar-alt"></i> Cash Request
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
                                <th class="text-center">No</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Project</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash_request as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->date }}</td>
                                    <td class="text-center">{{ optional($item->project)->name }}</td>
                                    <td class="text-center"><span class="badge bg-warning text-dark">{{ $item->status }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('cash-request.show', $item->id) }}" class="btn btn-success" title="Show Cash Request"><i class="fas fa-eye"></i></a>
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
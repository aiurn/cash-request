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
                            <i class="fas fa-users"></i> Chart Of Accounts
                        </h4>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{ route('chart-of-accounts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="department" class="table table-striped table-borderless table-hovered" style="width:100%">
                        <thead>
                            <tr style="background-color: orange;">
                                <th>No</th>
                                <th>Account Group</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Normal Balance</th>
                                <th>Status Account</th>
                                <th>Account Parent</th>
                                <th>Beginning Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chart_of_accounts as $item)
                                <tr style="{{ $item->status_account == 'Group' ? 'background-color: lightgreen; color: black;' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->account_group }}</td>
                                    <td>{{ $item->account_number }}</td>
                                    <td>{{ $item->account_name }}</td>
                                    <td>{{ $item->normal_balance }}</td>
                                    <td>{{ $item->status_account }}</td>
                                    <td>{{ $item->parent_id }}</td>
                                    <td>{{ $item->beginning_balance }}</td>
                                    <td>
                                        <a href="{{ route('chart-of-accounts.edit', $item->id) }}" class="btn btn-warning" title="Edit Chart Of Accounts"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger mx-1" onclick="modalDelete('Chart Of Accounts', 'Chart Of Accounts {{ $item->name }}', '{{ route('chart-of-accounts.destroy', $item->id) }}', '{{ route('chart-of-accounts.index') }}')" title="Delete Chart Of Accounts"><i class="fas fa-trash"></i></button>
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
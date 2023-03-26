@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<form action="{{ route('cash-request.reject', $cash_request->id) }}" method="post" enctype="multipart/form-data" id="cash-request">
    @csrf
    <div class="row">
        @include('components.alert-message')
        <div class="card">
            <div class="card-header">
                <h4 class="fw-bold">
                    <i class="fas fa-calendar-alt"></i> Cash Request
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="{{ $cash_request->date }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Project</label>
                            <select name="project_id" id="" class="form-select @error('project') @enderror" disabled>
                                <option value="" selected disabled>-- Select Project --</option>
                                    @foreach ($project as $item)
                                        <option value="{{ $item->id }}" {{ ($cash_request->project_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                            </select>
                            @error('project')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>   
                        @if ($cash_request->status == 'Rejected')
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Reason Rejected</label>
                                <input type="text" class="form-control" name="reasons" value="{{ $cash_request->reasons }}" disabled>
                            </div>
                        @endif 
                    </div>
                    @can('cash-request-approve')
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Request by</label>
                                <input type="text" class="form-control" name="request_by" value="{{ App\Models\User::find($cash_request->request_by)->name }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Department</label>
                                <input type="text" class="form-control" name="request_by" value="{{ App\Models\User::find($cash_request->request_by)->roles()->pluck('name')->implode(', ') }}" disabled>
                            </div>
                        </div>
                    @endcan

                    @if ($cash_request->status != 'Pending')
                        @can('cash-request-show')
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Approved by</label>
                                    <input type="text" class="form-control" name="approved_by" value="{{ App\Models\User::find($cash_request->approved_by)->name }}" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Department</label>
                                    <input type="text" class="form-control" name="approved_by" value="{{ App\Models\User::find($cash_request->approved_by)->roles()->pluck('name')->implode(', ') }}" disabled>
                                </div>
                            </div>
                        @endcan
                    @endif
                </div>
            </div> 
        </div>      
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="me-auto p-2 bd-highlight">
                            <h4 class="fw-bold">
                                Details
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="cash-request-detail-table" class="table table-striped table-borderless table-hovered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cash_request_detail as $item)
                                <tr>
                                    <td><input type="text" class="form-control description" name="description[]" value="{{ $item->description }}" disabled></td>
                                    <td><input type="text" class="form-control unit" name="unit[]" value="{{ $item->unit }}" disabled></td>
                                    <td><input type="number" class="form-control qty" name="qty[]" value="{{ $item->qty }}" disabled></td>
                                    <td><input type="number" class="form-control amount" name="amount[]" value="{{ $item->amount }}" disabled></td>
                                    <td><input type="number" class="form-control total" name="total[]" value="{{ $item->total }}" disabled></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('cash-request.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                        @can('cash-request-approve')
                            @if ($cash_request->status == 'Pending')
                                <button type="button" class="btn btn-success" id="save-data" onclick="approve('Cash Request', 'Cash Request {{ $item->name }}', '{{ route('cash-request.approve', $cash_request->id) }}', '{{ route('cash-request.index') }}')"><i class="fas fa-check"></i> Approve</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"><i class="fas fa-times"></i> Reject</button>
                                <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reject Cash Request</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="text-area" class="form-label">Give your reasons</label>
                                                <textarea class="form-control" id="reasons" rows="3" name="reasons" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger" id="rejectBtn">Reject</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Reject Cash Request
    $('#rejectBtn').click(function() {
        var reasons = $('#reasons').val();
        if (reasons == "") {
            Swal.fire({
                        icon: 'warning',
                        title: 'Fill the reason field!',
                        showConfirmButton: false,
                        timer: 1500
                    });
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: '{{ route("cash-request.reject", $cash_request->id) }}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    reasons: reasons,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cash Request Rejected',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.href = '{{ route("cash-request.index") }}'
                },
                error: function (data) {
                    $.alert('Failed!')
                }
            });
        }
    });
</script>
@endpush
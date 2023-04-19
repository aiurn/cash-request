@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="container">
    @include('components.alert-message')
    <div class="row justify-content-center">
        <div class="col-8; mt-5">
            <div class="card">
                <div class="card-body" style="background-color:white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-3">Journal Entry Detail</h5>
                        <div class="col">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary radius-30" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;"><i class="fas fa-plus"></i> Add New</button>
                            <!-- Modal Tambah Journal-->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Journal Entry</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-journal" action="{{ route('journal.simpan') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_journal" value="{{ $journal_id }}">
                                                    <label for="chart_of_account_id" class="form-label">Chart Of Account</label>
                                                    <select class="form-select" name="chart_of_account_id" id="chart_of_account_id">
                                                        <option selected>Select Chart Of Account</option>
                                                        @foreach($chart_of_accounts as $coa)
                                                            <option value="{{ $coa->id }}">{{ $coa->account_number }} - {{ $coa->account_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="account_position" class="form-label">Position</label>
                                                    <select class="form-select" name="account_position" id="account_position">
                                                        <option selected>Select Position</option>
                                                        <option value="Debit">Debit</option>
                                                        <option value="Kredit">Kredit</option>
                                                    </select>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input type="number" name="amount" class="form-control" id="amount">
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="budget_period" class="form-label">Budget Date</label>
                                                    <input type="date" name="budget_period" class="form-control" id="tanggal">
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="note_item" class="form-label">Note</label>
                                                    <textarea type="text" name="note_item" id="note_item" class="form-control" placeholder="Notes" style="height: 100px"></textarea>
                                                </div>
                            
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>              
                    <hr>
                    <div class="table-responsive">
                        <table id="department" class="table table-striped table-borderless table-hovered" style="width:100%">
                            <thead>
                                <tr style="background-color: orange; color: black;">
                                    <th>Id</th>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Budget Period</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach($journal_details as $item)
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->chart_of_accounts->account_number ?? 'N/A' }}</td>
                                    <td>{{ $item->chart_of_accounts->account_name ?? 'N/A' }}</td>
                                    <td>{{ ($item->account_position == 'Debit') ? $item->amount : 0}}</td>
                                    <td>{{ ($item->account_position == 'Kredit') ? $item->amount : 0}}</td>
                                    <td>{{ $item->budget_period ?? 'N/A' }}</td>
                                    <td>{{ $item->note_item }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-edit" 
                                                data-id="{{ $item->id }}"
                                                data-chart_of_account_id="{{ $item->chart_of_account_id }}" 
                                                data-account_position="{{ $item->account_position }}"  
                                                data-amount="{{ $item->amount }}" 
                                                data-budget_period="{{ $item->budget_period }}"  
                                                data-note_item="{{ $item->note_item }}" 
                                                data-bs-toggle="modal" data-bs-target="#editmodal"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger mx-1" onclick="modalDelete('Journal Detail', 'Journal Detail {{ $item->name }}', '{{ route('journal.destroy', $item->id) }}', '{{ route('journal.index') }}')" title="Delete Journal"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    

            <div>
                <form action="{{ route('journal.updatejournal', $journal) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="card-body" style="background-color:white;">
                        <div class="form-group row d-flex flex-column align-items-start">
                            <div class="form-group row align-items-center">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="total_debit" class="col-form-label"><b>Total Debit:</b></label>
                                        <input type="text" class="form-control" id="total_debit" style="width: 100%; height: 35px;" disabled>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="total_kredit" class="col-form-label"><b>Total Kredit:</b></label>
                                        <input type="text" class="form-control" id="total_kredit" style="width: 100%; height: 35px;" disabled>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="transaction_date" class="col-form-label"><b>Transaction Date:</b></label>
                                        <input type="date" name="transaction_date" class="form-control" id="transaction_date" style="width: 100%; height: 35px;" value="{{ date('Y-m-d', strtotime($journal->transaction_date)) }}">
                                    </div>                                    
                                      
                                    <div class="col-mt-3">
                                        <label for="description" class="col-form-label"><b>Description</b></label>
                                        <textarea type="text" name="description" class="form-control" id="description" style="width: 100%; height: 100px;" placeholder="Descriptions">{{ $journal->description }}</textarea>                                                
                                    </div> 

                                    <div class="mt-5">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-success me-2" style="margin-left: 10px">Save Data</button>
                                            <a href= "{{ route('journal.index') }}" type="submit" class="btn btn-primary">Kembali</a>
                                        </div>
                                    </div>
                                </div>    
                            </div>                  
                        </div>
                    </div>
                </form>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalEditLabel">Edit Journal</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-journal" action="{{ route('journal.updatemodal', $journal) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="chart_of_account_id" class="form-label">Chart Of Account</label>
                                <select class="form-select" name="chart_of_account_id" id="chart_of_account_id">
                                    <option selected>Select Chart Of Account</option>
                                    @foreach($chart_of_accounts as $coa)
                                    <option value="{{ $coa->id }}">{{ $coa->account_number }} - {{ $coa->account_name }}</option>
                                    @endforeach
                                </select>
                            </div>
              
                            <div class="mb-3">
                                <label for="account_position" class="form-label">Position</label>
                                <select class="form-select" name="account_position" id="account_position">
                                    <option selected>Select Position</option>
                                    <option value="Debit">Debit</option>
                                    <option value="Kredit">Kredit</option>
                                </select>
                            </div>
              
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount">
                            </div>
                
                            <div class="mb-3">
                                <label for="budget_period" class="form-label">Budget Date</label>
                                <input type="date" name="budget_period" class="form-control" id="budget_period">
                            </div>
                
                            <div class="mb-3">
                                <label for="note_item" class="form-label">Note</label>
                                <textarea type="text" name="note_item" id="note_item" class="form-control" placeholder="Notes" style="height: 100px"></textarea>
                            </div>
    
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div> 
                        </form>
                    </div>
                  </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection 

@push('scripts')
<script>
    function addJournalEntry(event) {
    event.preventDefault();
    $.ajax({
        url: $('#form-journal').attr('action'),
        method: 'POST',
        data: $('#form-journal').serialize(),
        success: function (response) {
            $('#exampleModal').modal('hide');
            $('#form-journal')[0].reset();
            $('.alert').removeClass('d-none').addClass('show');
        },
        error: function (xhr) {
            let errorText = "";
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorText += value + "<br>";
            });
            $('.modal-body').prepend('<div class="alert alert-danger">' + errorText + '</div>');
        }
    });
}

$(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    var chart_of_account_id = $(this).data('chart_of_account_id');
    var account_position = $(this).data('account_position');
    var amount = $(this).data('amount');
    var budget_period = $(this).data('budget_period');
    var note_item = $(this).data('note_item');
    
    $('#editmodal').find('#id').val(id);
    $('#editmodal').find('#chart_of_account_id').val(chart_of_account_id);
    $('#editmodal').find('#account_position').val(account_position);
    $('#editmodal').find('#amount').val(amount);
    $('#editmodal').find('#budget_period').val(budget_period);
    $('#editmodal').find('#note_item').val(note_item);
});
</script>
@endpush
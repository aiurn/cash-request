@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-8; mt-5">
      <div class="card" style="background-color: lightcyan;">
        <div class="card-body">
          <form id="filter" action="{{ route('journal.index') }}" method="GET">
            @csrf
            @if (session()->has('message'))
                <div class="alert alert-primary" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="form-group row d-flex flex-column align-items-start">
              <div class="form-group row align-items-center">
                <div id="filter-date" class="col-md-2">
                  <label for="start_date" class="col-form-label" style="color:#39B5E0;"><b>Start Date:</b></label>
                  <input type="date" id="start_date" name="start_date" class="form-control" style="width: 100%; height: 35px;" value="{{ $request->input('start_date') }}">
                </div>
                                            
                <div id="filter-date" class="col-md-2">
                    <label for="end_date" class="col-form-label" style="color:#39B5E0;"><b>End Date:</b></label>
                    <input type="date" id="end_date" name="end_date" class="form-control" style="width: 100%; height: 35px;" value="{{ $request->input('end_date') }}">
                </div>            
                                
                <div class="col-md-2">
                    <label for="chart_of_account_id" class="col-form-label" style="color:#39B5E0;"><b>Chart Of Account:</b></label>
                    <select class="form-select" i d="chart_of_account_id" name="chart_of_account_id" aria-label="Default select example" style="width: 100%; height: 35px;">
                        <option selected>Select Chart Of Account</option>
                        @foreach ($chart_of_accounts as $item)
                        <option value="{{ $item->id }}" {{ (old('chart_of_account_id') == $item->id || $request->chart_of_account_id == $item->id) ? 'selected' : '' }}>{{ $item->account_number }} - {{ $item->account_name }}</option>
                        @endforeach
                    </select>
                </div>
                                
                <div class="col-md-2">
                  <label for="account_position" class="col-form-label" style="color:#39B5E0;"><b>Position:</b></label>
                  <select class="form-select" id="account_position" name="account_position" aria-label="Default select example" style="width: 100%; height: 35px;">
                      <option value="">Select Position</option>
                      <option value="Debit" {{ (old('account_position') == 'Debit' || $request->account_position == 'Debit') ? 'selected' : '' }}>Debit</option>
                      <option value="Kredit" {{ (old('account_position') == 'Kredit' || $request->account_position == 'Kredit') ? 'selected' : '' }}>Kredit</option>
                  </select>
                </div>            
  
                <div class="col-md-4 d-flex justify-content-end">
                  <div>
                    <button id="show" type="submit" class="btn btn-warning radius-30" style="height: 60px; width: 80px;"><i class="lni lni-eye"></i> <br> Show</button>
                  </div>
                  <div>
                    <a href="{{ route('journal.create') }}" class="btn btn-primary radius-30" style="height: 60px; width: 80px; margin-left: 10px"><i class="fas fa-plus"></i> Add <br> New</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <div class="card mt-3" style="background-color: white;">
        <div class="card-body">
          @include('components.alert-message')
          <div class="table-responsive">
            <table id="tabel-data" class="table table-striped table-borderless table-hovered" style="width:100%">
              <thead>
                <tr style="background-color: orange; color: black;">
                  <th>No</th>
                  <th>Journal ID</th>
                  <th>Creator</th>
                  <th>Transaction Date</th>
                  <th>Account Number</th>
                  <th>Account Name</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($journal as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->journal->id ?? 'N/A' }}</td>
                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->journal->transaction_date ?? 'N/A' }}</td>
                    <td>{{ $item->chart_of_accounts->account_number ?? 'N/A' }}</td>
                    <td>{{ $item->chart_of_accounts->account_name ?? 'N/A' }}</td>
                    <td>{{ ($item->account_position == 'Debit') ? $item->amount : 0}}</td>
                    <td>{{ ($item->account_position == 'Kredit') ? $item->amount : 0}}</td>
                    @php
                      $total_debit += ($item->account_position == 'Debit') ? $item->amount : 0;
                      $total_kredit += ($item->account_position == 'Kredit') ? $item->amount : 0;
                    @endphp
                    <td>{{ $item->note_item }}</td>
                    <td>
                      <a href="{{ route('journal.edit', $item->journal_id) }}" class="btn btn-warning" title="Edit Journal"><i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div> 

          <div class="mt-3">
            <hr>
            <h5 style="color: red;">Total Journal</h5>

            <div class="form-group row">
              <label for="total_debit" class="col-sm-2 col-form-label" style="width: 150px;"><b> Total Debit: </b></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="total_debit" style="width: 350px;" value="{{ $total_debit }}">
              </div>
            </div>

            <div class="form-group row mt-4">
              <label for="total_kredit" class="col-sm-2 col-form-label" style="width: 150px;"><b> Total Kredit: </b></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="total_kredit" style="width: 350px;" value="{{ $total_kredit }}">
              </div>
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
  $(document).ready(function() {
    // sembunyikan button 'Show' saat halaman dimuat
    $("#show").hide();
    
    $("#start_date, #end_date").change(function() {
      var startDate = $("#start_date").val();
      var endDate = $("#end_date").val();
      
      // jika kedua tanggal terisi, tampilkan button 'Show'
      if (startDate && endDate) {
        $("#show").show();
        $(".alert").hide();
      } else {
        $("#show").hide();
        $(".alert").show();
      }
    });
  });
  
  $(function(){
    $("#filter").on('submit', function(e){
      e.preventDefault();

    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    // console.log([startDate, endDate]);
    
    $.ajax({
      url: "{{ route('journal.index') }}",
      type: 'GET',
      data: {
        start_date: startDate,
        end_date: endDate
      },
      beforeSend: function(xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
      },
      success: function(data) {
          // console.log(data);
          window.location.href = "{{ route('journal.index') }}?start_date=" + $('#start_date').val() + "&end_date=" + $('#end_date').val();
        },
        error: function(xhr, status, error) {
          // console.log(error);
        }
      });
    });
  });
</script>
@endpush
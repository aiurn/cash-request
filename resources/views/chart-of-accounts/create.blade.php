@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-8; mt-5">
        <div class="card">
          <div class="card-body">
            @include('components.alert-message')
            <h4 class="mb-3">Add A New Chart Of Account</h4>
            <form action="{{ route('chart-of-accounts.store') }}" method="post">
              @csrf
              <div class="mb-3">
                <label for="account_group" class="form-label">Account Group</label>
                <select class="form-select" name="account_group" aria-label="Default select example">
                  <option selected>Select Account Group</option>
                  @foreach($coagroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                  @endforeach
                </select>
              </div>
             
              <div class="mt-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input type="text" name="account_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mt-3">
                <label for="account_name" class="form-label">Account Name</label>
                <input type="text" name="account_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mt-3">
                <label for="normal_balance" class="form-label">Normal Balance</label>
                <select class="form-select" name="normal_balance" aria-label="Default select example">
                  <option selected>Select Normal Balance</option>
                  <option value="Debit">Debit</option>
                  <option value="Kredit">Kredit</option>
                </select>
              </div>

              <div>
                <div class="mt-3">
                  <label for="status_account" class="form-label">Status Account</label>
                  <select class="form-select" name="status_account" id="status_account" aria-label="Default select example">
                    <option value="" selected>Select Status Account</option>
                    <option value="Group">Group</option>
                    <option value="Detail">Detail</option>
                  </select>
                </div>
              </div>
              
              <div id="accountParent" class="d-none">
                <div class="mt-3">
                  <label for="parent_id" class="form-label">Account Parent</label>
                  <select class="form-select" name="parent_id" aria-label="Default select example">
                      <option value="" selected>Select Account Parent</option>
                      @foreach($chart_of_accounts as $coa)
                          <option value="{{ $coa->id }}">{{ $coa->account_group }} - {{ $coa->account_name }}</option>
                      @endforeach
                  </select>
                </div>              
              </div>

              <div class="btn-toolbar mt-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="d-flex flex-column col">
                  <label for="beginningBalance" class="form-label w-100">Beginning Balance</label> 
                  <div class="btn-group me-2 flex-grow-1" role="group" aria-label="First group">
                    <button type="button" class="btn btn-outline-secondary" onclick="decrement()">-</button>
                    <button type="button" class="btn btn-outline-secondary">Rp</button>
                    <input id="inputBalance" type="number" class="form-control w-100" style="text-align: left;" value="0" step="0.001" name="beginning_balance">
                    <button type="button" class="btn btn-outline-secondary" onclick="increment();">+</button>
                  </div>                    
                </div>
              </div> 
                                   
              <button type="submit" class="btn btn-success" style="margin-top: 30px">Simpan Data</button> <br><br><br>
            </form>
</div>
@endsection 

@push('scripts')
<script>
  $('#status_account').on('change', function() {
    if (this.value == "Detail") {
      $('#accountParent').removeClass('d-none');
    } else {
      $('#accountParent').addClass('d-none');
    }
  });

  var beginningBalance = 0; 
    
  function increment() {
    var inputBalance = document.getElementById("inputBalance");
    var value = parseFloat(inputBalance.value);
    inputBalance.value = (value + 1.0).toFixed(3);
  }
                      
  function decrement() {
    var inputBalance = document.getElementById("inputBalance");
    var value = parseFloat(inputBalance.value);
    if (value > 0) {
      inputBalance.value = (value - 1.0).toFixed(3);
    }
    }
</script>
@endpush
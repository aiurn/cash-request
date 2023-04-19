<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccountGroups;
use Illuminate\Http\Request;
use App\Models\ChartOfAccounts;
use Illuminate\Support\Facades\Session;

class ChartOfAccountsController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Chart Of Account';
        $data['chart_of_accounts'] = ChartOfAccounts::all();
        $data['coa'] = ChartOfAccounts::all();
        return view('chart-of-accounts.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create Chart Of Accounts';
        $data['chart_of_accounts'] = ChartOfAccounts::get();
        $data['coagroups'] = ChartOfAccountGroups::all();
        return view('chart-of-accounts.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
        'account_group' => 'required',
        'account_number' => 'required',
        'account_name' => 'required',
        'normal_balance' => 'required',
        'status_account' => 'required',
        'parent_id' => 'nullable',
        'beginning_balance' => 'required',
    ]);

    try {
        $data = new ChartOfAccounts();
        $data->account_group = $request->input('account_group');
        $data->account_number = $request->input('account_number');
        $data->account_name = $request->input('account_name');
        $data->normal_balance = $request->input('normal_balance');
        $data->status_account = $request->input('status_account');
        $data->parent_id = $request->input('parent_id');
        $data->beginning_balance = $request->input('beginning_balance');
        
        $data->save();
        return redirect()->route('chart-of-accounts.index')->with('success', 'Data Berhasil di Simpan');
    } catch (\Throwable $th) {
        return redirect()->route('chart-of-accounts.index')->with('failed', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Update Chart Of Account';
        $data['chart_of_accounts'] = ChartOfAccounts::findOrFail($id);
        $data['coagroups'] = ChartOfAccountGroups::all();
        $data['coa'] = ChartOfAccounts::all();
        return view('chart-of-accounts.edit', $data);
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'account_group' => 'required',
                'account_number' => 'required',
                'account_name' => 'required',
                'normal_balance' => 'required',
                'status_account' => 'required',
                'parent_id' => 'nullable',
                'beginning_balance' => 'required',
            ]);
            
            $chartOfAccount = ChartOfAccounts::findOrFail($id);
            $chartOfAccount->account_group = $request->input('account_group');
            $chartOfAccount->account_number = $request->input('account_number');
            $chartOfAccount->account_name = $request->input('account_name');
            $chartOfAccount->normal_balance = $request->input('normal_balance');
            $chartOfAccount->status_account = $request->input('status_account');
            $chartOfAccount->parent_id = $request->input('parent_id');
            $chartOfAccount->beginning_balance = $request->input('beginning_balance');
            $chartOfAccount->save();
    
            return redirect()->route('chart-of-accounts.index')->with('success','Data Berhasil di Edit');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Failed', $th->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            ChartOfAccounts::destroy($id);
            Session::flash('success', 'Data Berhasil di Hapus');

            return response()->json([
                'success' => true,
                'message' => 'Chart of Accounts Berhasil di Hapus',
            ], 200);
        } catch (\Throwable $th) {
            Session::flash('Failed', $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
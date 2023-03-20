<?php

namespace App\Http\Controllers;

use App\Models\CashRequest;
use App\Models\CashRequestDetail;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class CashRequestDetailController extends Controller
{
    // public function index(){
    //     $data['cash_request_detail'] = CashRequestDetail::all();
    //     $cash_request = CashRequest::all();
    //     return view('cash-request.create', compact('cash_request'), $data);
    // }

    public function store(Request $request){

        // $request->validate([
        //     'description' => 'required',
        //     'qty' => 'required',
        //     'unit' => 'required',
        //     'amount' => 'required',
        //  ]);

        //  try {
        //     // $cash_request = CashRequest::findOrFail($id);
        //     // $data = tambahBaris();
        //     $data = new CashRequestDetail();
            

        //     // $data->cash_request_id = $cash_request;
        //     $data->cash_request_id = $request->cash_request_id;
        //     $data->description = $request->description;
        //     $data->qty = $request->qty;
        //     $data->unit = $request->unit;
        //     $data->amount = $request->amount;
        //     $total = $data->qty * $data->amount;
        //     $data->total = $total;
            

        //     $data->save();
 
        //      return redirect()->route('cash-request.create')->with('success', 'Data Berhasil Ditambahkan');
        //  } catch (\Throwable $th) {
        //      return redirect()->route('cash-request.create')->with('failed', $th->getMessage());
        //  }
        
        // $baris = $request->input('baris');

        // foreach ($cash_request_detail as $item) {
        //     DB::table('cash_request_detail')->insert([
        //         'description' => $item['description'],
        //         'unit' => $item['unit'],
        //         'qty' => $item['qty'],
        //         'amount' => $item['amount'],
        //         'total' => $item['total'],
        //     ]);
        // }
        // return redirect()->back()->with('success', 'Customers saved successfully.');
    }

    public function edit($id)
    {
        $data['cr_detail'] = CashRequestDetail::findOrFail($id);
        $cash_request = CashRequest::all();
        return view('cash-request-detail.edit', compact('cash_request'), $data);
    }
    
    public function update(Request $request, $id){
        try {
            $request->validate([
                'description' => 'required',
                'qty' => 'required',
                'unit' => 'required',
                'amount' => 'required',
            ]);
        
            $data = CashRequestDetail::findOrFail($id);
            
            // $cash_request_id = CashRequest::all();
            $data->cash_request_id = $data->cash_request_id;
            $data->description = $request->description;
            $data->qty = $request->qty;
            $data->unit = $request->unit;
            $data->amount = $request->amount;
            $total = $data->qty * $data->amount;
            $data->total = $total;

            $data->save();
        
            return redirect()->route('cash-request-detail.index')->with('success','Data berhasil diedit');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            CashRequestDetail::destroy($id);
            Session::flash('success', 'Cash Request Successfully Deleted!');

            return response()->json([
                'success' => true,
                'message' => 'Cash Request successfully deleted',
            ], 200);
        } catch (\Throwable $th) {
            Session::flash('failed', $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
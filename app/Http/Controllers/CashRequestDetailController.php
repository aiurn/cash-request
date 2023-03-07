<?php

namespace App\Http\Controllers;

use App\Models\CashRequest;
use App\Models\CashRequestDetail;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashRequestDetailController extends Controller
{
    public function index(){
        $data['cash_request_detail'] = CashRequestDetail::get();
        $data['cash_request'] = CashRequest::all();
        return view('cash-request-detail.index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'amount' => 'required',
            'total' => 'required',
         ]);

         try {
            $data = new CashRequestDetail();
 
            

             $data->description = $request->description;
             $data->qty = $request->qty;
             $data->unit = $request->unit;
             $data->amount = $request->amount;
             $data->total = $request->total;
 
             $data->save();
 
             return redirect()->route('cash-request.index')->with('success', 'Data Berhasil Ditambahkan');
         } catch (\Throwable $th) {
             return redirect()->route('cash-request.index')->with('failed', $th->getMessage());
         }
    }

    public function edit($id)
    {
        $data['cash_request'] = CashRequestDetail::findOrFail($id);
        return view('cash-request-detail.edit',$data);
    }
    
    public function update(Request $request, $id){
        try {
            $request->validate([
                'description' => 'required',
                'qty' => 'required',
                'unit' => 'required',
                'amount' => 'required',
                'total' => 'required',
            ]);
        
            $data = CashRequestDetail::findOrFail($id);
            
            $cash_request_id = CashRequest::all();
            $data->cash_request_id = $cash_request_id;
            $data->description = $request->description;
            $data->qty = $request->qty;
            $data->unit = $request->unit;
            $data->amount = $request->amount;
            $data->total = $request->total;

            $data->save();
        
            return redirect()->route('cash-request.index')->with('success','Data berhasil diedit');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashRequest;
use App\Models\Projects;
Use App\Models\CashRequestDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\DB;

class CashRequestController extends Controller
{
    public function index(){
        $cashrequest = CashRequest::all();
        $data['cash_request'] = $cashrequest;
        // $project = CashRequest::with('project_id');
        // $data['user'] = User::get();
        $item = CashRequest::with('project');
        return view('cash-request.index', $data);
    }

    public function create(){
        $data['page_title'] = 'Create Cash Request';
        $data['cash_request'] = CashRequest::get();
        $data['cash_request_detail'] = CashRequestDetail::all();
        $project = Projects::all();
        // $user = User::all();
        // $dt = CashRequest::with('user', 'project');
        return view('cash-request.create', compact('project'), $data);
    }


    public function store(Request $request){
        // dd($request->all());
        try{
             //input cash request
            $validatedData = $request->validate([
                'description' => 'required',
                'unit' => 'required',
                'qty' => 'required',
                'amount' => 'required',
                'total' => 'required',
            ], [
                'description.*' => 'required|string',
                'unit.*' => 'required|string',
                'qty.*' => 'required|numeric|min:1',
                'amount.*' => 'required|numeric|min:1',
                'total.*' => 'required|numeric|min:1',
            ]);

            $cashRequest = new CashRequest();

            $cashRequest->request_by = Auth::user()->id;
            $cashRequest->project_id = $request->project_id;
            $cashRequest->date = $request->date;
            $cashRequest->status = 'Pending';
            $cashRequest->save();
        
            $description = $validatedData['description'];
            $unit = $validatedData['unit'];
            $qty = $validatedData['qty'];
            $amount = $validatedData['amount'];
            $total = $validatedData['total'];

            for ($i = 0; $i < count($amount); $i++) {
                $cashRequestDetail = new CashRequestDetail();
                $cashRequestDetail->cash_request_id = $cashRequest->id;
                $cashRequestDetail->description = $description[$i];
                $cashRequestDetail->unit = $unit[$i];
                $cashRequestDetail->qty = $qty[$i];
                $cashRequestDetail->amount = $amount[$i];
                $total = $cashRequestDetail->qty * $cashRequestDetail->amount;
                $cashRequestDetail->total = $total;
                $cashRequestDetail->save();
            } return redirect()->route('cash-request.index')->with('success', 'Cash request has been created successfully.');
        } catch(\Throwable $th){
            return redirect()->route('cash-request.index')->with('failed', $th->getMessage());
        }
    }
    

    public function edit($id)
    {
        $data['page_title'] = 'Update Cash Request';
        $data['cash_request'] = CashRequest::findOrFail($id);
        // $data['cash_request_detail'] = CashRequestDetail::all();
        $data['cash_request_detail'] = CashRequestDetail::where('cash_request_id', $id)->get();
        $project = Projects::all();
        return view('cash-request.edit', compact('project'),$data);
    }
    

    public function update(Request $request, $id){
        try {
            //input cash request
            $validatedData = $request->validate([
                'description' => 'required',
                'unit' => 'required',
                'qty' => 'required',
                'amount' => 'required',
                'total' => 'required',
            ], [
                'description.*' => 'required|string',
                'unit.*' => 'required|string',
                'qty.*' => 'required|numeric|min:1',
                'amount.*' => 'required|numeric|min:1',
                'total.*' => 'required|numeric|min:1',
            ]);
        
            $cashRequest = CashRequest::findOrFail($id);
            
            $date = date('Y-m-d', strtotime($request->date));
            $cashRequest->date = $date;
            $cashRequest->project_id = $request->project_id;
            $cashRequest->save();
    
            // Get existing details for this cash request
            $existingDetails = CashRequestDetail::where('cash_request_id', $id)->get();
    
            $description = $validatedData['description'];
            $unit = $validatedData['unit'];
            $qty = $validatedData['qty'];
            $amount = $validatedData['amount'];
            $total = $validatedData['total'];
    
            // Loop through the detail data
            for ($i = 0; $i < count($amount); $i++) {
                // Find the existing detail or create a new one
                $cashRequestDetail = CashRequestDetail::find($request->input('detail_id.'.$i)) ?? new CashRequestDetail;
                
                // Update the detail data
                $cashRequestDetail->cash_request_id = $cashRequest->id;
                $cashRequestDetail->description = $description[$i];
                $cashRequestDetail->unit = $unit[$i];
                $cashRequestDetail->qty = $qty[$i];
                $cashRequestDetail->amount = $amount[$i];
                $total = $cashRequestDetail->qty * $cashRequestDetail->amount;
                $cashRequestDetail->total = $total;
                $cashRequestDetail->save();
                
                // Remove the detail from the existing details list
                $existingDetails = $existingDetails->reject(function ($item) use ($cashRequestDetail) {
                    return $item->id === $cashRequestDetail->id;
                });
            }
    
            // Delete any remaining details that were not updated
            foreach ($existingDetails as $detail) {
                $detail->delete();
            }
        
            return redirect()->route('cash-request.index')->with('success','Cash request has been edited successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }
    

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $cashRequest = CashRequest::find($id);
            $cashRequest->cashrequestdetail()->delete();
            $cashRequest->delete();

            DB::commit();

            Session::flash('success', 'Cash Request Successfully Deleted!');

            return response()->json([
                'success' => true,
                'message' => 'Cash Request successfully deleted',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('failed', $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function show($id){
        $data['page_title'] = 'Show Cash Request';
        $data['cash_request'] = CashRequest::findOrFail($id);
        // $data['cash_request_detail'] = CashRequestDetail::all();
        $data['cash_request_detail'] = CashRequestDetail::where('cash_request_id', $id)->get();
        $project = Projects::all();
        return view('cash-request.show', compact('project'),$data);
    }
    

}
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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class CashRequestController extends Controller
{
    use HasRoles;

    public function __construct()
    {
        $this->middleware('permission:cash-request-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cash-request-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cash-request-delete', ['only' => ['destroy']]);
        $this->middleware('permission:cash-request-show', ['only' => ['show']]);
        $this->middleware('permission:cash-request-approve', ['only' => ['approve', 'reject']]);
    }

    public function index()
    {
        if (Auth::user()->getRoleNames()[0] == 'Super Admin') {
            $cashrequest = CashRequest::all();
        } else {
            $cashrequest = CashRequest::where('request_by', Auth::user()->id)->get();
        }

        $data['cash_request'] = $cashrequest;

        return view('cash-request.index', $data);
    }


    public function create()
    {
        $data['page_title'] = 'Create Cash Request';
        $data['cash_request'] = CashRequest::get();
        $data['cash_request_detail'] = CashRequestDetail::all();
        $data['project'] = Projects::all();
        
        return view('cash-request.create', $data);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'project_id' => 'required',
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

        try{
            $cashRequest = new CashRequest();

            $cashRequest->request_by = Auth::user()->id;
            $cashRequest->project_id = $request->project_id;
            $cashRequest->date = $request->date;
            $cashRequest->status = 'Pending';
            $cashRequest->approved_by = $request->approved_by;
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
        $data['cash_request_detail'] = CashRequestDetail::where('cash_request_id', $id)->get();
        $data['project'] = Projects::all();

        return view('cash-request.edit', $data);
    }
    

    public function update(Request $request, $id)
    {
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

        try {
            $cashRequest = CashRequest::findOrFail($id);
            
            $date = date('Y-m-d', strtotime($request->date));
            $cashRequest->date = $date;
            $cashRequest->project_id = $request->project_id;
            $cashRequest->save();
    
            $existingDetails = CashRequestDetail::where('cash_request_id', $id)->get();
    
            $description = $validatedData['description'];
            $unit = $validatedData['unit'];
            $qty = $validatedData['qty'];
            $amount = $validatedData['amount'];
            $total = $validatedData['total'];
    
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


    public function show($id)
    {
        $data['page_title'] = 'Show Cash Request';
        $data['cash_request'] = CashRequest::findOrFail($id);
        $data['cash_request_detail'] = CashRequestDetail::where('cash_request_id', $id)->get();
        $data['project'] = Projects::all();

        return view('cash-request.show', $data);
    }


    public function approve(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $cashRequest = CashRequest::findOrFail($id);
            $cashRequest->approved_by = Auth::user()->id;
            $cashRequest->status = 'Approved';
            $cashRequest->save();

            DB::commit();

            Session::flash('success', 'Cash Request Successfully Approved!');

            return response()->json([
                'success' => true,
                'message' => 'Cash Request successfully approved',
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
    
    
    public function reject(Request $request, $id)
    {
        DB::beginTransaction();
    
        try {
            $cashRequest = CashRequest::findOrFail($id);
            $cashRequest->approved_by = Auth::user()->id;
            $cashRequest->status = 'Rejected';
            $cashRequest->reasons = $request->reasons;
            $cashRequest->save();
    
            DB::commit();

            Session::flash('success', 'Cash Request Successfully Rejected!');

            return response()->json([
                'success' => true,
                'message' => 'Cash Request successfully rejected',
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
    

}
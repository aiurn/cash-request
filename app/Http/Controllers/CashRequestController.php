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
        $project = Projects::all();
        // $user = User::all();
        // $dt = CashRequest::with('user', 'project');
        return view('cash-request.create', compact('project'), $data);
    }

    public function store(Request $request){
        // Bikin Validasi
        // $request->validate([
        //    'name pada form' => 'ini pengecekan validasi' required 
        // ]);
        $request->validate([
           'date' => 'required',
           'project_id' => 'required',

        ]);
        // Error Handling
        try {
            // Pembuatan Data Baru
            $data = new CashRequest;

            $data->request_by = Auth::user()->id;
            $data->project_id = $request->project_id;
            $data->date = $request->date;
            $data->status = 'Pending';

            $data->save();

            return redirect()->route('cash-request.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('cash-request.index')->with('failed', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Update Cash Request';
        $data['cash_request'] = CashRequest::findOrFail($id);
        $project = Projects::all();
        return view('cash-request.edit', compact('project'),$data);
    }
    
    public function update(Request $request, $id){
        try {
            $request->validate([
                'date' => 'required',
                'project_id' => 'required',
            ]);
        
            $data = CashRequest::findOrFail($id);
            
            $date = date('Y-m-d', strtotime($request->date));
            $data->date = $date;
            $data->project_id = $request->project_id;
            // dd($data);
            $data->save();
        
            return redirect()->route('cash-request.index')->with('success','Data berhasil diedit');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            CashRequest::destroy($id);
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



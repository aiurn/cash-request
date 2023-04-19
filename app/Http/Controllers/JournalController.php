<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Models\JournalDetail;
use App\Models\ChartOfAccounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = 'Journal';
        $data['total_debit'] = 0;
        $data['total_kredit'] = 0;
        $query = JournalDetail::query();
        $query->join('journals', 'journal_details.journal_id', '=', 'journals.id');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $query->whereBetween('journals.transaction_date', [$request->start_date, $request->end_date]);
        } 
        else {
            // return redirect()->back()->with('message', 'Silahkan Isi Start Date dan End Date Untuk Memfilter Data');
            session()->flash('message', 'Isi Start Date dan End Date Untuk Dapat Memfilter Data');
        }

        $data['details'] = Journal::where('status', 'done')->get();
        $data['journal'] = $query->get();
        $data['chart_of_accounts'] = ChartOfAccounts::all();

        return view('journal.index', $data)->with('request', $request);
    }

    public function create()
    {
        $journal_check = Journal::where('user_id', Auth::user()->id)->where('status', 'draft')->first();
        if (!$journal_check) {
            // Membuat objek journal baru dan menyimpan ke dalam database
            $journal = new Journal();
            $journal->user_id = Auth::user()->id;
            $journal->status = 'draft';
            $journal->save();

            // Get Journal ID
            $journal_id = $journal->id;
        } else {
            // Jika ada draft journal yang belum disimpan, ambil id nya dari database
            $journal_id = $journal_check->id;
        }

        // Menampilkan halaman web untuk membuat data journal detail
        $data['page_title'] = 'Create Journal';
        $data['journal_id'] = $journal_id;
        $data['journal_details'] = JournalDetail::where('journal_id', $journal_id)->get();
        $data['chart_of_accounts'] = ChartOfAccounts::all();
        $data['coa'] = ChartOfAccounts::all();
        $data['accountNumber'] = DB::table('chart_of_accounts')->pluck('account_number', 'id');
        $data['accountName'] = DB::table('chart_of_accounts')->pluck('account_name', 'id');
        return view('journal.create', $data);
    }

    public function cancel()
    {
        try {
            $journal = Journal::where('user_id', Auth::user()->id)->where('status', 'draft')->latest()->first(); 
            $detail = JournalDetail::where('journal_id', $journal->id)->get();
            $detail->each->delete();
            $journal->delete();
            
            Session::flash('success', 'Data Berhasil Dihapus.');

            return redirect()->route('journal.index')->with('success', 'Journal Berhasil di Batalkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'chart_of_account_id' => 'required',
            'account_position' => 'required',
            'amount' => 'required',
            'budget_period' => 'required',
            'note_item' => 'required'
        ]);

        try {
            $journalDetail = new JournalDetail;

            // Pengambilan Data Journal Yang Sudah dibuat Oleh User itu sendiri
            if ($request->has('id_journal')) {
                $journal_check = $request->id_journal;
            }else {
                $journal_check = Journal::where('user_id', Auth::user()->id)->where('status', 'draft')->first()->id;
            }

            $journalDetail->journal_id = $journal_check;
            $journalDetail->chart_of_account_id = $request->input('chart_of_account_id');
            $journalDetail->account_position = $request->input('account_position');
            $journalDetail->amount = $request->input('amount');
            $journalDetail->budget_period = $request->input('budget_period');
            $journalDetail->note_item = $request->input('note_item');
            $journalDetail->user_id = auth()->user()->id;
            $journalDetail->save();

            if ($request->has('id_journal')) {
                return redirect()->back()->with('success', 'Journal Detail Berhasil di Tambahkan');
            }else {
                return redirect()->route('journal.create')->with('success', 'Journal Berhasil di Tambahkan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'transaction_date' => 'required',
            'description' => 'nullable',
        ]);

        try {
            // Mengambil data journal dari database berdasarkan id
            $journal = Journal::findOrFail($id);

            $journal->transaction_date = $request->input('transaction_date');
            $journal->description = $request->input('description');
            $journal->status = 'done';
            $journal->save();

            return redirect()->route('journal.index')->with('success', 'Journal Berhasil di Tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Journal';
        $journal = Journal::findOrFail($id);
        $journal_id = $journal->id;
        $data['journal'] = $journal;
        $data['journal_id'] = $journal_id;
        $data['journal_details'] = JournalDetail::where('journal_id', $journal_id)->get();
        $data['chart_of_accounts'] = ChartOfAccounts::all();

        return view('journal.edit', $data);
    }

    public function updatemodal(Request $request, $id)
    {
        $request->validate([
            'chart_of_account_id' => 'required',
            'account_position' => 'required',
            'amount' => 'required',
            'budget_period' => 'required',
            'note_item' => 'required',
        ]);

        try{
            $id = $request->input('id');
            $chart_of_account_id = $request->input('chart_of_account_id');
            $account_position = $request->input('account_position');
            $amount = $request->input('amount');
            $budget_period = $request->input('budget_period');
            $note_item = $request->input('note_item');

            $journal = JournalDetail::findOrFail($id);
            $journal->chart_of_account_id  = $chart_of_account_id ;
            $journal->account_position = $account_position;
            $journal->amount = $amount;
            $journal->budget_period = $budget_period;
            $journal->note_item = $note_item;

            $journal->save();

            return redirect()->route('journal.edit', $journal->journal_id)->with('success', 'Journal Berhasil di Edit');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function updatejournal(Request $request, $id)
    {
        $request->validate([
            'transaction_date' => 'required',
            'description' => 'nullable',
        ]);

        try {
            $journal = Journal::findOrFail($id);

            // Simpan data ke dalam database
            $journal->transaction_date = $request->input('transaction_date');
            $journal->description = $request->input('description');
            $journal->save();

            return redirect()->route('journal.index')->with('success', 'Journal Berhasil di Edit');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    } 

    public function destroy($id)
    {
        try {
            $journalDetail = JournalDetail::findOrFail($id);
            $journalId = $journalDetail->journal_id;
            
            JournalDetail::destroy($id);

            $journalDetailsCount = JournalDetail::where('journal_id', $journalId)->count();
            if ($journalDetailsCount == 0) {
                Journal::destroy($journalId);
            }

            Session::flash('success', 'Journal Berhasil di Hapus');
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil di Hapus',
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
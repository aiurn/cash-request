<?php

namespace App\Models;

use App\Models\ChartOfAccounts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JournalDetail extends Model
{
    protected $table = 'journal_details';
    protected $fillable = [
        'chart_of_account_id',
        'account_position',
        'amount',
        'budget_period',
        'note_item',
    ];

    public function journal(){
        return $this->belongsTo(Journal::class);
    }

    public function chart_of_accounts(){
        return $this->belongsTo(ChartOfAccounts::class, 'chart_of_account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

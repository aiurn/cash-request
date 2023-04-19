<?php

namespace App\Models;

use App\Models\ChartOfAccounts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    protected $fillable = ['transaction_date', 'description'];

    public function journal_details(){
        return $this->hasMany(JournalDetail::class);
    }
}

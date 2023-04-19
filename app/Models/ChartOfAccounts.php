<?php

namespace App\Models;

use App\Models\JournalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChartOfAccounts extends Model
{
    protected $table = "chart_of_accounts";
    protected $guarded = [];

    public function group()
    {
        return $this->hasMany(ChartOfAccountGroups::class, 'group_id');
    }

    public function parentAccount()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'parent_id');
    }

    public function childAccounts()
    {
        return $this->hasMany(ChartOfAccounts::class, 'parent_id');
    }
   
    public function journal_details()
    {
        return $this->hasMany(JournalDetail::class);
    }
}
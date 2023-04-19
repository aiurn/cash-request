<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccountGroups extends Model
{
    use HasFactory;

    protected $table = 'chart_of_account_groups';
    
    protected $fillable = [
        'name',
    ];

    public function accounts()
    {
        return $this->belongsTo(ChartOfAccounts::class);
    }
}
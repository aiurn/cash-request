<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRequest extends Model
{
    use HasFactory;

    protected $table = "cash_request";
    protected $fillable = [
        'id',
        'date',
        'project_id',
        'request_by', 
        'approved_by',
        'status',
        'reasons'
    ];
    protected $hiden;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function cashrequestdetail()
    {
        return $this->hasMany(CashRequestDetail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRequestDetail extends Model
{
    use HasFactory;

    protected $table = "cash_request_detail";
    protected $fillable = [
        'cash_request_id',
        'description',
        'amount',
        'qty',
        'unit',
        'total'
    ];
    protected $hiden;

    
    public function cashrequest()
    {
        return $this->belongsTo('App\Models\CashRequest');
    }
}

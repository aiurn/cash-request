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

    // public function total(){
    //     $total = CashRequest::all()->select('qty');
    //     SELECT KODE_BRG, NAMA_BRG, HARGA_BRG, JUMLAH, JUMLAH*HARGA_BRG AS total 
    // }

    public function cashrequest()
    {
        return $this->belongsTo('App\Models\CashRequest');
    }
}

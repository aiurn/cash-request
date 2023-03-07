<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $fillable = [
        'id',
        'project_number',
        'name',
        'description'
    ];

    public function cashrequest()
    {
        return $this->hasMany(CashRequest::class);
    }
}

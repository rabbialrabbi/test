<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'loaner','mobile','email','address','contract_start','contract_end','loan','returned','interest',
        'total_amount','remaining','type','detail','created_at','upated_at','deleted_at'
    ];
}

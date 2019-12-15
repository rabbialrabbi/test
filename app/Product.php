<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_name','product_category','store_in','batch', 'purchase_rate', 'selling_rate', 'qty',
        'company', 'mfg_date', 'exp_date', 'details'
    ];
}


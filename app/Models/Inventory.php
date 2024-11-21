<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inventory extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        'name_product',
        'quantity',
        'purchase_price',
        'supplier_id',
    ];
}

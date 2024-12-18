<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        'sale_id',
        'total',
        'clientName',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
     //
     use HasFactory;


     protected $fillable = [
        'total',
        'created_at_exact',
        'employed_id',
        'dishes'
     ];
}

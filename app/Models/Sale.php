<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
     //
     use HasFactory;

     public function employee()
     {
         return $this->belongsTo(Employee::class, 'employed_id');
     }

     protected $fillable = [
        'total',
        'created_at_exact',
        'employed_id',
        'dishes'
     ];
}

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
        'employee_id',
        'dishes'
     ];

     public $timestamps = true;
}

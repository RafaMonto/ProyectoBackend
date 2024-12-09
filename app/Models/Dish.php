<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dish extends Model
{
    //
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    protected $fillable = [
        'name',
        'description',
        'price',
        'availability',
        'category_id',
    ];
}

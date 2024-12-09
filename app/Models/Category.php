<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación con los platos.
     * Una categoría puede tener muchos platos.
     */
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}

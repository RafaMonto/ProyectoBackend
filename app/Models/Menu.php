<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = ['date'];

    /**
     * Relación muchos a muchos con Dish.
     */
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_menu', 'menu_id', 'dish_id');
    }
}

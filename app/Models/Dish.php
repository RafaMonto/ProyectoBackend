<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'price',
        'availability',
        'category_id',
    ];

    /**
     * Relación con la categoría.
     * Un plato pertenece a una categoría.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relación muchos a muchos con Menu.
     * Un plato puede estar en varios menús.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'dish_menu', 'dish_id', 'menu_id');
    }
}

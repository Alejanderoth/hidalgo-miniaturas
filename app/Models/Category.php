<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function productos()
    {
        return $this->hasMany(Product::class, 'categoria_id');
    }
}
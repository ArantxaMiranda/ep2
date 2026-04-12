<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model{
    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'color',
        'imagen',
        'stock'
    ];
}

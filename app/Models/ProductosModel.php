<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model{
    protected $table = 'productos';
    protected $fillable = [
        'api_id',
        'nombre',
        'precio',
        'descripcion',
        'categoria',
        'imagen',
        'stock'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'producto';

    protected $fillable = [
        'titulo',
        'precio',
        'descripcion',
        'categoria'
    ];
}
